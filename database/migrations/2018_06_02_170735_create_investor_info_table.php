<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('taxpayer_identification_number');
            $table->string('abbreviated_name_of_the_organization');
            $table->string('full_name_of_the_organization');
            $table->string('code_of_reason');
            $table->string('date_of_state_registration');
            $table->string('fio');
            $table->string('additional_information');
            $table->string('actual_city');
            $table->string('actual_index');
            $table->string('actual_address');
            $table->string('actual_post_index');
            $table->string('legal_city');
            $table->string('legal_index');
            $table->string('legal_address');
            $table->string('bank_identification_code');
            $table->string('bank_name');
            $table->string('bank_correspondent_account');
            $table->string('bank_settlement_account');
            $table->string('contact_phone');
            $table->string('contact_reserve_phone');
            $table->string('contact_fax');
            $table->string('contact_skype');
            $table->string('contact_email');
            $table->string('contact_additional_information');
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
        Schema::dropIfExists('investor_info');
    }
}
