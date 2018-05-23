<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo',255);
            $table->string('website_email',255);
            $table->string('timings',255);
            $table->integer('facebook_active');
            $table->string('facebook_url',255);
            $table->integer('twitter_active');
            $table->string('twitter_url',255);
            $table->integer('linkedin_active');
            $table->string('linkedin_url',255);
            $table->integer('google_plus_active');
            $table->string('google_plus_url',255);
            $table->integer('behance_active');
            $table->string('behance_url',255);
            $table->text('location_address');
            $table->string('website_phone',255);
            $table->string('contact_us_email',255);
            $table->string('copyright',255);
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
        Schema::drop('settings');
    }
}
