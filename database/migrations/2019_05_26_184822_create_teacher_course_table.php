<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_course', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('teacher_id');

            $table->primary(['course_id','teacher_id']);

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('teacher_id')->references('id')->on('teachers');

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
        Schema::dropIfExists('teacher_course');
    }
}
