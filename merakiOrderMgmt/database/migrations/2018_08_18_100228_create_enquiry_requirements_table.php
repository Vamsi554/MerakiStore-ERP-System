<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_requirements', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('enquiry_id');
            $table->string('product_category');
            $table->string('product_description')->nullable();
            $table->integer('quantity');
            $table->string('art_work_notes');
            $table->string('status');

            // Features
            $table->text('product_style')->nullable();
            $table->text('material')->nullable();
            $table->text('quality')->nullable();
            $table->text('fabric')->nullable();
            $table->text('additional_features')->nullable();

            // Customizations
            $table->text('colour')->nullable();
            $table->text('print_methods')->nullable();
            $table->text('print_placements')->nullable();
            $table->text('print_area')->nullable();
            $table->text('measurements')->nullable();
            $table->text('additional_customizations')->nullable();

            // Conditions
            $table->text('finishing')->nullable();
            $table->text('packaging')->nullable();
            $table->text('inclusive')->nullable();
            $table->text('exclusive')->nullable();

            // Tech Pack
            $table->date('est_delivery')->nullable();
            $table->text('breakup_details')->nullable();
            $table->date('tech_pack_date')->nullable();
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
        Schema::dropIfExists('enquiry_requirements');
    }
}
