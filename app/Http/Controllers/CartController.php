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
        // dd(Cart::content());
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
        // $duplicates = Cart::search(function($cartItem, $rowId) use ($request){
        //     return $cartItem->id === $request->id;
        // });
        //
        //
        //
        // if($duplicates->isNotEmpty()){
        //     return redirect()->route('cart.index')->with('success_message', 'Dish is already in your cart!');
        // }


        // Controllo che il carrello sia vuoto
        if(Cart::count() == 0){

            //  Aggiungiamo il primo elemento
            Cart::add($request->id, $request->name, 1, $request->price)
            ->associate('App\Dish');

            return redirect()->route('restaurant.show', ['id' => $request->restaurant_id])->with('success_message', 'Your food was added to your cart!');

        }else{
            // Se il carrello non è vuoto faccio la verifica dell'id ristorante del primo elemtnto con quello che voglio aggiungere

            // salvo in una varibiale la fk del ristorante del piatto appena aggiunto
            $current_restaurant_fk = $request->restaurant_id;

            // Prendiamo l'id del primo piatto aggiunto in precedenza nel carrello
            $id = Cart::content()->first()->id;

            // Salviamo l'id del ristorante del primo piatto aggiunto al carrello
            $first_restaurant_id = Dish::find($id)->restaurant_id;


            // Controllo che la fk del piatto appena aggiunto sia uguale al id del ristorante del primo piatto
            if($current_restaurant_fk == $first_restaurant_id) {

                // Se il piatto passa i controlli dell'if lo aggiungo al carrello
                Cart::add($request->id, $request->name, 1, $request->price)
                ->associate('App\Dish');
                return redirect()->route('restaurant.show', ['id' => $request->restaurant_id])->with('success_message', 'Your food was added to your cart!');

            }else{
                // Se non rispetta le condizioni faccio return della pagina del ristorante dove può continuare a continuare l'ordine 
                return redirect()->route('restaurant.show', ['id' => $first_restaurant_id])->with('success_message', 'Your food was added to your cart!');
            }
        }
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
