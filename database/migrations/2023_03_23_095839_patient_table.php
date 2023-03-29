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
        //
        Schema::create('patients', function (Blueprint $table) {
            //id
            $table->id();
            //first name
            $table->string('first_name');
            //last name
            $table->string('last_name');
            //dateofbirth
            $table->date('dateofbirth');
            //gender
            $table->string('gender');
            //email address
            $table->string('email_address');
            //phone number
            $table->string('phone_number');
            //state
            $table->string('state');
            //zipcode
            $table->bigInteger('zipcode');
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
