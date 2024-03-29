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
    Schema::create('collaborators', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('phone');
      $table->string('email');
      $table->string('message');
      $table->integer('total_count');
      $table->integer('fill_count');
      $table->integer('status');
      $table->timestamps();

      $table->unsignedBigInteger('user_id');

      $table
        ->foreign('user_id')
        ->references('id')
        ->on('users');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('collaborators');
  }
}
