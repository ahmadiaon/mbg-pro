<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('employee_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            // foreign key
            $table->string('employee_uuid')->nullable();
            $table->string('people_uuid')->nullable();
            $table->string('machine_id')->nullable();
            $table->string('NIK_employee')->nullable();
            $table->string('position_uuid')->nullable();
            $table->string('department_uuid')->nullable();

            $table->integer('contract_number')->nullable();
            $table->string('contract_status')->nullable();//pkwt-pkwtt
            $table->date('date_start_contract')->nullable();
            $table->date('date_end_contract')->nullable();
            $table->date('date_document_contract')->nullable();
            
            $table->integer('long_contract')->nullable(); //month
            $table->string('employee_status')->nullable();      //worker - staff - mekanik   

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
        Schema::dropIfExists('employee_contracts');
    }
};
