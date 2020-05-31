<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HistoryTrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_trade', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_card')->nullable();
            $table->string('code_trade')->unique();
            $table->bigInteger('amount');
            $table->timestamps();
            $table->foreign('code_card')->references('code_card')->on('card');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_trade');
    }
}
