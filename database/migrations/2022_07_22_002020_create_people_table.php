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
        Schema::create('people', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('NIK_number')->nullable();
            $table->string('KK_number')->nullable();
            $table->string('citizenship')->nullable();

            $table->integer('religion_id')->nullable();// religion
            
            $table->string('gender')->nullable();

            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();

            $table->string('blood_group')->nullable();
            $table->string('status')->nullable();
            
            $table->string('address')->nullable();

            $table->string('financial_number')->nullable();
            $table->string('group_license')->nullable();
            $table->string('license_number')->nullable();

            $table->string('bpjs_ketenagakerjaan')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            
            $table->string('group_poh')->nullable();
            $table->string('poh_place')->nullable();

            $table->string('phone_number')->nullable();
            $table->string('photo_path')->nullable();

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
        Schema::dropIfExists('people');
    }
};
