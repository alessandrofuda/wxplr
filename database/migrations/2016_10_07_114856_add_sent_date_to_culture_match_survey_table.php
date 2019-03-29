<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSentDateToCultureMatchSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('culture_match_survey', function (Blueprint $table) {
            $table->date('sent_date');
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
            $table->dropColumn('sent_date');
        });
    }
}
