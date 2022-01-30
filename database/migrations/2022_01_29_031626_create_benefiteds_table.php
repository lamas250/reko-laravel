<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefiteds', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('gender');
            $table->string('age');
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable()->unique();
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->date('birth_date');
            $table->string('phone')->nullable();

            
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
        Schema::dropIfExists('benefiteds');
    }
}
