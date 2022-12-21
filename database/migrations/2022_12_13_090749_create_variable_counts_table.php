<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariableCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variable_counts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('group_formula_uuid')->nullable();
            $table->string('variable_uuid')->nullable();
            $table->integer('order_number')->nullable();
            $table->string('symbol_count')->nullable();
            $table->float('value_value_variable')->nullable();

            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('variable_counts');
    }
}
