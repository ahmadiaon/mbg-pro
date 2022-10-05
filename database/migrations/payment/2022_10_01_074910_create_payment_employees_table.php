<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_employees', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('employee_uuid')->nullable();
            $table->string('payment_uuid')->nullable();
            $table->string('value')->nullable();
            $table->string('is_last')->nullable();
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
        Schema::dropIfExists('payment_employees');
    }
}
