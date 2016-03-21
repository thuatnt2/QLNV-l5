<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipNetworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_network', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ship_id')->unsigned();
            $table->foreign('ship_id')->references('id')->on('ships')->onDelete('cascade');
            $table->integer('network_id')->unsigned();
            $table->foreign('network_id')->references('id')->on('networks')->onDelete('cascade');
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
        Schema::drop('ship_network');
    }
}
