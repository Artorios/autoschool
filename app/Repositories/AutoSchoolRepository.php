<?php

namespace App\Repositories;

use App\Models\Training\School\AutoSchool;

/**
 * Class AutoSchoolRepository
 * @package App\Repositories
 */
class AutoSchoolRepository
{
    /**
     * @var AutoSchool
     */
    public $autoSchool;

    /**
     * AutoSchoolRepository constructor.
     * @param AutoSchool $autoSchool
     */
    public function __construct(AutoSchool $autoSchool)
    {
        $this->autoSchool = $autoSchool;
    }

    /**
     * Get a list of driving schools
     *
     * @param null $investorId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList($investorId = null)
    {
        if($investorId)
        {
            //TODO: необходимо добавить "Купоны активные/неактивные/всего" и вывести Комиссию
            return $this->autoSchool->investor($investorId)->with('city')->get();
        }

        return $this->autoSchool->all();
    }
}