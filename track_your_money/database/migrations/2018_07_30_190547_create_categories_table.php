<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name',30);
          $table->string('description')->nullable();
          $table->string('icon',60)->nullable();;
          $table->integer('id_user');
          $table->timestamps();
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
        Schema::dropIfExists('categories');
    }
}
