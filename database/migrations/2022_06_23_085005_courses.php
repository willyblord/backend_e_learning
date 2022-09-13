<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Courses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('courses');
            $table->string('file');
            $table->string('language');
            $table->string('course_you_need1');
            $table->string('course_you_need2');
            $table->string('aboutCourses');
            $table->string('courseHours');
            $table->string('author');
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
      Schema::dropIfExists('videos');
      Schema::dropIfExists('image');
    }
}
