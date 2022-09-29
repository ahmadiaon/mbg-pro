<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHaulingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haulings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('hauling_setup_uuid')->nullable();
            $table->string('vehicle_uuid')->nullable();
            $table->time('load_comes')->nullable();
            $table->time('load_start')->nullable();
            $table->time('empety_comes')->nullable();
            $table->time('empety_start')->nullable();
            $table->string('bruto')->nullable();
            $table->string('tarra')->nullable();
            $table->string('netto')->nullable();
            $table->string('description')->nullable();
            $table->string('road_permit')->nullable();
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
        Schema::dropIfExists('haulings');
    }
}
