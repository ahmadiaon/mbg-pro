<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAbsenTotalsTable extends Migration
{
    public function up()
    {
        Schema::create('employee_absen_totals', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('nik_employee')->nullable();
            $table->string('cut')->nullable();
            $table->string('year_month')->nullable();
            $table->string('pay')->nullable();
            $table->string('alpa')->nullable();
            $table->string('unpay')->nullable();
            $table->string('day-1')->nullable();
            $table->string('day-2')->nullable();
            $table->string('day-3')->nullable();
            $table->string('day-4')->nullable();
            $table->string('day-5')->nullable();
            $table->string('day-6')->nullable();
            $table->string('day-7')->nullable();
            $table->string('day-8')->nullable();
            $table->string('day-9')->nullable();
            $table->string('day-10')->nullable();
            $table->string('day-11')->nullable();
            $table->string('day-12')->nullable();
            $table->string('day-13')->nullable();
            $table->string('day-14')->nullable();
            $table->string('day-15')->nullable();
            $table->string('day-16')->nullable();
            $table->string('day-17')->nullable();
            $table->string('day-18')->nullable();
            $table->string('day-19')->nullable();
            $table->string('day-20')->nullable();
            $table->string('day-21')->nullable();
            $table->string('day-22')->nullable();
            $table->string('day-23')->nullable();
            $table->string('day-24')->nullable();
            $table->string('day-25')->nullable();
            $table->string('day-26')->nullable();
            $table->string('day-27')->nullable();
            $table->string('day-28')->nullable();
            $table->string('day-29')->nullable();
            $table->string('day-30')->nullable();
            $table->string('day-31')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_absen_totals');
    }
}
