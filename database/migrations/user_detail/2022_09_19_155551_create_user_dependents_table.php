<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_dependents', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();

            // foreign key
            $table->string('user_detail_uuid')->nullable();

            $table->string('mother_name')->nullable();
            $table->string('mother_gender')->nullable();
            $table->string('mother_place_birth')->nullable();
            $table->date('mother_date_birth')->nullable();
            $table->string('mother_education')->nullable();

            $table->string('father_name')->nullable();
            $table->string('father_gender')->nullable();
            $table->string('father_place_birth')->nullable();
            $table->date('father_date_birth')->nullable();
            $table->string('father_education')->nullable();


            $table->string('mother_in_law_name')->nullable();
            $table->string('mother_in_law_gender')->nullable();
            $table->string('mother_in_law_place_birth')->nullable();
            $table->date('mother_in_law_date_birth')->nullable();
            $table->string('mother_in_law_education')->nullable();


            $table->string('father_in_law_name')->nullable();
            $table->string('father_in_law_gender')->nullable();
            $table->string('father_in_law_place_birth')->nullable();
            $table->date('father_in_law_date_birth')->nullable();
            $table->string('father_in_law_education')->nullable();


            $table->string('couple_name')->nullable();
            $table->string('couple_gender')->nullable();
            $table->string('couple_place_birth')->nullable();
            $table->date('couple_date_birth')->nullable();
            $table->string('couple_education')->nullable();


            $table->string('child1_name')->nullable();
            $table->string('child1_gender')->nullable();
            $table->string('child1_place_birth')->nullable();
            $table->date('child1_date_birth')->nullable();
            $table->string('child1_education')->nullable();

            $table->string('child2_name')->nullable();
            $table->string('child2_gender')->nullable();
            $table->string('child2_place_birth')->nullable();
            $table->date('child2_date_birth')->nullable();
            $table->string('child2_education')->nullable();

            $table->string('child3_name')->nullable();
            $table->string('child3_gender')->nullable();
            $table->string('child3_place_birth')->nullable();
            $table->date('child3_date_birth')->nullable();
            $table->string('child3_education')->nullable();

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
        Schema::dropIfExists('user_dependents');
    }
}
