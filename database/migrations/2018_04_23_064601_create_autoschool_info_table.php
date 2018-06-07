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
        Schema::create('auto_school_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('auto_school_id');
            $table->string('taxpayer_identification_number')->nullable();
            $table->string('abbreviated_name_of_the_organization')->nullable();
            $table->string('full_name_of_the_organization')->nullable();
            $table->string('code_of_reason')->nullable();
            $table->string('date_of_state_registration')->nullable();
            $table->string('director')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('actual_city')->nullable();
            $table->string('actual_index')->nullable();
            $table->string('actual_address')->nullable();
            $table->string('actual_post_index')->nullable();
            $table->string('legal_city')->nullable();
            $table->string('legal_index')->nullable();
            $table->string('legal_address')->nullable();
            $table->string('bank_identification_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_correspondent_account')->nullable();
            $table->string('bank_settlement_account')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_reserve_phone')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('contact_skype')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_contact_additional_information')->nullable();
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
        Schema::dropIfExists('auto_school_info');
    }
}
