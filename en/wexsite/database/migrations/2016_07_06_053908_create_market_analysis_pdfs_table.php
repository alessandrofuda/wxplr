<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketAnalysisPdfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_analysis_pdfs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('market_analysis_id')->unsigned();
            $table->string('market_analysis_pdf');
            $table->string('market_analysis_pdf_label');
            $table->string('market_analysis_pdf_unique_name');
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
        Schema::drop('market_analysis_pdfs');
    }
}
