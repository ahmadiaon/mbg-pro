<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoalFromsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coal_froms', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('company_uuid')->nullable();
            $table->string('coal_from')->nullable();
            $table->string('hauling_price')->nullable();            
            $table->date('use_start')->nullable();
            $table->date('use_end')->nullable();

            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coal_froms');
    }
}
