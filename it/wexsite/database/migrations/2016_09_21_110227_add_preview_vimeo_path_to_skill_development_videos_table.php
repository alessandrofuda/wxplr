<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreviewVimeoPathToSkillDevelopmentVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skill_development_videos', function (Blueprint $table) {
            $table->string('preview_vimeo_path');
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
            $table->dropColumn('preview_vimeo_path');
        });
    }
}
