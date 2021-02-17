<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use App\Type;

class RestaurantTypeTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Tutte le QUERY per prendere tutti i ristoranti del file config
    $restaurant1 = Restaurant::find(1);
    $restaurant2 = Restaurant::find(2);
    $restaurant3 = Restaurant::find(3);
    $restaurant4 = Restaurant::find(4);
    $restaurant5 = Restaurant::find(5);
    $restaurant6 = Restaurant::find(6);
    $restaurant7 = Restaurant::find(7);
    $restaurant8 = Restaurant::find(8);
    $restaurant9 = Restaurant::find(9);
    $restaurant10 = Restaurant::find(10);

    // Attribuisco le varie tipologie ai ristoranti
    $restaurant1->types()->sync([1, 2, 6]);
    $restaurant2->types()->sync([2, 6]);
    $restaurant3->types()->sync([3, 7]);
    $restaurant4->types()->sync([4, 5, 6, 9]);
    $restaurant5->types()->sync([4, 5, 6]);
    $restaurant6->types()->sync([5, 6]);
    $restaurant7->types()->sync([4, 6, 7]);
    $restaurant8->types()->sync([2, 4, 6, 8]);
    $restaurant9->types()->sync([4, 6, 7, 8]);
    $restaurant10->types()->sync([3, 4, 5, 7, 9]);
  }
}
