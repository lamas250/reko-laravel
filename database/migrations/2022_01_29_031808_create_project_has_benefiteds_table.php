<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectHasBenefitedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_has_benefiteds', function (Blueprint $table) {
          $table->unsignedBigInteger('project_id');
          $table->unsignedBigInteger('benefited_id');

          $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('project_has_benefiteds');
    }
}
