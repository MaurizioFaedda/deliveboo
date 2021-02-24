<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use App\Restaurant;
use App\Dish;

class CartController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('guest.cart');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Prendo l'oggetto della request contenente i piatti ordinati che ho passato tramite POST dal FORM e lo salvo in una variabile
    $id_dishes_obj = $request->dishes_id;
    // Creo un array associativo con gli id dei piatti aggiunti ricavati dall'oggetto della request
    $id_dishes_array = explode(",", $id_dishes_obj[0]);

    // Ciclo l'array degli id dei piatti
    for ($i=0; $i < count($id_dishes_array) ; $i++) {
      // QUERY per cercare il piatto corrente ciclato, all'interno della tabella Dishes nel DB
      $dish = Dish::find($id_dishes_array[$i]);
      // Controllo se il carrello è vuoto
      if(Cart::count() == 0){
        // Se è vuoto aggiungo il primo elemento/piatto al carrello
        Cart::add($dish->id, $dish->name, 1, $dish->price)
        ->associate('App\Dish');
      } else {
        // Se il carrello non è vuoto verifico che il ristorante da cui aggiungo i piatti sia lo stesso del primo piatto

        // salvo in una varibiale la fk del ristorante del piatto appena aggiunto
        $current_restaurant_fk = $dish->restaurant_id;
        // Prendo l'id del primo piatto aggiunto in precedenza nel carrello
        $id = Cart::content()->first()->id;
        // Salvo in una variabile l'id del ristorante del primo piatto aggiunto al carrello
        $first_restaurant_id = Dish::find($id)->restaurant_id;

        // Controllo che la fk del piatto appena aggiunto (quello ciclato) sia uguale all'id del ristorante del primo piatto
        if($current_restaurant_fk == $first_restaurant_id) {
            // Se il ristorante è lo stesso l'utente può procedere ad aggiungere il piatto all'ordine/carrello
            Cart::add($dish->id, $dish->name, 1, $dish->price)
            ->associate('App\Dish');
        } else {
            // Se il ristorante è diverso l'utente non può procedere ad aggiungere il piatto e lo reindirizzo alla pagina di visualizzazione dell'ordine completo
            return redirect()->route('cart.index')->with('error_message', 'Your food was NOT added to your cart!');
        }
      }
    }
    // Reindirizzo l'utente alla pagina di visualizzazione dell'ordine completo
    return redirect()->route('cart.index')->with('success_message', 'Your food was added to your cart!');

      // $duplicates = Cart::search(function($cartItem, $rowId) use ($request){
      //     return $cartItem->id === $request->id;
      // });
      //
      //
      //
      // if($duplicates->isNotEmpty()){
      //     return redirect()->route('cart.index')->with('success_message', 'Dish is already in your cart!');
      // }
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      return $request->all();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Cart::remove($id);

    return back()->with('success_message', 'Item has been removed!');
  }
}
