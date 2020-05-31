<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OnewayTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oneway_ticket', function (Blueprint $table){
            $table->increments('id');
            $table->integer('id_customer')->unsigned();
            $table->integer('id_flight')->unsigned();
            $table->integer('id_luggage')->unsigned();
            $table->integer('id_seat')->unsigned();
            $table->integer('price');
            $table->integer('status_ticket');
            $table->string('code_trade')->nullable();
            $table->foreign('id_customer')->references('id')->on('users');
            $table->foreign('id_flight')->references('id')->on('flight');
            $table->foreign('id_luggage')->references('id')->on('luggage');
            $table->foreign('id_seat')->references('id')->on('seat');
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
        Schema::dropIfExists('oneway_ticket');
    }
}
