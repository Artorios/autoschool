<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class InvestorProfile extends Model
{
    protected $table = 'investors_profiles';
    protected $fillable = [
        'user_id',
        'short_company_name',
        'company_name',
        'active_config',
        'id_number',
        'register_date',
        'director_name',
    ];
    public function getRouteKeyName()
    {
        return 'user_id';
    }
}
