<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('description')->nullable();
          $table->double('amount')->nullable();
          $table->string('icon')->nullable();
          $table->integer('id_money');
          $table->integer('id_user');
          $table->timestamps();
          //foreign key of table money
          $table->foreign('id_money')
          ->references('id')
          ->on('money');
          //foreign key of table user
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
        Schema::dropIfExists('accounts');
    }
}
