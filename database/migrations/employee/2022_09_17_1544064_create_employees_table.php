<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            // foreign key
            $table->string('user_detail_uuid')->nullable();
            $table->string('machine_id')->nullable();
            $table->string('nik_employee')->nullable();
            $table->string('nik_employee_with_space')->nullable();
            $table->string('position_uuid')->nullable();
            $table->string('department_uuid')->nullable();
            $table->string('company_uuid')->nullable();            
            $table->string('site_uuid')->nullable();
            $table->string('roaster_uuid')->nullable();

            $table->integer('contract_number')->nullable();
            $table->string('contract_number_full')->nullable();
            $table->string('contract_status')->nullable();//pkwt-pkwtt
            $table->date('date_start_contract')->nullable();
            $table->date('date_end_contract')->nullable();
            $table->date('date_document_contract')->nullable();
            
            $table->integer('long_contract')->nullable(); //month
            $table->string('employee_status')->nullable();  
            $table->string('file_path')->nullable();      //profesional training
            $table->string('tax_status_uuid')->nullable(); 

            $table->string('is_bpjs_kesehatan')->nullable(); 
            $table->string('is_bpjs_ketenagakerjaan')->nullable(); 
            $table->string('is_bpjs_pensiun')->nullable(); 
            $table->string('payment_method')->nullable();//cash|transfer 
            
            $table->string('submission_status')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
