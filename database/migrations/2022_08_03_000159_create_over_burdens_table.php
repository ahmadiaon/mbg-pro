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
        Schema::create('over_burdens', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
           
            // foreign key

            $table->string('foreman_employee_uuid')->nullable();
            $table->string('checker_employee_uuid')->nullable();
            $table->string('supervisor_employee_uuid')->nullable();
            $table->string('pit_uuid')->nullable();
            $table->date('date')->nullable();
            $table->string('shift')->nullable();
            $table->integer('distance')->nullable();
            $table->string('material')->nullable();
            

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
        Schema::dropIfExists('over_burdens');
    }
};
