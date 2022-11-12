<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            // fereign key
            $table->string('employee_uuid')->nullable();
            $table->string('salary')->nullable();
            $table->string('insentif')->nullable();
            $table->string('premi_bk')->nullable();
            $table->string('premi_nbk')->nullable();
            $table->string('premi_kayu')->nullable();
            $table->string('premi_mb')->nullable();
            $table->string('premi_rj')->nullable();
            $table->string('insentif_hm')->nullable();
            $table->string('deposit_hm')->nullable();
            $table->string('tonase')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('data_status')->nullable();
            $table->string('is_last')->nullable();
            
            $table->date('valid_until')->nullable();
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
        Schema::dropIfExists('employee_salaries');
    }
}
