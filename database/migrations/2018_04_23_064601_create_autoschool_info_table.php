<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoSchoolInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_school_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('taxpayer_identification_number');
            $table->string('abbreviated_name_of_the_organization');
            $table->string('full_name_of_the_organization');
            $table->string('code_of_reason');
            $table->string('date_of_state_registration');
            $table->string('director');
            $table->unsignedInteger('auto_school_id');
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
        Schema::dropIfExists('auto_school_infos');
    }
}
