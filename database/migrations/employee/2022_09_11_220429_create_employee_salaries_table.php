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
            $table->float('salary')->nullable();
            $table->float('insentif')->nullable();
            $table->float('tunjangan')->nullable();
            
            $table->float('premi_bk')->nullable();
            $table->float('premi_nbk')->nullable();
            $table->float('premi_kayu')->nullable();
            $table->float('premi_mb')->nullable();
            $table->float('premi_nmb')->nullable();
            $table->float('premi_rj')->nullable();
            $table->float('premi_nrj')->nullable();

            $table->float('hour_meter_price_uuid')->nullable();
            $table->float('insentif_hm')->nullable();
            $table->float('deposit_hm')->nullable();
            $table->float('tonase')->nullable();

            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            
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
