<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoomMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uniqueMeetingId')->nullable();
            $table->integer('meetingid')->nullable();
            $table->string('host_id')->nullable();
            $table->string('topic')->nullable();
            $table->integer('meeting_type')->nullable();
            $table->string('timezone')->nullable();
            $table->string('agenda')->nullable();
            $table->string('joinURL')->nullable();
            $table->integer('booking_id');
            $table->integer('type_id')->nullable();
            // $table->integer('maxParticipants')->nullable();     
            // $table->string('conferenceCallInfo')->nullable();
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
        Schema::dropIfExists('zoom_meetings');
    }
}
