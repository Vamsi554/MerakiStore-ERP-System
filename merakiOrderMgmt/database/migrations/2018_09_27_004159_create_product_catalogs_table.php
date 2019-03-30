<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_catalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_category');
            $table->string('product_category_code')->unique();
            $table->string('product_description');
            $table->string('art_work');
            $table->string('hsn_code');
            $table->decimal('gst_tax', 10, 2);

            // Features
            $table->text('product_style');
            $table->text('material');
            $table->text('quality');
            $table->text('fabric');
            $table->text('additional_features');

            // Customizations
            $table->text('colour');
            $table->text('print_methods');
            $table->text('print_placements');
            $table->text('print_area');
            $table->text('measurements');
            $table->text('additional_customizations');

            // Conditions
            $table->text('finishing');
            $table->text('packaging');
            $table->text('inclusive');
            $table->text('exclusive');
            $table->text('created_by');
            $table->text('additional_information');
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
        Schema::dropIfExists('product_catalogs');
    }
}
