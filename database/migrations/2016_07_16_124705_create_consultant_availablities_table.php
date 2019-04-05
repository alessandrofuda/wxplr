<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultantAvailablitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultant_availablities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consultant_id')->unsigned();
            $table->string('title');
            $table->integer('available_date');
            $table->string('available_start_time');
            $table->string('available_end_time');
            $table->enum('status', [0, 1])->default(1);
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
        Schema::drop('consultant_availablities');
    }
}
