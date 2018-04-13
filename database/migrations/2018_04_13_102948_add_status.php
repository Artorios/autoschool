<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_lesson_trainings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('user_lesson_trainings', function (Blueprint $table) {
            $table->enum('status', ['passed', 'failed', 'stop'])->nullable();
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
