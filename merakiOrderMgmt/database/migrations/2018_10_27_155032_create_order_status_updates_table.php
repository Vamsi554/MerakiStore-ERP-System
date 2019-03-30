<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('enquiry_id');
            $table->string('document_number');
            $table->string('order_status');
            $table->string('comments');
            $table->string('user');
            $table->text('creation_dttm');
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
        Schema::dropIfExists('order_status_updates');
    }
}
