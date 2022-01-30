<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportactionHasBenefitedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sportaction_has_benefiteds', function (Blueprint $table) {
  
          $table->unsignedBigInteger('sportaction_id');
          $table->unsignedBigInteger('benefited_id');

          $table->foreign('sportaction_id')->references('id')->on('sports_actions');
          $table->foreign('benefited_id')->references('id')->on('benefiteds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sportaction_has_benefiteds');
    }
}
