<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLessonVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_lesson_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lesson_video_id');
            $table->unsignedInteger('user_id');
            $table->string('time_stop_view')->nullable();
            $table->unsignedTinyInteger('viewed')->default(0);
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
        Schema::dropIfExists('user_lesson_videos');
    }
}
