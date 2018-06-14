<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditInvestorInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investor_info', function (Blueprint $table) {
            $table->string('taxpayer_identification_number')->nullable()->change();
            $table->string('abbreviated_name_of_the_organization')->nullable()->change();
            $table->string('full_name_of_the_organization')->nullable()->change();
            $table->string('code_of_reason')->nullable()->change();
            $table->string('date_of_state_registration')->nullable()->change();
            $table->string('fio')->nullable()->change();
            $table->string('additional_information')->nullable()->change();
            $table->string('actual_city')->nullable()->change();
            $table->string('actual_index')->nullable()->change();
            $table->string('actual_address')->nullable()->change();
            $table->string('actual_post_index')->nullable()->change();
            $table->string('legal_city')->nullable()->change();
            $table->string('legal_index')->nullable()->change();
            $table->string('legal_address')->nullable()->change();
            $table->string('bank_identification_code')->nullable()->change();
            $table->string('bank_name')->nullable()->change();
            $table->string('bank_correspondent_account')->nullable()->change();
            $table->string('bank_settlement_account')->nullable()->change();
            $table->string('contact_phone')->nullable()->change();
            $table->string('contact_reserve_phone')->nullable()->change();
            $table->string('contact_fax')->nullable()->change();
            $table->string('contact_skype')->nullable()->change();
            $table->string('contact_email')->nullable()->change();
            $table->string('contact_additional_information')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investor_info', function (Blueprint $table) {
            //
        });
    }
}
