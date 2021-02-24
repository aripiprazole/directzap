<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('configurations', function (Blueprint $table) {
      $table->id();
      $table->integer('conv_per_user')->default(4);
      $table->string('pix')->nullable();
      $table->integer('max_collaborators')->default(8);
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
    Schema::dropIfExists('configurations');
  }
}
