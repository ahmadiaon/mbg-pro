<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('payment_group_uuid')->nullable();
            $table->date('date')->nullable();
            $table->date('date_end')->nullable();
            $table->integer('long')->nullable();
            $table->string('employee_create_uuid')->nullable();
            $table->string('employee_know_uuid')->nullable();
            $table->string('employee_approve_uuid')->nullable();
            $table->string('description')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
