<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_education', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            // foreign key
            $table->string('user_detail_uuid')->nullable();

            $table->string('sd_name')->nullable();
            $table->string('sd_place')->nullable();
            $table->integer('sd_year')->nullable();

            $table->string('smp_name')->nullable();
            $table->string('smp_place')->nullable();
            $table->integer('smp_year')->nullable();

            $table->string('sma_name')->nullable();
            $table->string('sma_place')->nullable();
            $table->string('sma_jurusan')->nullable();
            $table->integer('sma_year')->nullable();

            $table->string('ptn_name')->nullable();
            $table->string('ptn_place')->nullable();
            $table->string('ptn_jurusan')->nullable();
            $table->integer('ptn_year')->nullable();

            $table->string('dll_name')->nullable();
            $table->string('dll_place')->nullable();
            $table->string('dll_jurusan')->nullable();
            $table->integer('dll_year')->nullable();

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
        Schema::dropIfExists('user_education');
    }
}
