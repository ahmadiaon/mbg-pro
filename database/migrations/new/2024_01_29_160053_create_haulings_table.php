<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHaulingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('haulings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('id_hauling')->nullable();
            $table->string('surat_jalan')->nullable();
            $table->string('do')->nullable();
            $table->string('po')->nullable();
            $table->string('pemilik_batu')->nullable();//perusahaan
            $table->string('pengirim')->nullable();
            $table->string('kode_batu')->nullable();
            $table->string('jenis_batu')->nullable();
            $table->string('kondisi_batu')->nullable();
            $table->string('lokasi_muat')->nullable();
            $table->string('lokasi_dumping')->nullable();
            $table->string('lokasi_stockfile')->nullable();
            $table->dateTime('tanggal_waktu_berangkat')->nullable();
            $table->dateTime('tanggal_waktu_tiba')->nullable();
            $table->string('brutto')->nullable();
            $table->string('tarra')->nullable();
            $table->string('netto')->nullable();
            $table->string('code_data_driver')->nullable();
            $table->string('code_data_unit')->nullable();
            $table->string('code_data_creater')->nullable();
            $table->dateTime('datetime_creater')->nullable();
            $table->string('code_data_editor')->nullable();
            $table->dateTime('datetime_editor')->nullable();
            $table->timestamps();
            //cara menghitung revisi, tanggal revisi antar jika berbeda berrti di tambah

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('haulings');
    }
}
