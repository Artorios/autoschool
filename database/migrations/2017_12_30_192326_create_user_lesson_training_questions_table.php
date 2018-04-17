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
            $table->unsignedInteger('user_lesson_training_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('answer_id');
            $table->unsignedTinyInteger('correct');
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
