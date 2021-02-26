<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\User;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Prendo l'id dell'utente autenticato
        $id_user = Auth::user()->id;

        // Faccio una query al db per prendere tutti i ristoranti con l'id user dell'utente loggato
        $restaurants_list = Restaurant::select()->where('user_id', $id_user)->get();

        // Faccio una query al db per prendere tutti gli ordini dei ristoranti dell'utente loggato
        $order_list = Order::select()->whereIn('restaurant_id' , Restaurant::select('id')->where('user_id', $id_user))->get();

        $prova = [7,3,8,5,6];

        $data = [
            // Lista ristoranti dell'utente
            'restaurants' => $restaurants_list,
            // Lista degli ordini di tutti i ristoranti dell'utente
            'orders' => $order_list,
            'prova' => $prova
        ];

        return view('admin.orders.index', $data);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
