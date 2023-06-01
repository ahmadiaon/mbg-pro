<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivities', function (Blueprint $table) {
            $table->id();
            
            $table->string('uuid')->nullable();
            $table->string('variable_description')->nullable();
            $table->string('source')->nullable();
            $table->string('uuid')->nullable();


        

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
        Schema::dropIfExists('aktivities');
    }
}
