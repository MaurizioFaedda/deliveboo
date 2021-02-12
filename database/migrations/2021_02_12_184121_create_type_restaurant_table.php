<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeRestaurantTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('type_restaurant', function (Blueprint $table) {
      $table->unsignedBigInteger('restaurant_id');
      // Creating the foreign key constraint to connect "restaurants" table
      $table->foreign('restaurant_id')->references('id')->on('restaurants');
      $table->unsignedBigInteger('type_id');
      // Creating the foreign key constraint to connect "types" table
      $table->foreign('type_id')->references('id')->on('types');
      // Creating PRIMARY KEY: composta da entrambe le colonne insieme
      $table->primary(['restaurant_id', 'type_id']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('type_restaurant');
  }
}
