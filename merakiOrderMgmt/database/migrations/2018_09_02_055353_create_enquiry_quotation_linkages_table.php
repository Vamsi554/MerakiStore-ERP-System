<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryQuotationLinkagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_quotation_linkages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enquiry_id');
            $table->string('quotation_code');
            $table->string('quotation_status')->default('PENDING');
            $table->integer('advance_payment_percentage')->default(50);
            $table->integer('min_production_days')->default(0);
            $table->string('tax_code')->default('CGST/SGST');
            $table->text('specific_terms_1');
            $table->text('specific_terms_2');
            $table->text('specific_terms_3');
            $table->text('specific_terms_4');
            $table->text('specific_terms_5');
            $table->text('additional_notes');
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
        Schema::dropIfExists('enquiry_quotation_linkages');
    }
}
