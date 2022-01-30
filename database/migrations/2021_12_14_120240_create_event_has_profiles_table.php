<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventHasProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_has_profiles', function (Blueprint $table) {
          $table->unsignedBigInteger('event_id');
          $table->unsignedBigInteger('profile_id');
          $table->timestamps();

          $table->foreign('event_id')->references('id')->on('events');
          $table->foreign('profile_id')->references('id')->on('user_has_profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_has_profiles');
    }
}
