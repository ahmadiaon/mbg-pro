<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_tracks', function (Blueprint $table) {
            $table->id();
            
            $table->string('uuid')->nullable();
            $table->string('vehicle_uuid')->nullable();
            $table->string('location_uuid')->nullable();
            $table->string('hm')->nullable();
            $table->string('km')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->boolean('is_last')->nullable();
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
        Schema::dropIfExists('vehicle_tracks');
    }
}
