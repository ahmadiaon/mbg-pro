<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // primary
            $table->bigIncrements('id');
            $table->string('uuid')->nullable();

            $table->string('employee_uuid')->nullable();
            $table->string('role')->nullable();
            
            // secondary
            $table->string('NIK_employee')->nullable();
            $table->string('password')->nullable();

            $table->string('auth_login')->nullable();
            $table->string('last_login_time')->nullable();

            $table->string('phone_number')->unique()->nullable();
            $table->string('email')->unique()->nullable();

            $table->string('photo_path')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();

            // timestamp
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
        Schema::dropIfExists('users');
    }
}
