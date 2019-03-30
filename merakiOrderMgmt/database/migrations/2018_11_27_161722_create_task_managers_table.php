<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_managers', function (Blueprint $table) {

            $table->increments('id');
            $table->string('task_id')->unique();
            $table->string('issuer');
            $table->string('issued_to');
            $table->string('subject');
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('start_dttm');
            $table->string('end_dttm')->nullable();
            $table->string('status')->default('Open');
            $table->string('client');
            $table->string('priority')->default('Lowest');
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
        Schema::dropIfExists('task_managers');
    }
}
