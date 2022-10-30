<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atribut_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('size')->nullable();
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
        Schema::dropIfExists('atribut_sizes');
    }
}

/*
INSERT INTO atribut_sizes (uuid,size) values
('S','huruf'),
('M','huruf'),
('L','huruf'),
('XL','huruf'),
('XXL','huruf'),
('3XL','huruf'),
('5','angka'),
('6','angka'),
('8','angka'),
('9','angka'),
('10','angka'),
('11','angka'),
('12','angka'),
('13','angka')
;
*/