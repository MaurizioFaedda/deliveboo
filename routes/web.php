<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
// Payments routes
Route::resource('/payments', 'PaymentController');

Route::get('/pay', function () {
    $gateway = new Braintree\Gateway([
  'environment' => 'sandbox',
  'merchantId' => 'gncpw48dy8pnxspp',
  'publicKey' => '5sp8xkhmyk77xmpn',
  'privateKey' => '66a03d2d8813d5bc80879e71650b8045'
]);


    $token = $gateway->ClientToken()->generate();

    return view('guest.pay', [
        'token' => $token
    ]);
});

Route::post('/checkout', function(Request $request){
    $gateway = new Braintree\Gateway([
      'environment' => 'sandbox',
      'merchantId' => 'gncpw48dy8pnxspp',
      'publicKey' => '5sp8xkhmyk77xmpn',
      'privateKey' => '66a03d2d8813d5bc80879e71650b8045'
    ]);
    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;
    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        $transaction = $result->transaction;
        // header("Location: transaction.php?id=" . $transaction->id);

        return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
    } else {
        $errorString = "";

        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: index.php");
        return back()->withErrors('An error occurred with the message: '.$result->message);
    }
});

// Cart Controller routes
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
// Route::patch('/cart/{dish}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{dish}', 'CartController@destroy')->name('cart.destroy');
Route::get('empty', function(){
    Cart::destroy();
    return redirect()->route('cart.index');
})->name('cart.empty');

// ----------- AUTHENTICATION ROUTES -----------
Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', 'HomeController@index')->name('index');
    Route::resource('/restaurants', 'RestaurantController');
    Route::resource('/dishes', 'DishController');
});
