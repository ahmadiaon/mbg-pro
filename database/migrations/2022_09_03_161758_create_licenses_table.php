<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            $table->string('sim_A')->nullable();
            $table->string('sim_B1')->nullable();
            $table->string('sim_B2')->nullable();
            $table->string('sim_C')->nullable();
            $table->string('sim_D')->nullable();
            $table->string('sim_A_UMUM')->nullable();
            $table->string('sim_B1_UMUM')->nullable();
            $table->string('SIM_B2_UMUM')->nullable();
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
        Schema::dropIfExists('licenses');
    }
}
