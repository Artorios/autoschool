<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDirectorAndInvestorToAutoschoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auto_schools', function (Blueprint $table) {
            $table->integer('director_id')->nullable();
            $table->integer('investor_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auto_schools', function (Blueprint $table) {
            $table->dropColumn('director_id');
            $table->dropColumn('investor_id');
        });
    }
}
