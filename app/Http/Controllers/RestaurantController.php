<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Type;
use App\Dish;

class RestaurantController extends Controller
{
  public function show($id) {
    // QUERY per trovare il ristorante di cui mi passo l'id come parametro
    $restaurant = Restaurant::where('id', $id)->first();
    // QUERY per prendere tutti i tipi relativi al ristorante visualizzato
    $types = $restaurant->types;
    // QUERY per prendere tutti i piatti del ristorante visualizzato
    $dishes = $restaurant->dishes;
    // Controllo che il ristorante esista
    if(!$restaurant) {
      abort(404);
    }
    $data = [
      'restaurant' => $restaurant,
      'types' => $types,
      'dishes' => $dishes
    ];
    return view('guest.restaurants.show', $data);
  }
}
