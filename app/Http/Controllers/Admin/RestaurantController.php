<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\User;
use App\Type;
use Illuminate\Support\Facades\Auth;


class RestaurantController extends Controller
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
    // QUERY per ricavare i ristoranti dell'utente: se sono più di uno si usa il GET()
    $restaurants_list = Restaurant::where('user_id', $id_user)->get();
    $data = [
      'restaurants' => $restaurants_list
    ];
    return view('admin.restaurants.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data = [
      'types' => Type::all(),
    ];
    return view('admin.restaurants.create', $data);
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
      'restaurant_name' => 'required|max:30',
      'city' => 'required|max:20',
      'address' => 'required|max:50',
      'types' => 'exists:types,id'
    ]);
    // Storing all form data in a variable
    $form_data = $request->all();
    // Creating a new Object/Instance with the form data
    $new_restaurant = new Restaurant();
    $new_restaurant->fill($form_data);
    // Prendo l'id dell'utente autenticato
    $id_user = Auth::user()->id;
    $new_restaurant->user_id = $id_user;
    // Saving the new Object/Instance in the database
    $new_restaurant->save();
    // Se non ci sono types non deve dare errore
    if(array_key_exists('types', $form_data)) {
      $new_restaurant->types()->sync($form_data['types']);
    }
    // Redirecting to the view with all posts
    return redirect()->route('admin.restaurants.index');
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
