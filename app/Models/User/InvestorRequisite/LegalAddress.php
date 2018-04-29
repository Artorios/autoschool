<?php

namespace App\Models\User\InvestorRequisite;

use Illuminate\Database\Eloquent\Model;

class LegalAddress extends Model
{
    protected $table = 'requisites_legal_addresses';
    protected $fillable = [
        'profile_id',
    ];
}
