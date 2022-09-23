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
        Schema::create('pohs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            $table->string('name')->nullable();
            $table->integer('value')->nullable();
            
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();

            $table->string('data_status')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pohs');
    }
};
