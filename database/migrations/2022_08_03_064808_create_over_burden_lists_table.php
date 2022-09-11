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
        Schema::create('over_burden_lists', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            // foreign key 
            $table->integer('over_burden_uuid')->nullable();
            $table->integer('over_burden_operator_uuid')->nullable();
            $table->integer('over_burden_flit_uuid')->nullable();

            $table->time('over_burden_time')->nullable();
            $table->integer('over_burden_capacity')->nullable();

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
        Schema::dropIfExists('over_burden_lists');
    }
};
