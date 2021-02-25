<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string('email', 30);
      $table->dateTime('delivery_time');
      $table->float('total_price', 6, 2);
      $table->string('mobile', 15);
      $table->string('first_name', 50);
      $table->string('lastname', 50);
      $table->string('address', 100);
      $table->string('notes')->nullable();
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
    Schema::dropIfExists('orders');
  }
}
