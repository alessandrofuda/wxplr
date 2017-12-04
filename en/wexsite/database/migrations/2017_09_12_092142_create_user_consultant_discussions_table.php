<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConsultantDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_consultant_discussions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('consultant_id')->unsigned();
            $table->string('discuss_id');
            $table->text('message');
            $table->timestamps();

            // foreign keys
            $table->foreign('user_id')->references('id')
                                      ->on('users')
                                      // ->onDelete('cascade')
                                      ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_consultant_discussions');
    }
}
