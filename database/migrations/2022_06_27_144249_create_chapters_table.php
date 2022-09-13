<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter', function (Blueprint $table) {
            $table->chapter_id();          
            $table->string('chapter_name');
            $table->string('course_id')->unsigned();
            $table->string('file');
            $table->string('chapterDetails');
            $table->string('autho');
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
        Schema::dropIfExists('chapters');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('image');


    }
}
