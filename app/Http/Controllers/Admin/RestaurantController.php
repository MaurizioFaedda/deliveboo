<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\User;
use App\Type;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
      'restaurant_name' => 'required|max:100',
      'city' => 'required|max:20',
      'address' => 'required|max:50',
      'description' => 'nullable',
      'image' => 'nullable| mimes:jpeg,jpg,png|max:512',
      'types' => 'exists:types,id',
    ]);
    // Storing all form data in a variable
    $form_data = $request->all();
    // Creating a new Object/Instance with the form data
    $new_restaurant = new Restaurant();

    // verifico se è stata caricata un'immagine
    if(array_key_exists('image', $form_data)) {
        // salvo l'immagine e recupero la path
        $cover_path = Storage::put('images', $form_data['image']);
        $form_data['img_path_rest'] = $cover_path;
    }

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
  public function show(Restaurant $restaurant)
  {
    // Prendo l'id dell'utente autenticato
    $id_user = Auth::user()->id;
    $data = [
        'types' => Type::all(),
    ];
    // Controllo che il parametro nell'url (ossia l'id del ristorante corrente) esista
    if ($restaurant != null) {
      // Controllo che il Ristorante visualizzato sia dell'utente autenticato
      if($id_user == $restaurant->user_id) {
        return view('admin.restaurants.show', ['restaurant' => $restaurant], $data);
      } else {
        // Se l'utente loggato cerca di visualizzare un ristorante che non è il suo l'errore è un 403 (non ha i permessi)
        abort(403);
      }
    } else {
      // Se il ristorante non esiste l'errore è un 404
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
  public function destroy(Restaurant $restaurant)
  {
    // Removing all the types connected to the restaurant to be deleted
    $restaurant->types()->sync([]);
    // Deleting the restaurant
    $restaurant->delete();
    return redirect()->route('admin.restaurants.index');
  }
}
