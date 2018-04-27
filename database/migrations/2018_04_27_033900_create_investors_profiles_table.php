<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorsProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investors_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique();
            $table->string('short_company_name');
            $table->string('company_name');
            $table->enum('active_config', [
                'legal_entity',
                'individual',
                'legal_address',
                'bank_details',
                'contacts'
            ])->default('legal_entity');
            $table->string('id_number')->nullable();
            $table->date('register_date')->nullable();
            $table->string('director_name')->nullable();
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
        Schema::dropIfExists('investors_profiles');
    }
}
