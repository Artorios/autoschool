<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoSchoolContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_school_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auto_school_id')->unsigned();
            $table->foreign('auto_school_id')->references('id')->on('auto_schools')->onDelete('cascade');
            $table->enum('type', ['address', 'phone']);
            $table->string('value');
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
        Schema::dropIfExists('auto_school_contacts');
    }
}
