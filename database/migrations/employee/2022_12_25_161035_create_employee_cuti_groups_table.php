<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeCutiGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_cuti_groups', function (Blueprint $table) {
            $table->id();  
            $table->string('uuid')->nullable();
            $table->string('name_group_cuti')->nullable();
            
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
        Schema::dropIfExists('employee_cuti_groups');
    }
}
