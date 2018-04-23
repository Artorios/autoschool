<?php
namespace App\Http\Controllers\Autoschool;


use App\Http\Controllers\Controller;

class ResultController extends Controller
{

    public function __invoke()
    {
        return view('autoschool.results.list');
    }
}