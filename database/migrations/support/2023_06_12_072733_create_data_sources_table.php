<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sources', function (Blueprint $table) {
            $table->id();
            $table->string('table_source')->nullable();
            $table->string('source_code')->nullable();
            $table->string('field_source')->nullable();
            $table->string('table_name')->nullable();
            $table->string('field_get')->nullable();
            $table->timestamps();
            /*
            {
                "table_name":{
                    "field_source":{
                        source_code : "xxx",
                        field_source : "xxx",
                        table_name : "xxx",
                        field_get : "xxx",
                    }
                }
            }
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_sources');
    }
}
