<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDreamCheckLabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dream_check_lab', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment = "User client id who submit the form";
            $table->string('cv_file')->nullable();
            $table->text('achievement_role_organization1')->nullable();
            $table->text('achievement_problem1')->nullable();
            $table->text('achievement_action1')->nullable();
            $table->text('achievement_result1')->nullable();
            $table->text('achievement_skills1')->nullable();
            $table->text('achievement_role_organization2')->nullable();
            $table->text('achievement_problem2')->nullable();
            $table->text('achievement_action2')->nullable();
            $table->text('achievement_result2')->nullable();
            $table->text('achievement_skills2')->nullable();
            $table->text('achievement_role_organization3')->nullable();
            $table->text('achievement_problem3')->nullable();
            $table->text('achievement_action3')->nullable();
            $table->text('achievement_result3')->nullable();
            $table->text('achievement_skills3')->nullable();
            $table->text('your_objective')->nullable();
            $table->text('motivation')->nullable();
            $table->text('role_position')->nullable();
            $table->text('industry')->nullable();
            $table->text('company_characteristics')->nullable();
            $table->text('skills_support_objective')->nullable();
            $table->text('weakness_area')->nullable();
            $table->text('achievable_objective')->nullable();
            $table->text('fill_gap')->nullable();
            $table->text('promotion_usp')->nullable();
            $table->text('interest_country')->nullable();
            $table->enum('validate',[0,1])->default(0);
            $table->integer('validate_by')->unsigned()->nullable()->comment = "consultant id who validate the form";
            $table->timestamp('validate_date')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
				  ->references('id')->on('users')
				  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dream_check_lab');
    }
}
