<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('dishes', function (Blueprint $table) {
      $table->id();
      $table->string('name', 30);
      $table->string('infos', 250);
      $table->tinyInteger('visible')->default(1);
      $table->float('price', 5, 2);
      $table->string('img_path_dish');
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
    Schema::dropIfExists('dishes');
  }
}
