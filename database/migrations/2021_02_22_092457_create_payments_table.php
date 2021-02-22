<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->string('card_owner', 50);
      $table->string('status', 15);
      $table->string('method', 30)->nullable();
      $table->bigInteger('card_number')->unsigned();
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
    Schema::dropIfExists('payments');
  }
}
