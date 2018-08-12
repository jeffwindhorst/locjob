<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('jobs', function (Blueprint $table){
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->text('linkback');
            $table->integer('job_type_id')->unsigned()->comment('Job types are similar to Contract, Direct Hire, Duration, etc.');
            $table->mediumText('company');
            $table->mediumText('title');
            $table->longText('description');
            $table->decimal('salary', 8,2);
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('job_type_id')->references('id')->on('job_types');
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
        if (Schema::hasTable('jobs')) {
            Schema::drop('jobs');
        }
    }
}
