<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreviewVideoToSkillDevelopmentVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skill_development_videos', function (Blueprint $table) {
            $table->string('preview_video')->after('uploaded_video');
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
            $table->dropColumn('preview_video');
        });
    }
}
https://secure.join.me/api/public/v1/auth/oauth2?client_id=q774ystay2hdmsjxsnkdk3m4&scope=scheduler%20start_meeting&redirect_uri=https://wexplore.com/callback&state=ABCD&response_type=code
