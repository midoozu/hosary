<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date');
            $table->boolean('check_out')->default(0)->nullable();
            $table->integer('pulse_counter')->nullable();
            $table->integer('used_pulse')->nullable();
            $table->integer('device_pulse')->nullable();
            $table->string('comment')->nullable();
            $table->decimal('extra_service', 15, 2)->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
