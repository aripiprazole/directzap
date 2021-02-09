<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('colaboradores', function (Blueprint $table) {
      $table->id('id');
      $table->string('nome', 50);
      $table->string('linkpessoa', 250);
      $table->string('link', 250);
      $table->string('mensagem', 150);
      $table->bigInteger('telefone');
      $table->integer('contador');
      $table->boolean('paused')->default(false);
      $table->string('email', 250);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('colaboradores');
  }
}
