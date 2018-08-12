<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSkillsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('job_skills', function (Blueprint $table){
            $table->increments('id');
            $table->integer('job_id')->unsigned();
            $table->string('skill', 100);
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('job_skills')) {
            Schema::drop('job_skills');
        }
    }
}
