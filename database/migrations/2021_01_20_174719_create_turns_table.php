<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turns', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('family');
            $table->string('specialty');
            $table->date('date');
            $table->string('time');
            $table->string('phone');
            $table->string('address');
            $table->integer('total_payment')->nullable();
            $table->integer('advance_payment')->nullable();
            $table->integer('balance_payment')->nullable();
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
        Schema::dropIfExists('turns');
    }
}
