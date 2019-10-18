<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('gender', ['Male', 'Female']);
            $table->string('profile_picture')->nullable();
            $table->string('age_range')->nullable();
            $table->string('country_origin', 40)->nullable();
            $table->string('country_interest', 40)->nullable();
            $table->string('education',255)->nullable();
            $table->string('industry',255)->nullable();
            $table->string('occupational_status',255)->nullable();
            $table->string('salary_range',255)->nullable();
            $table->enum('allow_personal_data', ['0', '1'])->default('0');
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
        Schema::drop('user_profile');
    }
}
