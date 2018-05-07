<?php

namespace App\Models\Training\School;

use App\Models\Training\School\Traits\Relationship\AutoSchoolRelationship;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Autoschool
 * @package App\Models\Training\School
 */
class AutoSchool extends Model
{
    use AutoSchoolRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'city_id',
        'filial_name',
        'director_id',
        'investor_id'
    ];

    /**
     * @var array $appends
     */
    protected $appends = ['count_student'];

    /**
     * @return mixed
     */
    public function getCountStudentAttribute(){
        $groups    = AutoSchoolGroup::select('id')->where('auto_school_id', $this->attributes['id'])->get()->toArray();
        $groups_id = array_map(function ($group) {
            return $group['id'];
        }, $groups);
        return User::whereIn('auto_school_group_id', $groups_id)->whereIn('role', ['user'])->count();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeDirector($query)
    {
        return $query->where('director_id', Auth::user()->id);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeStudent($query)
    {
        return $query->whereIn('role', ['user'])->whereNull('deleted_at');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePayment($query)
    {
        return $query->join('auto_school_groups', 'auto_schools.id', 'auto_school_groups.auto_school_id')
            ->join('users', 'auto_school_groups.id', 'users.auto_school_group_id')
            ->join('orders', 'users.id', 'orders.user_id');
    }

    /**
     * @param $query
     * @param $paymentType
     * @return mixed
     */
    public function scopePaymentBy($query, $paymentType)
    {
        return $query->payment()
            ->director()
            ->where('payment_option', $paymentType)
            ->student()
            ->get();
    }




}