<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileHasProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_has_projects', function (Blueprint $table) {
          $table->unsignedBigInteger('profile_id');
          $table->unsignedBigInteger('project_id');
          $table->timestamps();

          $table->foreign('profile_id')->references('id')->on('user_has_profiles');
          $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_has_projects');
    }
}
