<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('restaurants', function (Blueprint $table) {
      $table->id();
      $table->string('restaurant_name', 30);
      $table->string('city', 20);
      $table->string('address', 50);
      $table->string('img_path_rest');
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
    Schema::dropIfExists('restaurants');
  }
}
