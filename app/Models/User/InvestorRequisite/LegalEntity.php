<?php

namespace App\Models\User\InvestorRequisite;

use Illuminate\Database\Eloquent\Model;

class LegalEntity extends Model
{
    protected $table = 'requisites_legal_entities';
    protected $fillable = [
        'profile_id',
        'id_number',
        'register_date',
        'director_name',
    ];
}
