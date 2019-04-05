<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPdfPathCultureMatchSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('culture_match_survey', function (Blueprint $table) {
                        $table->string('pdf_path')->nullable()->insertAfter('attach_file');
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
                        $table->dropColumn('pdf_path');
        });
    }
}
