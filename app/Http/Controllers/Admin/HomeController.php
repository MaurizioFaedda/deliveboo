<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\User;
use App\Type;
use App\Payment;
use App\Order;

class HomeController extends Controller
{

    function getallMounth()
    {
        // Prendo l'id dell'utente autenticato
        $id_user = Auth::user()->id;

        // Faccio una query al db per prendere tutti i ristoranti con l'id user dell'utente loggato
        $restaurants_list = Restaurant::select()->where('user_id', $id_user)->get();

        // Faccio una query al db per prendere tutti gli ordini dei ristoranti dell'utente loggato dove i pagamenti sono andati a buon fine in ordine di delivery time
        $orders_list = Order::orderBy('delivery_time')->whereIn('restaurant_id' , Restaurant::select('id')->where('user_id', $id_user))->whereIn('id' , Payment::select('order_id')->where('status', 'Accepted'))->get();

        $delivery_time = Order::select('delivery_time')->orderBy('delivery_time')->whereIn('restaurant_id' , Restaurant::select('id')->where('user_id', $id_user))->whereIn('id' , Payment::select('order_id')->where('status', 'Accepted'))->get();

        // Creo un array di appoggio per salvarmi tutti i delivery time
        $array_date = [];

        // Ciclo la collection di delivery time per estrapolarmi tutte le date e pusharle in array_date
        foreach ($delivery_time as $date) {
            array_push($array_date, $date->delivery_time);
        }

        $array_mounth =[];
        foreach ($array_date as $unfomatted_date) {
            $date = new \DateTime($unfomatted_date);
            $mounth_number = $date->format('m');
            $mounth_name = $date->format('M');
            $array_mounth[$mounth_number] = $mounth_name;
        }

        return $array_mounth;
    }

    function getMonthlyOrdersCount($mounth){
        // Prendo l'id dell'utente autenticato
        $id_user = Auth::user()->id;

        // Faccio una query al db per prendere tutti i ristoranti con l'id user dell'utente loggato
        $restaurants_list = Restaurant::select()->where('user_id', $id_user)->get();

        $mounthly_orders_count = Order::whereMonth('delivery_time', $mounth)->whereIn('restaurant_id' , Restaurant::select('id')->where('user_id', $id_user))->whereIn('id' , Payment::select('order_id')->where('status', 'Accepted'))->get()->count();

        return $mounthly_orders_count;
    }

    function getMonthlyOrdersData(){
        $mounthly_orders_count_array = [];
        $mounth_name_array = [];

        $array_mounth = $this->getallMounth();

        if (!empty($array_mounth)) {
            foreach ($array_mounth as $mounth_number => $mounth_name) {
                $mounthly_orders_count = $this->getMonthlyOrdersCount($mounth_number);
                array_push($mounthly_orders_count_array, $mounthly_orders_count);
                array_push($mounth_name_array, $mounth_name);
            }
        }

        // Prendo l'id dell'utente autenticato
        $id_user = Auth::user()->id;

        // Faccio una query al db per prendere tutti i ristoranti con l'id user dell'utente loggato
        $restaurants_list = Restaurant::select()->where('user_id', $id_user)->get();

        // Faccio una query al db per prendere tutti gli ordini dei ristoranti dell'utente loggato dove i pagamenti sono andati a buon fine in ordine di delivery time
        $orders_list = Order::orderBy('delivery_time')->whereIn('restaurant_id' , Restaurant::select('id')->where('user_id', $id_user))->whereIn('id' , Payment::select('order_id')->where('status', 'Accepted'))->get();


        $data = [
            'countRestaurants'=> Restaurant::where('user_id', $id_user)->count(),
            'types' => Type::all(),
            'mounths' => $mounth_name_array,
            'orders_count_date' => $mounthly_orders_count_array,
            // Lista ristoranti dell'utente
            'restaurants' => $restaurants_list,
            // Lista degli ordini con pagamento ok di tutti i ristoranti dell'utente
            'orders' => $orders_list,
        ];

        return view('admin.home', $data);

    }
}
