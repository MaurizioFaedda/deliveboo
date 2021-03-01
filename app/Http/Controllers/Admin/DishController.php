<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dish;
use App\User;
use App\Restaurant;
use DB;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
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
  public function create(Request $request)
  {
    /*
    // FORM aggiunto nella show di "restaurants"
    $query = $request->input('restaurant');

    $data = [
    'restaurants' => Restaurant::all(),
    'query' => $query
    ];
    return view('admin.dishes.create', $data);
    */
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
    'name' => 'required|max:100',
    'infos' => 'required|max:250',
    'visible' => 'required',
    'price' => 'required|numeric|between:0,999.99',
    'image' => 'nullable| mimes:jpeg,jpg,png,webp|max:512',
    // Validation FK to be sure that the ID restaurant sent is an existing restaurant ID
    'restaurant_id' => 'required|numeric|exists:restaurants,id',
    ]);

    // Storing all form data in a variable
    $form_data = $request->all();
    // Creating a new Object/Instance with the form data
    $new_dish = new Dish();

    // verifico se è stata caricata un'immagine
    if(array_key_exists('image', $form_data)) {
        // salvo l'immagine e recupero la path
        $cover_path = Storage::put('images', $form_data['image']);
        $form_data['img_path_dish'] = $cover_path;

    }

    $new_dish->fill($form_data);
    // Saving the new Object/Instance in the database
    $new_dish->save();
    // Redirecting to the view with all posts
    $restaurant_id = $request->restaurant_id;
    return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant_id]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    // Prendo l'id dell'utente autenticato
    $current_user = Auth::user()->id;

    // SELECT * FROM dishes WHERE 'id' = $id (variabile passata)
    $current_dish = Dish::find($id);
    // Prendo il ristorante corrente dalla Collection $current_dish
    $current_restaurant_fk = $current_dish->restaurant_id;

    // QUERY per prendere l'array dei ristoranti dell'utente corrente
    $array_restaurants_user = Restaurant::where('user_id', $current_user)->get();
    $current_restaurant_id = '';
    $current_user_fk = '';
    // Ciclo l'array delle collections dei ristoranti dell'utente loggato
    foreach ($array_restaurants_user as $restaurant) {
      // Controllo che l'id del ristorante ciclato è uguale all'FK del ristorante del piatto corrente
      if ($restaurant->id == $current_restaurant_fk) {
        // salvo in una variabile l'id del ristorante
        $current_restaurant_id = $restaurant->id;
        // salvo in una variabile la FK dell'utente della tabella ristorante
        $current_user_fk = $restaurant->user_id;
      }
    }

    // Controllo che il piatto corrente esista && che appartenga al ristorante corrente && che il ristorante sia dell'utente loggato
    if($current_dish && $current_restaurant_fk == $current_restaurant_id && $current_user == $current_user_fk) {
    $data = [
      'dish' => $current_dish,
      'restaurant' => $current_restaurant_id
    ];
    return view('admin.dishes.show', $data);
    }
    abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    // Prendo l'id dell'utente autenticato
    $current_user = Auth::user()->id;

    // SELECT * FROM dishes WHERE 'id' = $id (variabile passata)
    $current_dish = Dish::find($id);
    // Prendo il ristorante corrente dalla Collection $current_dish
    $current_restaurant_fk = $current_dish->restaurant_id;

    // QUERY per prendere l'array dei ristoranti dell'utente corrente
    $array_restaurants_user = Restaurant::where('user_id', $current_user)->get();
    $current_restaurant_id = '';
    $current_user_fk = '';
    // Ciclo l'array delle collections dei ristoranti dell'utente loggato
    foreach ($array_restaurants_user as $restaurant) {
      // Controllo che l'id del ristorante ciclato è uguale all'FK del ristorante del piatto corrente
      if ($restaurant->id == $current_restaurant_fk) {
        // salvo in una variabile l'id del ristorante
        $current_restaurant_id = $restaurant->id;
        // salvo in una variabile la FK dell'utente della tabella ristorante
        $current_user_fk = $restaurant->user_id;
      }
    }

    // Controllo che il piatto corrente esista && che appartenga al ristorante corrente && che il ristorante sia dell'utente loggato
    if($current_dish && $current_restaurant_fk == $current_restaurant_id && $current_user == $current_user_fk) {
      $data = [
        'dish' => $current_dish,
      ];
      return view('admin.dishes.edit', $data);
    }
    abort(404);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Dish $dish)
  {
    $request->validate([
      'name' => 'required|max:100',
      'infos' => 'required|max:250',
      'visible' => 'required',
      'price' => 'required|numeric|between:0,999.99',
      'image' => 'nullable| mimes:jpeg,jpg,png,webp|max:512',
    ]);
    // I dati ricevuti dal form
    $form_data = $request->all();
    // verifico se è stata caricata un'immagine
    if(array_key_exists('image', $form_data)) {
        // salvo l'immagine e recupero la path
        $cover_path = Storage::put('images', $form_data['image']);
        $form_data['img_path_dish'] = $cover_path;
    }

    // Faccio un update dei dati di dish
    $dish->update($form_data);
    // New QUERY to select the latest dish added in the DB to be sure to redirect to the very last order entered
    $last_dish = Dish::orderBy('id', 'desc')->first();
    // Faccio redirect alla pagina del piatto appena mdificato
    return redirect()->route('admin.dishes.show', ['dish' => $last_dish->id]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Dish $dish)
  {
    $current_restaurant = $dish->restaurant_id;
    // Prima di cancellare il piatto vado a cancellare la relazione che c'è tra il piatto e ristorante
    $dish->restaurant()->dissociate('restaurant_id');
    // Cancello il piatto
    $dish->delete();
    return redirect()->route('admin.restaurants.show', ['restaurant' => $current_restaurant]);
  }
}
