<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/restaurant/{id}', 'RestaurantController@show')->name('restaurant.show');
// Rotte Cart Controller
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::get('empty', function(){
    Cart::destroy();
});


// ----------- AUTHENTICATION ROUTES -----------
Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', 'HomeController@index')->name('index');
    Route::resource('/restaurants', 'RestaurantController');
    Route::resource('/dishes', 'DishController');
});
