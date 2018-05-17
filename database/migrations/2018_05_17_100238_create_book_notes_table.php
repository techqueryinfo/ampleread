<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('book_id')->unsigned()->index();
            $table->text('note')->nullable();
            $table->string('added_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_notes');
    }
}
