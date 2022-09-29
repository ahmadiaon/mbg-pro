<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pits', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            $table->string('employee_uuid')->nullable();
            $table->string('mine_uuid')->nullable();
            $table->string('pit_name')->nullable();
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
        Schema::dropIfExists('pits');
    }
};
