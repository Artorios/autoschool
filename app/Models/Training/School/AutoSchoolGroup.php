<?php

namespace App\Models\Training\School;

use Illuminate\Database\Eloquent\Model;

class AutoSchoolGroup extends Model
{
    protected $fillable = ['name', 'auto_school_filial_id', 'exam_date', 'exam_time'];

    public function autoschoolfilial(){
        return $this->belongsTo(AutoSchoolFilial::class, 'id', 'auto_school_id');
    }
}
