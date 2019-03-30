<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDeliveryChallansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_delivery_challans', function (Blueprint $table) {

            $table->increments('id');
            $table->string('order_id');
            $table->string('delivery_challan_code');
            $table->string('way_bill_number');
            $table->string('product_description');
            $table->string('hsn_code');
            $table->integer('total_quantity');
            $table->integer('delivered_quantity');
            $table->integer('balance_quantity');
            $table->string('transport_mode')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('place_of_supply')->nullable();
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
        Schema::dropIfExists('order_delivery_challans');
    }
}
