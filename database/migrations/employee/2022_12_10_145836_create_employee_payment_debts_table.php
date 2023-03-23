<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePaymentDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_payment_debts', function (Blueprint $table) {
            $table->id();
            
            $table->string('uuid')->nullable();
            $table->string('debt_uuid')->nullable();            
            $table->string('employee_uuid')->nullable();
            $table->date('date_payment_debt')->nullable(); 
            $table->float('remaining_old_debt')->nullable();
            $table->float('value_payment_debt')->nullable();
            $table->float('remaining_new_debt')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('employee_payment_debts');
    }
}
