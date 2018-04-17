<?php

use Illuminate\Support\Facades\{
    DB, File, Schema
};
use Illuminate\Database\Migrations\Migration;

class CreateGeoDataTableForRu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(File::get(database_path() . '/sql/geo-structure.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('metro');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}