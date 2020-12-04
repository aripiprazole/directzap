<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('usuarios', function (Blueprint $table) {
      $table->id('id');
      $table->string('nome', 250);
      $table->string('email');
      $table->string('Sobrenome', 250);
      $table->string('status', 250);
      $table->integer('role');
      $table->string('senha', 300);
      $table->integer('next');
      $table->timestamp('tempo')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('usuarios');
  }
}
