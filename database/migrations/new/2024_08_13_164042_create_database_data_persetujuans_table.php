<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseDataPersetujuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_data_persetujuans', function (Blueprint $table) {
            $table->id();
            $table->string('code_form')->nullable();
            $table->string('code_data')->nullable();
            $table->string('level')->nullable();            
            $table->string('nrp')->nullable();         
            $table->string('status')->nullable();      
            $table->date('date_change')->nullable();
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
        Schema::dropIfExists('database_data_persetujuans');
    }
}
