<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();   //
            $table->string('address_description')->nullable();   
            $table->string('provinsi')->nullable();   
            $table->string('kabupaten')->nullable();   
            $table->string('kecamatan')->nullable();   
            $table->string('file')->nullable();   //
            $table->string('position')->nullable();   //
            $table->string('email')->nullable();     //
            $table->string('phone_number')->nullable();//   
            $table->string('status')->nullable();   
            $table->string('time_propose')->nullable(); 
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
        Schema::dropIfExists('recruitments');
    }
}
