<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStateIdToDreamCheckLab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dream_check_lab', function (Blueprint $table) {
                   $table->integer('state_id')->after('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dream_check_lab', function (Blueprint $table) {
                       $table->dropColumn('state_id');
        });
    }
}
