<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaTagsFieldsToMetaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meta_tags', function (Blueprint $table) {
           $table->string('title');
           $table->string('meta_title');
           $table->string('meta_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
        });
    }
}
