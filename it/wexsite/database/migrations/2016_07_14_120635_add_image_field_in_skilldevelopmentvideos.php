<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageFieldInSkilldevelopmentvideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skill_development_videos', function (Blueprint $table) {
            $table->string('video_image')->nullable()->after('video_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skill_development_videos', function (Blueprint $table) {
             $table->dropColumn('video_image');
        });
    }
}
