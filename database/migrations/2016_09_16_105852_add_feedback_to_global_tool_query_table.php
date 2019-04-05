<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeedbackToGlobalToolQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('global_tool_query', function (Blueprint $table) {
            $table->string('feedback')->insertAfter('attach_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('global_tool_query', function (Blueprint $table) {
            $table->dropColumn('feedback');
        });
    }
}
