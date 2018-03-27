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
            $table->integer('user_tickets_id')->unsigned();
            $table->foreign('user_tickets_id')->references('id')->on('user_tickets')->onDelete('cascade');
            $table->tinyInteger('correct')->default(0);
            $table->integer('question_id');
            $table->integer('answer_id');
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
