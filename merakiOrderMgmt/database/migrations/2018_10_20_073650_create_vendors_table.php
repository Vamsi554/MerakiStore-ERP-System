<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_code')->unique();
            $table->string('vendor_name');
            $table->string('vendor_phone');
            $table->string('vendor_company')->unique();
            $table->string('vendor_address1');
            $table->string('vendor_address2');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('vendor_TIN');
            $table->string('vendor_CST');
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
        Schema::dropIfExists('vendors');
    }
}
