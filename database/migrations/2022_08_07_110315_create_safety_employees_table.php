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
            // foreign key
            $table->bigInteger('employee_id')->nullable();

            $table->string('rompi_size')->nullable();
            $table->string('rompi_status')->nullable();

            $table->string('helm_color')->nullable();
            $table->string('helm_status')->nullable();

            $table->string('pakaian_size')->nullable();
            $table->string('pakaian_status')->nullable();

            $table->string('boots_size')->nullable();
            $table->string('boots_status')->nullable();
            
            $table->string('id_card_status')->nullable();

            $table->string('name')->nullable();
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
