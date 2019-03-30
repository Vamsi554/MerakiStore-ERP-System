<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_cycles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enquiry_id');
            $table->string('order_status');
            $table->string('concernedLeadPerson');
            $table->string('indicativeIcon');
            $table->string('subject');
            $table->text('content');
            $table->string('logDate');
            $table->string('logTime');
            $table->string('linkDescription')->nullable();
            $table->string('hyperLink')->nullable();
            $table->string('additionalInfo')->nullable();
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
        Schema::dropIfExists('order_cycles');
    }
}
