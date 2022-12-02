<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safety_employees', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            $table->string('no_reg')->nullable();
            $table->string('no_reg_full')->nullable();

            // foreign key
            $table->string('employee_uuid')->nullable();
            $table->date('date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('rompi_status')->nullable();
            $table->date('rompi_date')->nullable();

            $table->string('helm_color')->nullable();
            $table->date('helm_date')->nullable();

            $table->string('orange_size')->nullable();
            $table->date('orange_date')->nullable();

            $table->string('blue_size')->nullable();
            $table->date('blue_date')->nullable();

            $table->string('shirt_size')->nullable();
            $table->date('shirt_date')->nullable();

            $table->string('boots_size')->nullable();
            $table->date('boots_date')->nullable();

            $table->string('mekanik_size')->nullable();
            $table->date('mekanik_date')->nullable();
            
            $table->date('id_card_date')->nullable();
            
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
        Schema::dropIfExists('safety_employees');
    }
};
