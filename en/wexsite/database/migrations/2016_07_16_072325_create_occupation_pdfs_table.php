<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOccupationPdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupation_pdfs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('occupation',100);
            $table->string('occupation_pdf');
            $table->string('occupation_pdf_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('occupation_pdfs');
    }
}
