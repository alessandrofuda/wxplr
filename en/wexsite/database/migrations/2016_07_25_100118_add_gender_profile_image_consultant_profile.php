<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenderProfileImageConsultantProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultant_profile', function (Blueprint $table) {
            $table->enum('gender', ['Male', 'Female'])->nullable()->after('user_id');
            $table->string('profile_picture')->nullable()->after('gender');;
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
            $table->dropColumn('gender');
            $table->dropColumn('profile_picture');
        });
    }
}
