<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_fields', function (Blueprint $table) {
            $table->id();            
            $table->string('code_table_field')->nullable();
            $table->string('description_field')->nullable();
            $table->string('type_data_field')->nullable();
            $table->string('code_field')->nullable();      
            $table->string('level_data_field')->nullable();            
            $table->string('full_code_field')->nullable();
            $table->string('sort_field')->nullable();
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
        Schema::dropIfExists('database_fields');
    }
}
