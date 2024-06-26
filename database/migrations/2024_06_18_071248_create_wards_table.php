<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id(); // bigint unsigned
            $table->string('nama_bangsal');
            $table->string('tipe_bed');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // bigint unsigned
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // bigint unsigned
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
        Schema::dropIfExists('wards');
    }
}
