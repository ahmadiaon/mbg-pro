<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTonasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_tonases', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('employee_create_uuid')->nullable();
            $table->string('employee_know_uuid')->nullable();
            $table->string('employee_approve_uuid')->nullable();
            $table->string('tiket_number')->nullable(); 
            $table->string('vehicle_uuid')->nullable();
            
            $table->string('employee_uuid')->nullable();
            $table->string('coal_from_uuid')->nullable();
            $table->float('tonase_value')->nullable();//di kertas
            $table->float('tonase_full_value')->nullable();//bonus
            $table->date('date')->nullable();
            $table->string('shift')->nullable();
            $table->string('company_uuid')->nullable();
            
            $table->date('time_start')->nullable();
            $table->date('time_come')->nullable();

            $table->string('pay_uuid')->nullable();
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
        Schema::dropIfExists('employee_tonases');
    }
}
