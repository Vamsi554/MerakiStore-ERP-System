<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code');
            $table->string('product_descr');
            $table->string('front_panel_design');
            $table->string('back_panel_design');
            $table->string('finishing');
            $table->string('fitting_sizes');
            $table->string('packaging');
            $table->string('inclusive');
            $table->string('exclusive');
            $table->string('feature_1');
            $table->string('feature_2');
            $table->string('feature_3');
            $table->string('feature_4');
            $table->string('feature_5');
            $table->string('feature_6');
            $table->string('feature_7');
            $table->string('feature_8');
            $table->string('feature_9');
            $table->string('feature_10');
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
        Schema::dropIfExists('product_details');
    }
}
