<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Flight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight', function (Blueprint $table){
            $table->increments('id');
            $table->integer('id_start_airport')->unsigned();
            $table->integer('id_end_airport')->unsigned();
            $table->integer('price_flight');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->foreign('id_start_airport')->references('id')->on('airport');
            $table->foreign('id_end_airport')->references('id')->on('airport');
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
        Schema::dropIfExists('flight');
    }
}
