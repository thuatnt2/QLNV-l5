<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('purpose_id')->unsigned();
            $table->foreign('purpose_id')->references('id')->on('purposes');

            $table->integer('kind_id')->unsigned();
            $table->foreign('kind_id')->references('id')->on('kinds');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('units');

            $table->string('customer_name');
            $table->string('order_name');
            $table->string('order_phone');
            $table->integer('number_cv');
            $table->integer('number_cv_pa71');
            $table->text('comment')->nullable();
            $table->text('file_attach')->nullable();
            $table->string('slug');
            $table->timestamp('date_submit');
            $table->timestamp('date_begin');
            $table->timestamp('date_end');
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
        Schema::drop('orders');
    }
}