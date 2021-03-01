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
      'email' => 'required|email|max:30',
      'delivery_time' => 'required|date_format:"Y-m-d\TH:i"|after:now',
      'total_price' => 'required|numeric|between:0,99.9999',
      'mobile' => 'required|integer|digits_between:8,15',
      'first_name' => 'required|max:50',
      'lastname' => 'required|max:50',
      'address' => 'required|max:100',
      'notes' => 'nullable|max:255',
      // Validation FK to be sure that the ID restaurant sent is an existing restaurant ID
      'restaurant_id' => 'required|numeric|exists:restaurants,id',
      'card_owner' => 'required|max:50',
    ]);

    // ------------------------ ORDERS TABLE ------------------------

    // Creating a new Object/Instance of a new Order with the form data
    $new_order = new Order();
    // Filling in the new Object/Instance with the form data received
    $new_order->email = $request->email;
    $new_order->delivery_time = $request->delivery_time;
    $new_order->total_price = $request->total_price;
    $new_order->mobile = $request->mobile;
    $new_order->first_name = $request->first_name;
    $new_order->lastname = $request->lastname;
    $new_order->address = $request->address;
    $new_order->notes = $request->notes;
    $new_order->restaurant_id = $request->restaurant_id;
    // Saving the new Object/Instance of the Order in the database
    $new_order->save();

    // ------------------------ PAYMENTS TABLE ------------------------
    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;
    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => 'fake-valid-nonce',
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    // Creating a new Object/Instance of a new Payment with the form data
    $new_payment = new Payment();
    // Filling in the new Object/Instance with the form data received
    $new_payment->card_owner = $request->card_owner;
    $new_payment->order_id = $new_order->id;

    // Controllo se il pagamento va a buon fine
    if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);

        // Se il pagamento è andato a buon fine assegno alla colonna "status" la stringa "accepted"
        $new_payment->status = 'Accepted';
        // Prendo l'ID della transazione da Braintree e lo aggiungo all'istanza/Oggetto
        $new_payment->transaction_id = $transaction->id;
        // Saving the new Object/Instance of the Payment in the database
        $new_payment->save();
        // New QUERY to select the latest order added in the DB to be sure to redirect to the very last order entered
        $last_entered_order = Order::orderBy('id', 'desc')->first();
        // Redirecting to the web page of the latest order entered containing order confirmation and summary information
        return redirect()->route('orders.show', ['order' => $last_entered_order->id])->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");

        // Se il pagamento non è andato a buon fine assegno alla colonna "status" la stringa "rejected"
        $new_payment->status = 'Rejected';
        // Saving the new Object/Instance of the Payment in the database
        $new_payment->save();
        // Reindirizzo l'utente alla stessa pagina ma con il messaggio di errore
        return redirect()->route('restaurant.show', ['id' => $request->restaurant_id])->withErrors('An error occurred with the message: '.$result->message);
    }
});


// ----------- AUTHENTICATION ROUTES -----------
Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', 'HomeController@getMonthlyOrdersData')->name('index');
    Route::resource('/restaurants', 'RestaurantController');
    Route::resource('/dishes', 'DishController');
    Route::get('/orders', 'OrderController@index')->name('orders.index');
});
