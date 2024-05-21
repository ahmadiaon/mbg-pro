<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseFieldShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_field_shows', function (Blueprint $table) {
            $table->id();
            $table->string('table_code')->nullable();    
            $table->string('field_code')->nullable();    
            $table->string('sort_field')->nullable();    
            $table->string('field_show_code')->nullable();    
            $table->string('table_show_code')->nullable();    
            $table->string('split_by')->nullable();     
            $table->string('description_field_show')->nullable();  
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
        Schema::dropIfExists('database_field_shows');
    }
}
