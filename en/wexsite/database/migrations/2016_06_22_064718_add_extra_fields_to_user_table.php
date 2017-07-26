<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFieldsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('age_range',255)->after('email')->nullable();
            $table->string('country_origin', 40)->after('age_range')->nullable();
            $table->string('country_interest', 40)->after('country_origin')->nullable();
            $table->string('education',255)->after('country_interest')->nullable();
            $table->string('industry',255)->after('education')->nullable();
            $table->string('occupational_status',255)->after('industry')->nullable();
            $table->string('salary_range',255)->after('occupational_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('age_range');
            $table->dropColumn('country_origin');
            $table->dropColumn('country_interest');
            $table->dropColumn('education');
            $table->dropColumn('industry');
            $table->dropColumn('occupational_status');
            $table->dropColumn('salary_range');
        });
    }
}
