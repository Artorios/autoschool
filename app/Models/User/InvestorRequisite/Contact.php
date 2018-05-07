<?php

namespace App\Models\User\InvestorRequisite;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'requisites_contacts';
    protected $fillable = [
        'profile_id',
    ];
}
