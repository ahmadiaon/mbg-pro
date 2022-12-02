<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHealthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_healths', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('user_detail_uuid')->nullable();

            $table->string('name_health')->nullable();
            $table->string('year')->nullable();
            $table->string('health_care_place')->nullable();
            $table->integer('long')->nullable();//mounth
            $table->string('status_health')->nullable();

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
        Schema::dropIfExists('user_healths');
    }
}
