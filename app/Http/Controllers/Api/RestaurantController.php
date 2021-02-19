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

  // Prendo il parametro che ho passato tramite query string dalla select che è il tipo selezionato dall'utente
  public function filter_restaurants($id)
  {
    if($id) {
      // QUERY per cercare il tipo selezionato dall'utente nella tabella dei tipi
      $type = Type::find($id);
      return response()->json([
          'success' => true,
          'results' => $type->restaurants// relazione MANY TO MANY
      ]);
    } else {
        return response()->json([
            'success' => false,
            'results' => []
        ]);
    }
  }
  public function get_filtered_restaurants(Request $request)
  {
    $filtered_restaurants = [];
    $restaurants_types_array = [];
    // Prendo il parametro che ho passato tramite POST contenente l'array dei tipi selezionati dall'utente nella checkbox
    $checked_types = $request->checked;
    // Ciclo l'array di tipi selezionati dall'utente
    for ($i=0; $i < count($checked_types); $i++) {
      // QUERY per cercare il tipo corrente ciclato all'interno della tabella Types nel DB
      $type = Type::find($checked_types[$i]);
      // Raccolgo in un array tutti i ristoranti con il tipo corrente ciclato
      $restaurants_types_array = $type->restaurants; // relazione MANY TO MANY
      // Ciclo l'array di ristoranti appena creato
      foreach ($restaurants_types_array as $current_restaurant) {
        array_push($filtered_restaurants, $current_restaurant);
      }
    };
    // Creo l'oggetto JSON con l'array dei ristoranti che hanno i tipi selezionati dall'utente
    return response()->json([
      'success' => true,
      'results' => $filtered_restaurants
    ]);
  }
}
