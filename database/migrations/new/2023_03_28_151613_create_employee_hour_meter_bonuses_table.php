<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeHourMeterBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_hour_meter_bonuses', function (Blueprint $table) {
            $table->id();
            
            $table->string('uuid')->nullable();
            $table->string('min_hm')->nullable();
            $table->string('percent_hm')->nullable();
            
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
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
        Schema::dropIfExists('employee_hour_meter_bonuses');
    }
}
