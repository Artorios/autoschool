<?php

namespace App\Models\Training\School;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutoSchoolGroup
 * @package App\Models\Training\School
 */
class AutoSchoolGroup extends Model
{
    protected $fillable = ['name', 'auto_school_filial_id', 'exam_date', 'exam_time'];


    protected $appends = ['counts_students'];
    /**
     * @return mixed
     */
    public function autoschoolfilial()
    {
        return $this->belongsTo(AutoSchoolFilial::class, 'auto_school_filial_id', 'id');
    }

    public function users(){
        return $this->hasMany(User::class, 'auto_school_group_id', 'id');
    }



    public function getCountsStudentsAttribute()
    {
        $counts = User::where('auto_school_group_id','=', $this->attributes['id'])->whereNotIn('role', ['admin','investor','autoschool'])->count();
        return $counts;
    }
}
