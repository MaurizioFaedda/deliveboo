<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dish;
use App\User;
use App\Restaurant;
use DB;

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
      $query = $request->input('restaurant');

      $data = [
        'restaurants' => Restaurant::all(),
        'query' => $query
      ];
      return view('admin.dishes.create', $data);
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
        'name' => 'required|max:30',
        'infos' => 'required|max:250',
        'visible' => 'required',
        'price' => 'required|numeric|between:0,999.99',
      ]);

      // Storing all form data in a variable
      $form_data = $request->all();
      // Creating a new Object/Instance with the form data
      $new_dish = new Dish();
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

    // // Prendo l'id dell'utente autenticato
    // $id_user = Auth::user()->id;
    //
    // // Query per prendere il piatto cliccato
    // $dish = Dish::where('id', $id)->first();
    //
    // // Controllo che il Piatto visualizzato sia dell'utente autenticato e che il piatto esista
    // if($id_user == $restaurant->user_id && $dish) {
    //
    //     $data = [
    //         'dish' => $dish
    //     ];
    //
    //     return view('admin.dishes.show', $data);
    // } else {
    //     abort('404');
    // }

    // Prendo l'id dell'utente autenticato
    $id_user = Auth::user()->id;

    // Prendo l'id dell'utente nella tabella restaurants
    $myqueryrestaurant = DB::table('restaurants')->select('user_id')->where('id', '=', $id_user)->orderBy('id','desc')->get();
    $id_user_fk = $myqueryrestaurant[0]->user_id;


    // Prendo l'id del ristorante nella tabella dishes
    $myquerydish = DB::table('dishes')->select('restaurant_id')->where('id', '=', $id_user_fk)->orderBy('id','desc')->get();
    $id_restaurant_fk = $myquerydish[0]->restaurant_id;

    // Prendo l'id di ristorante nella tabella ristoranti che deve essere uguale al l'id di ristoranti nella tabella piatti
    $pippo = DB::table('restaurants')->select('id')->where('id', '=', $id_restaurant_fk)->and('user_id', '=', $id_user)->orderBy('id','desc')->get();
    dd($pippo);

    // Query per prendere il piatto cliccato
    $dish = Dish::where('id', $id)->first();

    // Controllo che il Piatto visualizzato sia dell'ruistorante cliccato e che il piatto esista
    if($id_user_fk == $id_user && $dish ) {

        $data = [
            'dish' => $dish
        ];

        return view('admin.dishes.show', $data);
    } else {
        abort('404');
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
  public function destroy($id)
  {
      //
  }
}
