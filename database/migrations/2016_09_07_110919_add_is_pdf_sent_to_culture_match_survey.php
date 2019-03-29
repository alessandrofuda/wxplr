<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsPdfSentToCultureMatchSurvey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('culture_match_survey', function (Blueprint $table) {
            $table->integer('is_pdf_sent')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('culture_match_survey', function (Blueprint $table) {
            $table->dropColumn('is_pdf_sent');
        });
    }
}
