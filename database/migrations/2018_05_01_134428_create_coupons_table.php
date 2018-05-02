<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('investor_id');
            $table->integer('auto_school_id');
            $table->integer('user_id')->unsigned();
            $table->date('generation_date');
            $table->date('activation_date')->nullable();
            $table->date('sale_date')->nullable();
            $table->integer('total')->unsigned();
            $table->integer('commission');
            $table->smallInteger('status')->comment('1-free; 2-sale;3-active;4-canceled')->default('1');
            $table->text('comment_investor')->nullable();
            $table->text('comment_director')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
