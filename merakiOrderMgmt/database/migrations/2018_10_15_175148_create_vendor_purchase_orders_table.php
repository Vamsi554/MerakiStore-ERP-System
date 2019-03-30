<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorPurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('purchase_order_code');
            $table->date('poCreDttm');
            $table->date('validity_date');
            $table->string('product_category');
            $table->string('product_description');
            $table->integer('quantity');
            $table->string('hsn_code');
            $table->decimal('cost_per_unit', 10, 2);
            $table->decimal('gst_tax', 10, 2);
            $table->string('additional_details')->nullable();
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
        Schema::dropIfExists('vendor_purchase_orders');
    }
}
