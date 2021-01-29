<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerStatisticsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('estatistica_vendedores', function (Blueprint $table) {
      $table->id('id');
      $table->integer('id_vendedor');
      $table->integer('contador_total');
      $table->timestamp('data_acesso');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('estatistica_vendedores');
  }
}
