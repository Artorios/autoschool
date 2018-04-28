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
    protected $fillable = ['name', 'auto_school_id', 'exam_date', 'exam_time'];
    protected $appends = ['count_student'];


    public function getCountStudentAttribute(){

        $counts = User::where('auto_school_group_id', $this->attributes['id'])->whereNotIn('role', ['admin','investor','autoschool'])->count();

        return $counts;
    }


}