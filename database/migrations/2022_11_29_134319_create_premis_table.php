<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePremisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premis', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('premi_name')->nullable();
            
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('premis');
    }
}
