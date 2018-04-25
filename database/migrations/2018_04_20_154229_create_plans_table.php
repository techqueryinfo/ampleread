<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->nullable();
            $table->text('desc')->nullable();
            $table->double('amount')->nullable();
            $table->string('status');
            $table->integer('access_time_period')->nullable();
            $table->string('access_period_type');
            $table->integer('no_of_book_download')->nullable();
            $table->string('publish_submit_book')->nullable();
            $table->integer('read_ebook_directly')->nullable();
            $table->integer('create_books')->nullable();
            $table->integer('share_books')->nullable();
            $table->integer('access_discount')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plans');
    }
}
