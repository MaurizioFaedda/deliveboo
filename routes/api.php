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
  // Passo l'ID dei type preso dalla select al Restaurant Controller
  Route::get('/restaurants/{id}', 'RestaurantController@filter_restaurants');
  // Passo l'ID dell'array dei types preso dalla checkbox all'API Restaurant Controller
  Route::post('/restaurants/', 'RestaurantController@get_filtered_restaurants');
});
