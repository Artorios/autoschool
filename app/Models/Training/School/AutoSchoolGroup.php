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

    /**
     * @var array
     */
    protected $fillable = ['id_number', 'name', 'auto_school_id', 'exam_date', 'exam_time'];
    protected $appends = ['count_student'];


    public function getCountStudentAttribute()
    {

        $counts = User::where('auto_school_group_id', $this->attributes['id'])->whereIn('role', ['user'])->count();

        return $counts;
    }

    public function autoschool()
    {
        return $this->belongsTo(AutoSchool::class, 'auto_school_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'auto_school_group_id', 'id');
    }
}