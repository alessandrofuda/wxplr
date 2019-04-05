<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalToolQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_tool_query', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country');
            $table->integer('question_type_id');
            $table->integer('state_id');
            $table->string('comment')->nullable(true);
            $table->string('attach_file')->nullable(true);
            $table->integer('user_id');
            $table->integer('consultant_id');
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
        Schema::drop('global_tool_query');
    }
}
