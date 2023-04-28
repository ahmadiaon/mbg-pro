<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_deductions', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->nullable();
            $table->string('employee_uuid')->nullable();
            $table->string('group_deduction_uuid')->nullable();
            $table->date('date_employee_deduction')->nullable();
            $table->float('value_employee_deduction')->nullable();
            $table->string('description_deduction_uuid')->nullable();            
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
        Schema::dropIfExists('employee_deductions');
    }
}
