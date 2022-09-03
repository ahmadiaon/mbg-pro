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

            // foreign key
            $table->integer('employee_id')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('contract_status')->nullable();//pkwt-pkwtt
            $table->string('date_start_contract')->nullable();
            $table->string('date_end_contract')->nullable();
            $table->integer('long_contract')->nullable();
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
