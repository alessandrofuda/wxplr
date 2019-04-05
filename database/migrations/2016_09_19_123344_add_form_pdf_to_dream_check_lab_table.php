<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormPdfToDreamCheckLabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dream_check_lab', function (Blueprint $table) {
            $table->string('form_pdf');
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
           $table->dropColumn('form_pdf');
        });
    }
}
