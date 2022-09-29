<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOverBurdenFlitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('over_burden_flits', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            //foreign key
            $table->string('over_burden_uuid')->nullable();
            $table->string('operator_employee_uuid')->nullable();
            $table->string('excavator_vehicle_uuid')->nullable();
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
        Schema::dropIfExists('over_burden_flits');
    }
}
