<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cust_pay_code');
            $table->string('order_id');
            $table->string('enquiry_id');
            // Cash
            $table->integer('cash_amount')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('received_from_person')->nullable();
            // Cheque
            $table->string('bank_cheque')->nullable();
            $table->longtext('cheque_number')->nullable();
            $table->integer('cheque_amount')->nullable();
            $table->date('cheque_date')->nullable();
            // Online
            $table->longtext('transaction_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->longtext('customer_from_account_number')->nullable();
            $table->longtext('meraki_to_account_number')->nullable();
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
        Schema::dropIfExists('customer_payments');
    }
}
