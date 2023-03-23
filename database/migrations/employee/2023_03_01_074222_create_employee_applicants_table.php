<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_applicants', function (Blueprint $table) {
            $table->id();            
            $table->string('uuid')->nullable();
            $table->string('employee_uuid')->nullable();
            $table->string('position_uuid')->nullable();
            $table->string('recruitment_uuid')->nullable();
            $table->string('status_applicant')->nullable();//apply, reject, accept, proses

            $table->date('date_applicant')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_applicants');
    }
}
