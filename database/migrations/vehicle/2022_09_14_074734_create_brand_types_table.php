<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_types', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('atribut_size_uuid')->nullable();
            $table->string('group_vehicle_uuid')->nullable();
            $table->string('brand_uuid')->nullable();
            $table->string('vehicle_hm_uuid')->nullable();//hm or km
            $table->string('type')->nullable();
            $table->float('capacity')->nullable();
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
        Schema::dropIfExists('brand_types');
    }
}
