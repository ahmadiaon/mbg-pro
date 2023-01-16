<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourMeterPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hour_meter_prices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('hour_meter_name')->nullable();
            $table->float('hour_meter_value')->nullable();
            $table->string('key_excel')->nullable();            
            $table->date('use_start')->nullable();
            $table->date('use_end')->nullable();

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
        Schema::dropIfExists('hour_meter_prices');
    }
}
