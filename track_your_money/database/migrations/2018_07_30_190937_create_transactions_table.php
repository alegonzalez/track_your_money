<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('description')->nullable();
          $table->date('date_transaction');
          $table->double('amount');
          $table->double('amount_actual');
          $table->integer('id_user');
          $table->integer('id_type_action');
          $table->integer('id_account');
          $table->integer('id_category');
          $table->integer('id_money');
          $table->timestamps();
          //foreign key of table user
          $table->foreign('id_user')
          ->references('id')
          ->on('users');
          //foreign key of table type_actions
          $table->foreign('id_type_action')
          ->references('id')
          ->on('type_actions');
          //foreign key of table account
          $table->foreign('id_account')
          ->references('id')
          ->on('accounts');
          //foreign key of table categories
          $table->foreign('id_category')
          ->references('id')
          ->on('categories');
          //foreign key of table categories
          $table->foreign('id_money')
          ->references('id')
          ->on('money');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
