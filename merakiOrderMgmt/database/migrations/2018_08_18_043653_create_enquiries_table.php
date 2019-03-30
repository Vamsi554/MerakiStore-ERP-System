<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {

            $table->increments('id');
            // Lead Source
            $table->string('concernedLeadPerson');
            $table->date('enquiryCreDttm');
            $table->string('leadSource');
            $table->string('documentNumber');

            // Event Details
            $table->string('eventName');
            $table->string('eventPlace');
            $table->string('organizationName');
            $table->string('eventDate');

            // Contact Details
            $table->string('name');
            $table->string('phone');
            $table->string('alternatePhone')->nullable();
            $table->string('designation');
            $table->string('email');

            // Enquiry / Quotation Status
            $table->string('enquiryStatus')->nullable();
            $table->string('enquiryComments')->nullable();

            // Sample Details
            $table->string('sampleDetailsSent')->nullable();
            $table->string('sampleDetailsComments')->nullable();

            $table->string('sampleReceivedByCustomer')->nullable();
            $table->string('samplesCustomerFeedback')->nullable();

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
        Schema::dropIfExists('enquiries');
    }
}
