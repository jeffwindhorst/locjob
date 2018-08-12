<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('cities', function (Blueprint $table){
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->mediumInteger('name');
            $table->decimal('latitude',10,8);
            $table->decimal('longitude', 10,9);
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
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
        Schema::drop('cities');
    }
}
