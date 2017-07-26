<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferentialCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferential_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label')->nullable();
            $table->string('preferential_code')->unique();
            $table->integer('is_assigned');
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
        Schema::drop('preferential_codes');
    }
}
