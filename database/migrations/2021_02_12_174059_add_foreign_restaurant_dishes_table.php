<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignRestaurantDishesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('dishes', function (Blueprint $table) {
      $table->unsignedBigInteger('restaurant_id')->after('price');
      $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('dishes', function (Blueprint $table) {
      // Removing the foreign key constraint: NomeTabella_NomeColonna_foreign
      $table->dropForeign('dishes_restaurant_id_foreign');
      // Deleting the column containing the FK
      $table->dropColumn('restaurant_id');
    });
  }
}
