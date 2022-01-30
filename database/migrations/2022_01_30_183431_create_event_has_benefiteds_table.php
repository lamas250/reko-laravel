<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventHasBenefitedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_has_benefiteds', function (Blueprint $table) {
          $table->unsignedBigInteger('event_id');
          $table->unsignedBigInteger('benefited_id');
          $table->string('photo_path');
          $table->date('photo_time')->nullable();

          $table->foreign('event_id')->references('id')->on('events');
          $table->foreign('benefited_id')->references('id')->on('benefiteds');
          
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
        Schema::dropIfExists('event_has_benefiteds');
    }
}
