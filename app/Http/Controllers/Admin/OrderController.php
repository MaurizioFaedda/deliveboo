<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\User;
use App\Order;
use App\Payment;

class OrderController extends Controller
{
    public function index()
    {
        // Prendo l'id dell'utente autenticato
        $id_user = Auth::user()->id;

        // Faccio una query al db per prendere tutti i ristoranti con l'id user dell'utente loggato
        $restaurants_list = Restaurant::select()->where('user_id', $id_user)->get();

        // Faccio una query al db per prendere tutti gli ordini dei ristoranti dell'utente loggato dove i pagamenti sono andati a buon fine in ordine di delivery time
        $orders_list = Order::orderBy('delivery_time')->whereIn('restaurant_id' , Restaurant::select('id')->where('user_id', $id_user))->whereIn('id' , Payment::select('order_id')->where('status', 'Accepted'))->get();


        $data = [
            // Lista ristoranti dell'utente
            'restaurants' => $restaurants_list,
            // Lista degli ordini con pagamento ok di tutti i ristoranti dell'utente
            'orders' => $orders_list,
        ];

        return view('admin.orders.index', $data);
    }


}
