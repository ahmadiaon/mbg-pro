<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->string('employee_uuid')->nullable();
            $table->date('date_start')->nullable();
            $table->string('long')->nullable();
            $table->string('jenis_absensi')->nullable();
            $table->string('description')->nullable();
            $table->string('status_absen_uuid')->nullable();            
            $table->string('employee_uuid_created')->nullable();
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
        Schema::dropIfExists('absensis');
    }
}
