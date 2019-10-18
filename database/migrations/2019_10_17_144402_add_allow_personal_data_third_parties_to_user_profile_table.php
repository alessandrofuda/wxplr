<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllowPersonalDataThirdPartiesToUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->enum('allow_personal_data_to_third_parties', ['0', '1'])->default('0')->after('allow_personal_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('user_profile','allow_personal_data_to_third_parties')) {
            Schema::table('user_profile', function (Blueprint $table) {
                $table->dropColumn('allow_personal_data_to_third_parties');
            });
        }
    }
}
