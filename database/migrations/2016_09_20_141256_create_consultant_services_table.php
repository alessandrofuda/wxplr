<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultantServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultant_services', function (Blueprint $table) {
            $table->increments('id');
	    $table->string('service_name');
	    $table->integer('service_id');
	    $table->integer('state_id');
	    $table->integer('user_id');
	    $table->integer('type_id');
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
        Schema::drop('consultant_services');
    }
}

