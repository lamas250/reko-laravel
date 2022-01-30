<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportActionHasCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_action_has_categories', function (Blueprint $table) {
          $table->unsignedBigInteger('sport_action_id');
          $table->unsignedBigInteger('category_id');
          $table->timestamps();

          $table->foreign('sport_action_id')->references('id')->on('sports_actions');
          $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sport_action_has_categories');
    }
}
