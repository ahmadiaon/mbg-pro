<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_cutis', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('employee_uuid')->nullable();
            $table->date('date_schedule_start_cuti')->nullable();
            $table->date('date_schedule_end_cuti')->nullable();
            $table->float('kompensasi_cuti')->nullable();
            $table->string('status_cuti')->nullable();
            $table->date('date_real_start_cuti')->nullable();
            $table->date('date_real_end_cuti')->nullable();
            $table->string('long_cuti')->nullable();
            $table->string('value_money_cuti')->nullable();

            $table->date('date_come_cuti')->nullable();
            $table->string('monitoring_cuti')->nullable();      //Sedang Cuti, Selesai, Harus Cuti, Harus Balik
            
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_proposal')->nullable();
            $table->date('date_decline')->nullable();
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
        Schema::dropIfExists('employee_cutis');
    }
}
