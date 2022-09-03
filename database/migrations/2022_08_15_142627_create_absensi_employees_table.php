<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('absensi_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->integer('date_year')->nullable();
            $table->integer('date_month')->nullable();
            $table->integer('date_date')->nullable();
            $table->string('status')->nullable();
            $table->string('cek_log')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi_employees');
    }
}
