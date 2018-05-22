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
            $table->integer('plan_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('customer_id')->unsigned()->index();
            $table->integer('charge_id')->unsigned()->index();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->integer('transactionId')->unsigned()->index();
            $table->integer('orderNumber')->unsigned()->index();
            $table->timestamps();
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
