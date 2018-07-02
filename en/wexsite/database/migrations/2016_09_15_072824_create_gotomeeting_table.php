<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGotomeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gotomeeting', function (Blueprint $table) {
            $table->increments('id');
    	    $table->string('joinURL')->nullable();
    	    $table->integer('meetingid')->nullable();				
    	    $table->integer('maxParticipants')->nullable();		
    	    $table->integer('uniqueMeetingId')->nullable();		
    	    $table->string('conferenceCallInfo')->nullable();
    	    $table->integer('booking_id');
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
        Schema::drop('gotomeeting');
    }
}

