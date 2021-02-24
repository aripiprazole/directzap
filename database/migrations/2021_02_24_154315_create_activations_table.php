<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivationsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('activations', function (Blueprint $table) {
      $table->id();
      $table->string('code');
      $table->enum('type', ['automatic', 'manual', 'infinite'])->default('manual');
      $table->boolean('used')->default(false);
      $table->boolean('expired')->default(false);
      $table->timestamps();

      $table->unsignedBigInteger('user_id')->nullable();

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
    Schema::dropIfExists('activations');
  }
}
