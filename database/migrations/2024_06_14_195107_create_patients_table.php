<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('phone_number');
            $table->string('age');
            $table->string('gender');
            $table->text('medical_history');
            $table->string('email')->unique();
            $table->string('address');
            $table->text('disease_history')->nullable();
            // $table->foreign('doctor_id')->references('id')->on('doctors');
            // $table->foreign('ward_no')->references('id')->on('wards');
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
        Schema::dropIfExists('patients');
    }
}
