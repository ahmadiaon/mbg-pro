<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePaymentOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_payment_others', function (Blueprint $table) {
            $table->id();
            
            $table->string('uuid')->nullable();
            $table->string('employee_uuid')->nullable();
            $table->string('payment_other_uuid')->nullable();

            $table->string('payment_other_description')->nullable();
            $table->float('payment_other_value')->nullable();
            $table->float('payment_other_much')->nullable();
            $table->float('payment_other_total')->nullable();
            
            $table->date('payment_other_date')->nullable();
            
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            
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
        Schema::dropIfExists('employee_payment_others');
    }
}
