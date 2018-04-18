<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutoSchoolFilialId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auto_school_groups', function (Blueprint $table) {
            $table->dropColumn('auto_school_id');
        });
        Schema::table('auto_school_groups', function (Blueprint $table) {
            $table->integer('auto_school_filial_id');
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auto_school_groups', function (Blueprint $table) {
            $table->dropColumn('auto_school_filial_id');
        });
    }
}
