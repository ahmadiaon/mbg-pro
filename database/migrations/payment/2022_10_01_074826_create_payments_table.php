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
            $table->string('known_employee_uuid')->nullable();
            $table->string('approve_employee_uuid')->nullable();
            $table->string('create_employee_uuid')->nullable();
            $table->string('descridption')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
