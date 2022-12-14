<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicDoctorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('clinic_doctor', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_id_fk_7225904')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('clinic_id');
            $table->foreign('clinic_id', 'clinic_id_fk_7225904')->references('id')->on('clinics')->onDelete('cascade');
        });
    }
}
