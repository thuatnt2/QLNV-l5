<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipsNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships_news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ship_id')->unsigned();
            $table->foreign('ship_id')->references('id')->on('ships');
            $table->integer('number_cv');
            $table->integer('number_news');
            $table->string('file_name');
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
        Schema::drop('ships_news');
    }
}
