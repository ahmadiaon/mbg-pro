<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            $table->string('foreman_uuid')->nullable();//ini tetap contract
            $table->string('checker_uuid')->nullable();
            $table->date('shift_date_start')->nullable();
            $table->date('shift_date_end')->nullable();
            $table->string('shift_time')->nullable();//siang, malam

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
        Schema::dropIfExists('shifts');
    }
}
