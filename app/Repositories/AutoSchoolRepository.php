<?php

namespace App\Repositories;

use App\Models\Training\School\AutoSchool;

class AutoSchoolRepository
{
    public $autoSchool;

    public function __construct(AutoSchool $autoSchool)
    {
        $this->autoSchool = $autoSchool;
    }

    public function getList($investorId = null)
    {
        if($investorId)
        {
            return $this->autoSchool->investor($investorId)->get();
        }

        return $this->autoSchool->all();
    }
}