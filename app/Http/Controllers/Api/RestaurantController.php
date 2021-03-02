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

  // CHECKBOX
  public function get_filtered_restaurants(Request $request)
  {
    $filtered_restaurants = [];
    $restaurants_types_obj = [];
    $final_restaurants_array = [];
    // Prendo il parametro che ho passato tramite POST contenente l'array dei tipi selezionati dall'utente nella checkbox
    $checked_types = $request->checked;
    // Ciclo l'array di tipi selezionati dall'utente
    for ($i=0; $i < count($checked_types); $i++) {
      // QUERY per cercare il tipo corrente ciclato all'interno della tabella Types nel DB
      $type = Type::find($checked_types[$i]);
      // Raccolgo in un oggetto tutti i ristoranti con il tipo corrente ciclato
      $restaurants_types_obj = $type->restaurants; // relazione MANY TO MANY
      // Ciclo l'oggetto contenente i ristoranti che hanno il tipo ciclato
      foreach ($restaurants_types_obj as $current_restaurant) {
        // Aggiungo ogni oggetto/ristorante all'array finale dei ristoranti filtrati
        array_push($filtered_restaurants, $current_restaurant);
      }
    };
    // Rimuovo i duplicati dall'array dei ristoranti filtrati
    $temp_arr_remove_dupes = array_unique(array_column($filtered_restaurants, 'id'));
    $final_restaurants_array = array_intersect_key($filtered_restaurants, $temp_arr_remove_dupes);
    // Creo l'oggetto JSON con l'array dei ristoranti che hanno i tipi selezionati dall'utente
    return response()->json([
      'success' => true,
      'results' => $final_restaurants_array
    ]);
  }
}
