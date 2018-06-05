<?php

namespace App\Services;

use App\Models\Finance\Coupon;
use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;

class FinancesInvestorService
{
    public function dataForFinancePage()
    {
        return AutoSchool::rightJoin('auto_school_groups', 'auto_schools.id', 'auto_school_groups.auto_school_id')
            ->join('users', 'auto_school_groups.id', 'users.auto_school_group_id')
            ->join('orders', 'users.id', 'orders.user_id')
            ->select(['*',
                'auto_schools.id as AutoSchoolId',
                'users.name as studentName',
                'users.second_name as studentSecondName',
                'users.last_name as studentLastName',
                'auto_school_groups.name as GroupName',
                'orders.created_at as DatePayment',
            ])
            ->where('auto_schools.investor_id', Auth::id())
            ->get();
    }
}