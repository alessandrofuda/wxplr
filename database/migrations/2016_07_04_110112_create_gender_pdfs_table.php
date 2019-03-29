<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenderPdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gender_pdfs', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('gender',['Male', 'Female']);
            $table->string('gender_pdf');
            $table->string('gender_pdf_name');
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
        Schema::drop('gender_pdfs');
    }
}
