<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();

            $table->integer('people_id')->nullable(); 
            
            $table->string('experience_place_name')->nullable();
            $table->string('experience_position')->nullable();
            $table->string('experience_date_start')->nullable();
            $table->string('experience_date_end')->nullable();
            $table->string('experience_reason')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('experiences');
    }
};
