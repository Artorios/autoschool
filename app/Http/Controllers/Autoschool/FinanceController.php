<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function __invoke()
    {
        return view('autoschool.finances.list');
    }
}
