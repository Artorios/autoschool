<?php

namespace App\Http\Controllers\Investor;

use App\Repositories\AutoSchoolRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Investor
 */
class DashboardController extends Controller
{
    /**
     * @var AutoSchoolRepository
     */
    public $autoSchoolRepository;

    /**
     * DashboardController constructor.
     * @param AutoSchoolRepository $autoSchoolRepository
     */
    public function __construct(AutoSchoolRepository $autoSchoolRepository)
    {
        $this->autoSchoolRepository = $autoSchoolRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $schools = ($this->autoSchoolRepository->getList(Auth::id()));

        return view('investor.index', compact('schools'));
    }
}
