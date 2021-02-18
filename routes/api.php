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

Route::get('/types', 'Api\TypeController@index');
Route::get('/restaurants', 'Api\RestaurantController@index');
Route::get('/dishes', 'Api\DishController@index');
// Passo l'ID dei type preso dalla select al Restaurant Controller
Route::get('/restaurants/{id}', 'Api\RestaurantController@filter_restaurants');
