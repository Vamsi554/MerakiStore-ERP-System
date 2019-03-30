<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorPurchaseOrdersLinkagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_purchase_orders_linkages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('purchase_order_code');
            $table->string('vendor_code');
            $table->text('vendor_terms_conditions');
            $table->text('vendor_notes');
            $table->integer('vendor_payment_amount')->nullable();
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
        Schema::dropIfExists('vendor_purchase_orders_linkages');
    }
}
