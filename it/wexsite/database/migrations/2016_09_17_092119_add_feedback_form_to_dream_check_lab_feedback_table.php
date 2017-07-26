<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeedbackFormToDreamCheckLabFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dream_check_lab_feedback', function (Blueprint $table) {
                        $table->string('feedback_form')->nullable()->insertAfter('cv_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dream_check_lab_feedback', function (Blueprint $table) {
                        $table->dropColumn('feedback_form');
        });
    }
}
