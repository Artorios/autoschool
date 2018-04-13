<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lesson_videos', function (Blueprint $table) {
            $table->dropColumn('mime_type');
            $table->dropColumn('name');
        });
        Schema::table('lesson_videos', function (Blueprint $table) {
            $table->string('mime_type')->nullable();
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lesson_videos', function (Blueprint $table) {
            //
        });
    }
}
