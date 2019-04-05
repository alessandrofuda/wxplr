<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailCountToConsultantProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultant_profile', function (Blueprint $table) {
             $table->integer('email_count')->after('allow_personal_data')->default(0);
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
            $table->dropColumn('email_count');
        });
    }
}
