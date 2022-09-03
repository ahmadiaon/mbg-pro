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
            $table->integer('over_burden_id')->nullable();
            $table->integer('operator_employee_id')->nullable();


            $table->integer('hm_start')->nullable();
            $table->integer('hm_stop')->nullable();
            $table->time('time_start')->nullable();
            $table->time('time_stop')->nullable();
            $table->float('hm_value')->nullable();
            $table->float('hm_pay')->nullable();
            $table->string('material')->nullable();

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
