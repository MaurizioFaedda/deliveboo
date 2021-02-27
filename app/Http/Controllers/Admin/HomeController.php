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

        // Creo un array vuoto per i mesi
        $array_mounth =[];

        // Se l'array delle date non è vuoto
        if (!empty($array_date)) {
            // Ciclo l'array delle date e ad ogni ciclo formatto il mese sia in modo numerico sia in caratteri
            foreach ($array_date as $unfomatted_date) {
                // Salvo la data che sto ciclando in una variabile
                $date = new \DateTime($unfomatted_date);
                // Salvo il mese nel formato numero
                $mounth_number = $date->format('m');
                // Sakvo il mese in formato caratteri
                $mounth_name = $date->format('M');
                // Faccio push nell'array dei mesi come chiave il numero del mese e come valore il nome del mese
                $array_mounth[$mounth_number] = $mounth_name;
            }
        }

        // Faccio return dell'array con tutti i mesi (chiave-valore)
        return $array_mounth;
    }

    function getMonthlyOrdersCount($mounth){
        // Prendo l'id dell'utente autenticato
        $id_user = Auth::user()->id;

        // Faccio una query al db per prendere tutti i ristoranti con l'id user dell'utente loggato
        $restaurants_list = Restaurant::select()->where('user_id', $id_user)->get();

        // Faccio una query al db Per prendermi dalla colonna delivery time solo il mese che voglio con la varibiale mounth
        $mounthly_orders_count = Order::whereMonth('delivery_time', $mounth)->whereIn('restaurant_id' , Restaurant::select('id')->where('user_id', $id_user))->whereIn('id' , Payment::select('order_id')->where('status', 'Accepted'))->get()->count();

        return $mounthly_orders_count;
    }

    function getMonthlyOrdersData(){
        // Array di quante volte l'ordine è presente
        $mounthly_orders_count_array = [];
        // Array dei nome dei mesi
        $mounth_name_array = [];

        // Richiamo la funzione per prendere tutti i mesi
        $array_mounth = $this->getallMounth();

        // Se l'array di mesi non è vuoto
        if (!empty($array_mounth)) {
            // Ciclo l'array dei mesi e aggiunto la chiave e il valore (numero - nome)
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
            // Lista dei ristorani che ha quello user
            'countRestaurants'=> Restaurant::where('user_id', $id_user)->count(),
            // Lista dei tipi
            'types' => Type::all(),
            // Lista di tutti i mesi degli ordini
            'mounths' => $mounth_name_array,
            // Lista di quanti ordini ci sono per mese
            'orders_count_date' => $mounthly_orders_count_array,
            // Lista ristoranti dell'utente
            'restaurants' => $restaurants_list,
            // Lista degli ordini con pagamento ok di tutti i ristoranti dell'utente
            'orders' => $orders_list,
        ];

        return view('admin.home', $data);

    }
}
