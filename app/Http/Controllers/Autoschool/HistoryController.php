<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function __invoke()
    {
        return view('autoschool.histories.list');
    }
}
