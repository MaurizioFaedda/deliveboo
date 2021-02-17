<?php

use Illuminate\Database\Seeder;
use App\Dish;
use App\Restaurant;

class DishesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $dishes = config('dishes');

    foreach ($dishes as $dish) {
      $new_dish_obj = new Dish();
      $new_dish_obj->name = $dish['name'];
      $new_dish_obj->infos = $dish['infos'];
      $new_dish_obj->visible = $dish['visible'];
      $new_dish_obj->price = $dish['price'];
      $new_restaurant_obj->img_path_dish = $restaurant['img_path_dish'];
      $new_dish_obj->restaurant_id = $dish['restaurant_id'];
      $new_dish_obj->save();
    }
  }
}
