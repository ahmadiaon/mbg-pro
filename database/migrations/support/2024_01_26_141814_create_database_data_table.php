<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_data', function (Blueprint $table) {
            $table->id();
            $table->string('code_table_data')->nullable();
            $table->string('code_field_data')->nullable();
            $table->string('value_data')->nullable();
            $table->string('code_data')->nullable();
            $table->string('uuid_data')->nullable();
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
        Schema::dropIfExists('database_data');
    }
}
