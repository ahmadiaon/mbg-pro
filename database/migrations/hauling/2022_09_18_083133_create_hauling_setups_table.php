<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHaulingSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hauling_setups', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->date('date')->nullable();
            $table->string('shift_1_employee_uuid')->nullable();
            $table->string('shift_2_employee_uuid')->nullable();
            $table->string('mine_uuid')->nullable();
            $table->string('owner')->nullable();
            $table->string('coal_type_uuid')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('coal_from')->nullable();
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
        Schema::dropIfExists('hauling_setups');
    }
}
