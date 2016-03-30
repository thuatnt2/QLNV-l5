<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phone_id')->unsigned();
            $table->foreign('phone_id')->references('id')->on('phones');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('number_cv_pa71')->nullable();
            $table->integer('news')->nullable();
            $table->integer('page_news')->nullable();
            $table->integer('page_list')->nullable();
            $table->integer('page_xmctb')->nullable();
            $table->integer('page_imei')->nullable();
            $table->string('file_name');
            $table->string('receive_name');
            $table->timestamp('date_submit');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ships');
    }
}
