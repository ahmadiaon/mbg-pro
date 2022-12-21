<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeHourMeterDaysTable extends Migration
{
    public function up()
    {
        Schema::create('employee_hour_meter_days', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('employee_uuid')->nullable();
            $table->string('employee_checker_uuid')->nullable();
            $table->string('employee_foreman_uuid')->nullable();
            $table->string('employee_supervisor_uuid')->nullable();
            $table->string('hour_meter_price_uuid')->nullable();
            $table->date('date')->nullable();
            $table->string('shift')->nullable();
            $table->float('value')->nullable();//di kertas
            $table->float('full_value')->nullable();//bonus
            
            $table->string('pay_uuid')->nullable();
            $table->string('is_bonus')->nullable();
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
        Schema::dropIfExists('employee_hour_meter_days');
    }
}
