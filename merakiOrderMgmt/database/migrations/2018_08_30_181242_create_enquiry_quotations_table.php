<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_quotations', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('enquiry_id');
            $table->string('quotation_code');
            $table->date('quoteCreDttm');
            $table->date('validity_date');
            $table->string('product_category');
            $table->string('product_description');
            $table->integer('quantity');
            $table->string('hsn');
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
        Schema::dropIfExists('enquiry_quotations');
    }
}
