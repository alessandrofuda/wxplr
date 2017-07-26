<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSteadyAimShootTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steady_aim_shoot', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('top_description');
            $table->longText('bottom_description');
            $table->longText('whats_now');
            $table->string('steady_aim_shoot_pdf');
            $table->string('steady_aim_shoot_pdf_label');
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
        Schema::drop('steady_aim_shoot');
    }
}
