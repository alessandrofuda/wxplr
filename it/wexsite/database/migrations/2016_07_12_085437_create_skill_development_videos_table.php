<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillDevelopmentVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_development_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('video_title');
            $table->string('uploaded_video');
            $table->integer('video_category');
            $table->longText('description');
            $table->enum('video_type', ['free', 'paid'])->default('free');
            $table->double('price', 8, 2);            
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
        Schema::drop('skill_development_videos');
    }
}
