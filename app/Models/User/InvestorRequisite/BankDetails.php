<?php

namespace App\Models\User\InvestorRequisite;

use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    protected $table = 'requisites_bank_details';
    protected $fillable = [
        'profile_id',
    ];
}
