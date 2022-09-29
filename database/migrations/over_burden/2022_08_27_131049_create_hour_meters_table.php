<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourMetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hour_meters', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('over_burden_operator_uuid')->nullable();


            $table->float('hm_start')->nullable();
            $table->float('hm_stop')->nullable();
            $table->time('time_start')->nullable();
            $table->time('time_stop')->nullable();
            $table->float('hm_value')->nullable();
            $table->float('hm_pay')->nullable();
            $table->string('material')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('datetime_operator_approve')->nullable();
            $table->dateTime('datetime_checker_approve')->nullable();
            $table->dateTime('datetime_foreman_approve')->nullable();
            $table->dateTime('datetime_supervisor_approve')->nullable();

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
        Schema::dropIfExists('hour_meters');
    }
}
