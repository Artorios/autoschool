<?php

namespace App\Services;
use App\Models\Training\School\AutoSchool;

class MainCountFinanceService
{
    public function getStudentsInAutoSchool(){
        return AutoSchool::join('auto_school_filials', 'auto_schools.id', '=', 'auto_school_filials.auto_school_id')
            ->join('auto_school_groups', 'auto_school_filials.id', '=', 'auto_school_groups.auto_school_filial_id')
            ->join('users', 'auto_school_groups.id', '=', 'users.auto_school_group_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
//            ->join('cities', 'users.city_id', '=', 'cities.id')
            ->where('auto_school_id', '=', auth()->user()->autoschoolgroup->autoschoolfilial->autoschool->id)
            ->whereNotIn('role', ['admin','investor','autoschool'])
            ->select(['*',
                'auto_school_groups.name as autoSchoolGroupName',
                'users.name as studentName',
                'users.last_name as studentLastName',
                'users.second_name as studentSecondName'
            ])
            ->get();
    }

    public function getCountOfStudentInAutoSchool(){
        return AutoSchool::join('auto_school_filials', 'auto_schools.id', '=', 'auto_school_filials.auto_school_id')
            ->join('auto_school_groups', 'auto_school_filials.id', '=', 'auto_school_groups.auto_school_filial_id')
            ->join('users', 'auto_school_groups.id', '=', 'users.auto_school_group_id')
            ->where('auto_school_id', '=', auth()->user()->autoschoolgroup->autoschoolfilial->autoschool->id)
            ->whereNotIn('role', ['admin','investor','autoschool'])
            ->get()
            ->count();
    }

    public function getSumIncome(){
        $students = AutoSchool::join('auto_school_filials', 'auto_schools.id', '=', 'auto_school_filials.auto_school_id')
            ->join('auto_school_groups', 'auto_school_filials.id', '=', 'auto_school_groups.auto_school_filial_id')
            ->join('users', 'auto_school_groups.id', '=', 'users.auto_school_group_id')
            ->join('cities', 'users.city_id', '=', 'cities.id')
            ->where('auto_school_id', '=', auth()->user()->autoschoolgroup->autoschoolfilial->autoschool->id)
            ->whereNotIn('role', ['admin','investor','autoschool'])
            ->get();
        $sum = 0;
        foreach ($students as $student){
            $sum += $student->price;
        }
        return $sum;
    }

    public function getCountUserPaymentByCard(){
        return AutoSchool::join('auto_school_filials', 'auto_schools.id', '=', 'auto_school_filials.auto_school_id')
            ->join('auto_school_groups', 'auto_school_filials.id', '=', 'auto_school_groups.auto_school_filial_id')
            ->join('users', 'auto_school_groups.id', '=', 'users.auto_school_group_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('auto_school_id', '=', auth()->user()->autoschoolgroup->autoschoolfilial->autoschool->id)
            ->where('payment_option', '=', 'online')
            ->whereNotIn('role', ['admin','investor','autoschool'])
            ->get()
            ->count();
    }

    public function getCountUserPaymentByCupon(){
        return AutoSchool::join('auto_school_filials', 'auto_schools.id', '=', 'auto_school_filials.auto_school_id')
            ->join('auto_school_groups', 'auto_school_filials.id', '=', 'auto_school_groups.auto_school_filial_id')
            ->join('users', 'auto_school_groups.id', '=', 'users.auto_school_group_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('auto_school_id', '=', auth()->user()->autoschoolgroup->autoschoolfilial->autoschool->id)
            ->where('payment_option', '=', 'cupon')
            ->whereNotIn('role', ['admin','investor','autoschool'])
            ->get()
            ->count();
    }
}