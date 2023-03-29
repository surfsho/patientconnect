<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            //id
            $table->id();
            //appointment date
            $table->date('appt_date');
            //appointment time
            $table->time('appt_time',0);
            //preference
            $table->bigInteger('preference');
            //patient id
            $table->foreignId('patient_id');
            //provider id
            $table->foreignId('provider_id');
            //patientid foreign key
            $table->foreign('patient_id')->references('id')->on('patients');
            //provider id foregin key
            $table->foreign('provider_id')->references('id')->on('providers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
