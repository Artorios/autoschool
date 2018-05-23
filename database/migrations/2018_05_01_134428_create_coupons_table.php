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
            $table->integer('investor_id')->unsigned();
            $table->integer('auto_school_id')->unsigned();
            $table->integer('auto_school_group_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->date('generation_date');
            $table->date('activated_at')->nullable();
            $table->date('sale_date')->nullable();
            $table->integer('payment_amount')->unsigned()->nullable();
            $table->integer('fee_amount');
            $table->smallInteger('status')->comment('1-free; 2-sale;3-active;4-canceled')->default('1');
            $table->text('comment_investor')->nullable();
            $table->text('comment_director')->nullable();
            $table->text('comment_coupon')->nullable();
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
