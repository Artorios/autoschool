<?php

use Illuminate\Support\Facades\{
    DB, File, Schema
};
use Illuminate\Database\Migrations\Migration;

class CreateGeoDataSourceTableForRu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(File::get(database_path() . '/sql/geo-source-cities.sql'));
        DB::unprepared(File::get(database_path() . '/sql/geo-source-streets.sql'));
        DB::unprepared(File::get(database_path() . '/sql/geo-structure-indexes.sql'));
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