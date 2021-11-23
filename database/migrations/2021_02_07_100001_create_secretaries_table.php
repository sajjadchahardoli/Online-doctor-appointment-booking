<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretaries', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('family');
            $table->string('email')->unique();
            $table->string('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('secretaries');
    }
}
