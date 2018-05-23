<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultantProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultant_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->date('date_of_birth');
            $table->string('qualification', 255);
            $table->string('industry_expertise',40)->nullable();
            $table->string('country_expertise',40)->nullable();
            $table->string('languages', 255);
            $table->string('vat_number', 255);
            $table->text('address');
            $table->text('bank_details');
            $table->string('oigp_company', 255);
            $table->enum('allow_personal_data', [0, 1])->default(0);
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
        Schema::drop('consultant_profile');
    }
}
