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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            
            // foreign key
            $table->string('people_uuid')->nullable();
            $table->string('machine_id')->nullable();
            $table->string('NIK_employee')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('insentif')->nullable();
            $table->integer('premi_bk')->nullable();
            $table->integer('premi_nbk')->nullable();
            $table->integer('premi_kayu')->nullable();
            $table->integer('premi_mb')->nullable();
            $table->integer('premi_rj')->nullable();

            
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
        Schema::dropIfExists('employees');
    }
};
