<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dish;
use App\User;
use App\Restaurant;

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

<<<<<<< HEAD
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
    // Reindirizzamento alla pagina dell'elenco di tutti i piatti del ristorante
    return redirect()->route('admin.restaurants.index');
  }
=======
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
>>>>>>> dishes_create_index

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
