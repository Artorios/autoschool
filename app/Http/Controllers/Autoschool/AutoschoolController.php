<?php

namespace App\Http\Controllers\Autoschool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AutoschoolController extends Controller
{
    public function editPage(){


        return view('autoschool.index.edit');
    }
}
