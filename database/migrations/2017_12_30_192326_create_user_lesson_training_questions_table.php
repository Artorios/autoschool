<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLessonTrainingQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_lesson_training_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_lesson_training_id')->unsigned();
            $table->foreign('user_lesson_training_id')->references('id')->on('user_lesson_trainings')->onDelete('cascade');
            $table->integer('question_id');
            $table->integer('answer_id');
            $table->tinyInteger('correct');
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
        Schema::dropIfExists('user_lesson_training_questions');
    }
}
