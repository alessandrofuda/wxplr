<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPanNumberToConsultantProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultant_profile', function (Blueprint $table) {
           $table->string('pin_number');
           $table->string('bio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultant_profile', function (Blueprint $table) {
           $table->dropColumn('pin_number');
           $table->dropColumn('bio');
        });
    }
}
