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
            $table->string('uuid')->nullable();//1
            $table->string('employee_uuid')->nullable();//1
            $table->date('date_start_work')->nullable();//1
            $table->date('date_schedule_start_cuti')->nullable();//1
            $table->date('date_schedule_end_cuti')->nullable();//1
            $table->float('kompensasi_cuti')->nullable();//1
            $table->string('status_cuti')->nullable();//1
            $table->date('date_real_start_cuti')->nullable();//1
            $table->date('date_real_end_cuti')->nullable();//1
            $table->string('long_cuti')->nullable();//1
            $table->string('value_money_cuti')->nullable();//1
            $table->string('roaster_code')->nullable();//1 // day            
            $table->string('nrp_job_pendding')->nullable();//1 // day     
            $table->string('doc_job_pendding')->nullable();//1 // day  
            $table->string('nrp_atasan_langsung')->nullable();//1 // day  
            $table->string('nrp_manajer')->nullable();
            $table->string('nrp_hr_acc')->nullable();//1 // day
            $table->date('date_come_cuti')->nullable();
            $table->string('fasilitas_cuti')->nullable();      //Sedang Cuti, Selesai, Harus Cuti, Harus Balik
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
