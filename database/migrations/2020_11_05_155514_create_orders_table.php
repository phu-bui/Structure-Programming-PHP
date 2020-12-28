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
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->integer('payment_type_id');
            $table->integer('shipping_type_id');
            $table->double('total_prices');
            $table->dateTime('order_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('order_status');
            $table->integer('order_no');
            $table->timestamps();
            $table->index(['order_no']);
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
