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

            //foreign key
            $table->integer('over_burden_id')->nullable();
            $table->integer('excavator_employee_id')->nullable();
            $table->integer('excavator_vehicle_id')->nullable();
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
