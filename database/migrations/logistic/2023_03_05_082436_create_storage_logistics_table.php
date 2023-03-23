<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_logistics', function (Blueprint $table) {
            $table->id();            
            $table->string('uuid')->nullable();
            $table->string('storage_name')->nullable();
            $table->float('p_storage')->nullable();
            $table->float('l_storage')->nullable();
            $table->string('parent_uuid')->nullable();
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
        Schema::dropIfExists('storage_logistics');
    }
}
