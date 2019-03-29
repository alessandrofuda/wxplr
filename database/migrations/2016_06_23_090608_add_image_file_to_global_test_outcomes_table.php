<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageFileToGlobalTestOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('global_test_outcomes', function (Blueprint $table) {
            $table->string('outcome_image')->after('choice_id')->nullable();
            $table->string('outcome_file')->after('outcome_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('global_test_outcomes', function (Blueprint $table) {
            $table->dropColumn('outcome_image');
            $table->dropColumn('outcome_file');
        });
    }
}
