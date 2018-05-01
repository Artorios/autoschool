<?php

namespace App\Models\User\InvestorRequisite;

use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    protected $table = 'requisites_individuals';
    protected $fillable = [
        'profile_id',
    ];
}
