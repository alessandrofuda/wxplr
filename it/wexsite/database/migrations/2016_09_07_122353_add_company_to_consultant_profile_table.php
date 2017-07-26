<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyToConsultantProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultant_profile', function (Blueprint $table) {
            $table->string('company')->after('vat_number');
            $table->string('city')->after('address');
            $table->string('bank_iban')->after('bank_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultant_profile', function (Blueprint $table) {
            $table->dropColumn('company');
            $table->dropColumn('city');
            $table->dropColumn('bank_iban');
        });
    }
}
