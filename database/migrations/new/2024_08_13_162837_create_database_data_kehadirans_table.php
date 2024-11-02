<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseDataKehadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_data_kehadirans', function (Blueprint $table) {
            $table->id();
            $table->string('code_data')->nullable();
            $table->string('nrp')->nullable();
            $table->date('tanggal_diajukan')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->string('lama')->nullable();
            $table->string('code_jenis_kehadiran')->nullable();
            $table->string('status_absen')->nullable();
            $table->string('dokumen')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('dibuat_oleh')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('database_data_kehadirans');
    }
}
