<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeUserLessonTrainings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::table('user_lesson_trainings', function (Blueprint $table) {
            DB::statement("ALTER TABLE user_lesson_trainings MODIFY COLUMN type ENUM('training','exam','group')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_lesson_trainings', function (Blueprint $table) {
            //
        });
    }
}
