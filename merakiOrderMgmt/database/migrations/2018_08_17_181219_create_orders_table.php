<?php

use Illuminate\Support\Facades\Schema;
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
            $table->integer('enquiry_id');
            $table->string('concernedLead');
            $table->string('email');
            $table->string('documentNumber');
            $table->date('orderCreDttm');
            $table->date('expectedDelivery');
            $table->string('orderStatus');
            $table->decimal('orderAmount', 10, 2);
            $table->decimal('vendorAmount', 10, 2)->nullable();
            $table->string('orderDetails');
            $table->text('orderSummary');
            $table->string('billingAddress');
            $table->string('shipmentAddress');
            $table->string('contactPersonAtShipment')->nullable();
            $table->string('contactNumberAtShipment')->nullable();
            $table->string('postOrderDeliveryComments')->nullable();
            $table->string('clientFeedback')->nullable();
            $table->string('quotationNumber')->default('///////////////');
            $table->string('purchaseOrderNumber')->default('///////////////');
            $table->string('proformaInvoiceNumber')->default('///////////////');
            $table->string('techPackNumber')->default('///////////////');
            $table->integer('advancePaymentPercentage')->default(0);
            $table->date('invoiceDate')->nullable();
            $table->date('invoiceDueDate')->nullable();
            $table->string('GSTIN')->default('36BOPPG4920P1ZD');
            $table->string('client_gst_number')->default('///////////////');
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
