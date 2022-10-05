<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusAbsensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_absens', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('status_absen_code')->nullable();
            $table->string('status_absen_description')->nullable();
            $table->string('math')->nullable();
            $table->date('use_start')->nullable();
            $table->date('use_end')->nullable();
            $table->string('is_last')->nullable();
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
        Schema::dropIfExists('status_absens');
    }
}
