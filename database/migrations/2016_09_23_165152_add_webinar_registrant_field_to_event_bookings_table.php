<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWebinarRegistrantFieldToEventBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_bookings', function (Blueprint $table) {
            $table->string('registrantKey');
            $table->string('joinUrl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_bookings', function (Blueprint $table) {
            $table->dropColumn('joinUrl');
            $table->dropColumn('registrantKey');
        });
    }
}
