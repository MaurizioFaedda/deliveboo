<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $types = config('types');

    foreach ($types as $type) {
      $new_type_obj = new Type();
      $new_type_obj->type = $type['type'];
      $new_type_obj->notes = $type['notes'];
      $new_type_obj->save();
    }
  }
}
