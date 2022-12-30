<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCutiSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_cuti_setups', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('employee_uuid')->nullable();
            $table->string('roaster_uuid')->nullable();
            $table->date('date_start_work')->nullable();
            $table->string('group_cuti_uuid')->nullable();
            
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
        Schema::dropIfExists('employee_cuti_setups');
    }
}
