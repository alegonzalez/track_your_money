<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('description')->nullable();
          $table->string('icon')->nullable();;
          $table->integer('id_category');
          $table->integer('id_user');
          $table->integer('id_sub_category')->nullable();
          $table->timestamps();
          //foreign key of table sub_category
          $table->foreign('id_sub_category')
          ->references('id')
          ->on('subcategories');
          //foreign key of table category
          $table->foreign('id_category')
          ->references('id')
          ->on('categories');
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
        Schema::dropIfExists('subcategories');
    }
}
