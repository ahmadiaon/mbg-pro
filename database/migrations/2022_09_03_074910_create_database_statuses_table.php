<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('status')->nullable();//update, local,
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('database_statuses');
    }
}
