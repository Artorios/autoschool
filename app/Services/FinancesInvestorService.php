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
        return AutoSchool::leftJoin('auto_school_groups', 'auto_schools.id', 'auto_school_groups.auto_school_id')
            ->join('users', 'auto_school_groups.id', 'users.auto_school_group_id')
            ->join('coupons', 'users.id', 'coupons.student_id')
            ->leftJoin('orders', 'users.id', 'orders.user_id')
            ->select(['*',
                'auto_schools.id as AutoSchoolId',
                'auto_schools.title as AutoSchoolTitle',
                'users.name as studentName',
                'users.id as studentId',
                'users.second_name as studentSecondName',
                'users.last_name as studentLastName',
                'auto_school_groups.name as GroupName',
                'orders.created_at as DatePayment',
                'coupons.id as CouponID',
            ])
            ->where('auto_schools.investor_id', '=', Auth::id())
            ->get();
    }
}