<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeIdToPreferentialCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preferential_codes', function (Blueprint $table) {
            $table->integer('type_id')->after('is_assigned');
            $table->integer('product_id')->after('type_id');
            $table->integer('discount')->after('product_id');
            $table->integer('is_single')->after('discount');
            $table->date('end_date')->after('is_single');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preferential_codes', function (Blueprint $table) {
            $table->dropColumn('type_id');
			$table->dropColumn('product_id');
			$table->dropColumn('discount');
			$table->dropColumn('is_single');
			$table->dropColumn('end_date');
        });
    }
}
