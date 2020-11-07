<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('customer_id');
            $table->integer('qty');
            $table->string('sub_total');
            $table->integer('vat')->nullable();
            $table->string('total');
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->string('payby');
            $table->string('order_date');
            $table->string('search_date');
            $table->string('order_month');
            $table->string('order_year');
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
        Schema::dropIfExists('orders');
    }
}
