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
            $table->string('uuid')->nullable();
            $table->integer('machine_id')->nullable();
            
            // $table->string('employee_contract_uuid')->nullable();
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
