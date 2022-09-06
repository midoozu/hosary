<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('clinic_service', function (Blueprint $table) {
            $table->unsignedBigInteger('clinic_id');
            $table->foreign('clinic_id', 'clinic_id_fk_7234810')->references('id')->on('clinics')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_7234810')->references('id')->on('services')->onDelete('cascade');
        });
    }
}
