<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->float('percentage', 5, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
