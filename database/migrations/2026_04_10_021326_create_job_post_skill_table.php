<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('job_post_skill', function (Blueprint $table) {
        $table->id();
        $table->foreignId('job_post_id')->constrained('job_posts')->onDelete('cascade');
        $table->foreignId('skill_id')->constrained('skills')->onDelete('cascade');
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
        Schema::dropIfExists('job_post_skill');
    }
}
