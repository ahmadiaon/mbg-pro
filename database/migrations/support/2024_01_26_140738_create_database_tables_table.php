<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_tables', function (Blueprint $table) {
            $table->id();
            $table->string('code_table')->nullable();            
            $table->string('parent_table')->nullable();
            $table->string('primary_table')->nullable();//primary key
            $table->string('menu_table')->nullable();
            $table->string('description_table')->nullable();
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
        Schema::dropIfExists('database_tables');
    }
}
