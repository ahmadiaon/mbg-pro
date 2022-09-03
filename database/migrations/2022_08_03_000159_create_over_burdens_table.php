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

            // foreign key

            $table->integer('foreman_employee_id')->nullable();
            $table->integer('checker_employee_id')->nullable();
            $table->integer('supervisor_employee_id')->nullable();
            $table->integer('pit_id')->nullable();
            $table->date('date')->nullable();
            $table->string('shift')->nullable();
            $table->integer('distance')->nullable();
            $table->string('material')->nullable();
            $table->string('note')->nullable();
            

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
