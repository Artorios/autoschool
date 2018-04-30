<?php

namespace App\Http\Controllers\Investor;

use App\Repositories\AutoSchoolRepository;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public $autoSchoolRepository;

    public function __construct(AutoSchoolRepository $autoSchoolRepository)
    {
        $this->autoSchoolRepository = $autoSchoolRepository;
    }

    public function show()
    {
        $autoSchools = ($this->autoSchoolRepository->getList(7));

        return view('investor.index', compact('autoSchools'));
    }
}
