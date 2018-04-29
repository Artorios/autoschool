<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\InvestorRequisite\Contact;
use App\Models\User\InvestorRequisite\Individual;
use App\Models\User\InvestorRequisite\BankDetails;
use App\Models\User\InvestorRequisite\LegalEntity;
use App\Models\User\InvestorRequisite\LegalAddress;

class InvestorProfile extends Model
{
    protected $table = 'investors_profiles';
    protected $fillable = [
        'user_id',
        'short_company_name',
        'company_name',
        'requisite_type',
    ];

    public function getRouteKeyName()
    {
        return 'user_id';
    }

    public function legalEntity()
    {
        return $this->hasOne(LegalEntity::class, 'profile_id');
    }

    public function individual()
    {
        return $this->hasOne(Individual::class, 'profile_id');
    }

    public function legalAddress()
    {
        return $this->hasOne(LegalAddress::class, 'profile_id');
    }

    public function bankDetails()
    {
        return $this->hasOne(BankDetails::class, 'profile_id');
    }

    public function contact()
    {
        return $this->hasOne(Contact::class, 'profile_id');
    }
}
