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

            $table->integer('kind_id')->nullable()->unsigned();
            $table->foreign('kind_id')->references('id')->on('kinds');

            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('unit_id')->unsigned();
            $table->foreign('unit_id')->references('id')->on('units');

            $table->integer('purpose_id')->unsigned();
            $table->foreign('purpose_id')->references('id')->on('purposes');

            $table->integer('number_cv');
            $table->integer('number_cv_pa71');
            $table->string('order_name')->nullable();
            $table->string('order_phone');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('file_name')->nullable();
            $table->string('slug');
            $table->text('comment')->nullable();
            $table->string('manager')->nullable();
            $table->date('date_order');
            $table->date('date_begin')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_cut')->nullable();
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
