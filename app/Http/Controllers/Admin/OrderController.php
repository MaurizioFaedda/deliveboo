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

        // Faccio una query al db per prendere tutti gli ordini dei ristoranti dell'utente loggato dove i pagamenti sono andati a buon fine
        $order_list = Order::select()->whereIn('restaurant_id' , Restaurant::select('id')->where('user_id', $id_user))->whereIn('id' , Payment::select('order_id')->where('status', 'Accepted'))->get();


        // Faccio una query al db per prendere tutte le date di delivery time degli ordini dei ristoranti dell'utente loggato dove i pagamenti sono andati a buon fine
        $delivery_time = Order::select('delivery_time')->whereIn('restaurant_id' , Restaurant::select('id')->where('user_id', $id_user))->whereIn('id' , Payment::select('order_id')->where('status', 'Accepted'))->get();


        // Creo un array di appoggio per salvarmi tutti i delivery time
        $array_date = [];

        // Ciclo la collection di delivery time per estrapolarmi tutte le date e pusharle in array_date
        foreach ($delivery_time as $date) {
            array_push($array_date, $date->delivery_time);
        }

        // Creo un array di appoggio per salvarmi tutti i mesi
        $array_mounth = [];

        // Ciclo l'array delle date per estrapolarmi i mesi e pusharli dentro l'$array_mounth
        for ($i=0; $i < count($array_date); $i++) {
            $mounth = date("m", strtotime($array_date[$i]));
            array_push($array_mounth, $mounth);
        }

        // Ordino l'array dei mesi in modo crescente
        asort($array_mounth);

        // Faccio un count di quante volte c'è una data significa che è la quantità di ordini
        $count = array_count_values($array_mounth);

        // Creo un array dove ci sono i numeri dei mesi dell'anno 
        $mounth = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        // Faccio un match tra i mesi dell'anno e i mesi presenti nell'array dei mesi degli ordini
        $match_results = array_intersect ($mounth, $array_mounth);



        $data = [
            // Lista ristoranti dell'utente
            'restaurants' => $restaurants_list,
            // Lista degli ordini con pagamento ok di tutti i ristoranti dell'utente
            'orders' => $order_list,
            'count' => $count
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
