<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_licenses', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('user_detail_uuid')->nullable();


            $table->string('sim_a')->nullable();
            $table->string('sim_b1')->nullable();
            $table->string('sim_b2')->nullable();
            $table->string('sim_c')->nullable();
            $table->string('sim_d')->nullable();
            $table->string('sim_a_umum')->nullable();
            $table->string('sim_b1_umum')->nullable();
            $table->string('sim_b2_umum')->nullable();
            $table->date('date_end_sim_a')->nullable();
            $table->date('date_end_sim_b1')->nullable();
            $table->date('date_end_sim_b2')->nullable();
            $table->date('date_end_sim_c')->nullable();
            $table->date('date_end_sim_d')->nullable();
            $table->date('date_end_sim_a_umum')->nullable();
            $table->date('date_end_sim_b1_umum')->nullable();
            $table->date('date_end_sim_b2_umum')->nullable();

            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();

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
        Schema::dropIfExists('user_licenses');
    }
}
