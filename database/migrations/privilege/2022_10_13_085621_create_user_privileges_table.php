<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPrivilegesTable extends Migration
{
    public function up()
    {
        Schema::create('user_privileges', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('nik_employee')->nullable();
            $table->string('privilege_uuid')->nullable();
            $table->string('jenis_privilege')->nullable();
            $table->string('value_privilege')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_privileges');
    }
}
