<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $restaurants = config('restaurants');

    foreach ($restaurants as $restaurant) {
      $new_restaurant_obj = new Restaurant();
      $new_restaurant_obj->restaurant_name = $restaurant['restaurant_name'];
      $new_restaurant_obj->city = $restaurant['city'];
      $new_restaurant_obj->address = $restaurant['address'];
      $new_restaurant_obj->img_path_rest = $restaurant['img_path_rest'];
      $new_restaurant_obj->user_id = $restaurant['user_id'];
      $new_restaurant_obj->save();
    }
  }
}
