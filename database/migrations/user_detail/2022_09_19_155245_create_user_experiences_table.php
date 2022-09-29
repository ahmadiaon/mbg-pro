<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            $table->string('user_detail_uuid')->nullable();
            
            $table->string('experience_place_name')->nullable();
            $table->string('experience_position')->nullable();
            $table->string('experience_date_start')->nullable();
            $table->string('experience_date_end')->nullable();
            $table->string('experience_reason')->nullable();

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
        Schema::dropIfExists('user_experiences');
    }
}
