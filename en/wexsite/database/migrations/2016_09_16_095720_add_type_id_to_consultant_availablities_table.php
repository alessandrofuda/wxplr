<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeIdToConsultantAvailablitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultant_availablities', function (Blueprint $table) {
            $table->integer('type_id')->insertAfter('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultant_availablities', function (Blueprint $table) {
           $table->dropColumn('type_id');
        });
    }
}
