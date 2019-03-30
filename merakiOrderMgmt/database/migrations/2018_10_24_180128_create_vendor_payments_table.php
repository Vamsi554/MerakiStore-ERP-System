<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_pay_code');
            $table->string('order_id');
            $table->string('enquiry_id');
            // Cash
            $table->integer('cash_amount')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('paid_to_person')->nullable();

            // Cheque
            $table->string('bank_cheque')->nullable();
            $table->longtext('cheque_number')->nullable();
            $table->integer('cheque_amount')->nullable();
            $table->date('cheque_date')->nullable();
            // Online
            $table->longtext('transaction_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->longtext('meraki_from_account_number')->nullable();
            $table->longtext('vendor_to_account_number')->nullable();
            $table->integer('transaction_amount')->nullable();
            $table->string('transaction_date')->nullable();

            $table->integer('total_payment_amount')->nullable();

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
        Schema::dropIfExists('vendor_payments');
    }
}
