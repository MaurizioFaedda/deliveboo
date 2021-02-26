<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Order;
use App\Payment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ----------- PUBLIC ROUTES -----------
Route::get('/', 'HomeController@index')->name('index');
// Restaurant Controller routes
Route::get('/restaurant/{id}', 'RestaurantController@show')->name('restaurant.show');
// Orders routes
Route::resource('guest/orders', 'OrderController');


Route::get('/cart', function () {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $token = $gateway->ClientToken()->generate();

    return view('guest.cart', [
        'token' => $token
    ]);
});

Route::post('/checkout', function(Request $request){
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    // ------------------------ VALIDATION FORM DATA ------------------------

    $request->validate([
      'email' => 'required|max:30',
      // 'delivery_time' => 'required|date_format:date',
      'total_price' => 'required|numeric|between:0,99.9999',
      'mobile' => 'required|max:15',
      'first_name' => 'required|max:50',
      'lastname' => 'required|max:50',
      'address' => 'required|max:100',
      'notes' => 'nullable|max:255',
      // Validation FK to be sure that the ID restaurant sent is an existing restaurant ID
      'restaurant_id' => 'required|numeric|exists:restaurants,id',
      'card_owner' => 'required|max:50',
    ]);

    // ------------------------ ORDERS TABLE ------------------------

    // Storing all form data to fill in the ORDERS table in different variables
    $email = $request->email;
    $delivery_time = $request->delivery_time;
    $total_price = $request->total_price;
    $mobile = $request->mobile;
    $first_name = $request->first_name;
    $lastname = $request->lastname;
    $address = $request->address;
    $notes = $request->notes;
    $restaurant_id = $request->restaurant_id;

    // Creating a new Object/Instance of a new Order with the form data
    $new_order = new Order();
    // Filling in the new Object/Instance with the form data received
    $new_order->email = $email;
    $new_order->delivery_time = $delivery_time;
    $new_order->total_price = $total_price;
    $new_order->mobile = $mobile;
    $new_order->first_name = $first_name;
    $new_order->lastname = $lastname;
    $new_order->address = $address;
    $new_order->notes = $notes;
    $new_order->restaurant_id = $restaurant_id;
    // Saving the new Object/Instance of the Order in the database
    $new_order->save();

    // ------------------------ PAYMENTS TABLE ------------------------
    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;
    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    // Storing form data to fill in the PAYMENTS table in different variables
    $card_owner = $request->card_owner;
    // Prendo la FK dell'ordine appena effettuato
    $order_id = $new_order->id;
    // Creating a new Object/Instance of a new Payment with the form data
    $new_payment = new Payment();
    // Filling in the new Object/Instance with the form data received
    $new_payment->card_owner = $card_owner;
    $new_payment->order_id = $order_id;

    // Controllo se il pagamento va a buon fine
    if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);

        // Prendo la lo status del pagamento e l'ID della transazione da Braintree e lo aggiungo all'istanza/Oggetto
        $status = 'Accepted';
        $new_payment->status = $status;
        $new_payment->transaction_id = $transaction->id;
        // Saving the new Object/Instance of the Payment in the database
        $new_payment->save();
        // Reindirizzo l'utente alla stessa pagina ma con il messaggio di conferma dell'avvenuto ordine e pagamento
        return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");

        // Prendo la lo status del pagamento e l'ID della transazione da Braintree e lo aggiungo all'istanza/Oggetto
        $status = 'Rejected';
        $new_payment->status = $status;
        // Saving the new Object/Instance of the Payment in the database
        $new_payment->save();
        // Reindirizzo l'utente alla stessa pagina ma con il messaggio di errore
        return back()->withErrors('An error occurred with the message: '.$result->message);
    }
});


// ----------- AUTHENTICATION ROUTES -----------
Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', 'HomeController@index')->name('index');
    Route::resource('/restaurants', 'RestaurantController');
    Route::resource('/dishes', 'DishController');
});
