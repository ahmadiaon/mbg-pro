<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_absens', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('employee_uuid')->nullable();
            $table->date('date')->nullable();
            $table->string('status_absen_uuid')->nullable();
            $table->string('cek_log')->nullable();
            $table->string('edited')->nullable();
            $table->string('color')->nullable();
            
            $table->string('late_points')->nullable();
            $table->string('late_minutes')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('entry')->nullable();
            $table->string('exit')->nullable();
            $table->string('mid')->nullable();
            $table->string('shift')->nullable();

            $table->string('absen_description')->nullable();
            $table->string('pay_uuid')->nullable();

            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_absens');
    }
}
