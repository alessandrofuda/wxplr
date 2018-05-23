<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDreamCheckLabFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dream_check_lab_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dream_check_lab_id')->unsigned();
            $table->string('cv_file');
            $table->text('achievement1');
            $table->text('achievement2');
            $table->text('achievement3');
            $table->text('place');
            $table->text('promotion_usp');
            $table->timestamps();
            $table->foreign('dream_check_lab_id')
				  ->references('id')->on('dream_check_lab')
				  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dream_check_lab_feedback');
    }
}
