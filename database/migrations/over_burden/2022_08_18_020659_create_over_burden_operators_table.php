<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverBurdenOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_burden_operators', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('over_burden_uuid')->nullable();
            $table->string('vehicle_uuid')->nullable();
            $table->string('operator_employee_uuid')->nullable();
            $table->string('over_burden_flit_uuid')->nullable();
            $table->string('group')->nullable();//support-excavator-dumpTruck
            $table->integer('capacity')->nullable();
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
        Schema::dropIfExists('over_burden_operators');
    }
}
