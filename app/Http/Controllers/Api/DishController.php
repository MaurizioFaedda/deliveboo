<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;

class DishController extends Controller
{
  public function index()
  {
    $dishes = Dish::all();
    return response()->json([
      'success' => true,
      'results' => $dishes
    ]);
  }

  public function cart_dish($id)
  {
    if($id) {
      // QUERY per cercare il piatto selezionato dall'utente nella tabella dei piatti
      $dish = Dish::find($id);
      return response()->json([
          'success' => true,
          'results' => $dish
      ]);
    } else {
        return response()->json([
            'success' => false,
            'results' => []
        ]);
    }
  }
}
