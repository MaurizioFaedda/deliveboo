<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyPaymentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('payments', function (Blueprint $table) {
      $table->unsignedBigInteger('order_id')->after('id');
      $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('payments', function (Blueprint $table) {
      // Removing the foreign key constraint: NomeTabella_NomeColonna_foreign
      $table->dropForeign('payments_order_id_foreign');
      // Deleting the column containing the FK
      $table->dropColumn('order_id');
    });
  }
}
