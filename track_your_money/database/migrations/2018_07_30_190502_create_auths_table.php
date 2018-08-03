<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auths', function (Blueprint $table) {
          $table->bigInteger('id');
          $table->string('service');
          $table->string('token');
          $table->integer('id_user');
          $table->timestamps();
          //foreign key of table user
          $table->primary('id');
          $table->foreign('id_user')
          ->references('id')
          ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auths');
    }
}
