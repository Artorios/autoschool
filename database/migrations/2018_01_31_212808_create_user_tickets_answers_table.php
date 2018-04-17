<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTicketsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tickets_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_tickets_id');
            $table->unsignedTinyInteger('correct')->default(0);
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('answer_id');
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
        Schema::dropIfExists('user_tickets_answers');
    }
}
