<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('databases', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->nullable();//
            $table->string('field')->nullable();
            $table->string('value_field')->nullable();
            $table->string('code_data')->nullable();
            $table->string('sort_data')->nullable();        
            $table->string('type_data')->nullable();          
            $table->string('description')->nullable();       
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
        Schema::dropIfExists('databases');
    }
}
