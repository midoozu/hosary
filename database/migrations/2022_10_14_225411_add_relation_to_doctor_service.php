<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToDoctorService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_service', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_id')->references('id')->on('doctor')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id')->references('id')->on('service')->onDelete('cascade');
            $table->integer('percent');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_service', function (Blueprint $table) {
            //
        });
    }
}
