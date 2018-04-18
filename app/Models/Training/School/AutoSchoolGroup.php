<?php

namespace App\Models\Training\School;

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
    protected $fillable = ['name', 'auto_school_filial_id', 'exam_date', 'exam_time'];

    /**
     * @return mixed
     */
    public function autoschoolfilial()
    {
        return $this->belongsTo(AutoSchoolFilial::class, 'id', 'auto_school_id');
    }
}
