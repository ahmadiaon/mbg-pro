<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_outs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('employee_uuid')->nullable();
            $table->string('out_status')->nullable();
            $table->date('date_out')->nullable();

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
        Schema::dropIfExists('employee_outs');
    }
}
