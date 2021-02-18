<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Type;

class RestaurantController extends Controller
{
  public function index()
  {
    $restaurants = Restaurant::all();
    return response()->json([
      'success' => true,
      'results' => $restaurants
    ]);
  }

  public function filter_restaurants($id)
  {
    // Prendo il parametro che ho passato tramite query string dalla select che è il tipo selezionato dall'utente
    $type = Type::find($id);
    return response()->json([
        'success' => true,
        'results' => $type->restaurants
    ]);
  }
}
