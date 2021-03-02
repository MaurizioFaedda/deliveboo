<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function() {
  Route::get('/types', 'TypeController@index');
  Route::get('/restaurants', 'RestaurantController@index');
  Route::get('/dishes', 'DishController@index');

  // Passo l'ID dell'array dei types preso dalla checkbox all'API Restaurant Controller
  Route::post('/restaurants/', 'RestaurantController@get_filtered_restaurants');
  // Passo l'array dell'id dei piatti da aggiungere al carrello
  Route::get('/dish/{id}', 'DishController@cart_dish');

});
