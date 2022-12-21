<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupFormulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_formulas', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->integer('group_formula_order')->nullable();
            $table->string('formula_uuid')->nullable();
            $table->string('group_formula_symbol')->nullable();
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
        Schema::dropIfExists('group_formulas');
    }
}
