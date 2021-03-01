<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Restaurant;
use Carbon\Carbon;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
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
    $request->validate([
      'email' => 'required|email|max:30',
      'delivery_time' => 'required|date_format:"Y-m-d\TH:i"|after:now',
      'total_price' => 'required|numeric|between:0,99.9999',
      'mobile' => 'required|integer|digits_between:8,15',
      'first_name' => 'required|max:50',
      'lastname' => 'required|max:50',
      'address' => 'required|max:100',
      'notes' => 'nullable|max:255',
      // Validation FK to be sure that the ID restaurant sent is an existing restaurant ID
      'restaurant_id' => 'required|numeric|exists:restaurants,id',
    ]);

    // Storing all form data in a variable
    $form_data = $request->all();
    // Creating a new Object/Instance with the form data
    $new_order = new Order();
    // Filling in the new Object/Instance with the form data received
    $new_order->fill($form_data);
    // Saving the new Object/Instance in the database
    $new_order->save();
    // New QUERY to select the latest order added in the DB to be sure to redirect to the very last order entered
    $last_entered_order = Order::orderBy('id', 'desc')->first();
    // Redirecting to the web page of the latest order entered containing order confirmation and summary information
    return redirect()->route('orders.show', ['order' => $new_order->id]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Order $order)
  {
    {
      // Checking that the order ID is valid (Find restituisce NULL se non lo è)
      if($order) {
        $data = [
          'order' => $order,
        ];
        return view('guest.orders.show', $data);
      }
      abort(404);
    }
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
  public function destroy(Order $order)
  {
    // Risalgo al ristorante corrente tramite FK nella tabella Orders
    $current_restaurant = $order->restaurant_id;
    // Prima di cancellare l'ordine vado a cancellare la relazione che c'è tra l'ordine e il ristorante
    $order->restaurant()->dissociate('restaurant_id');
    // Cancello l'ordine
    $order->delete();
    // Redireting to the Homepage
    return redirect()->route('index');
  }
}
