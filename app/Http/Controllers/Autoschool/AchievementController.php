<?php
namespace App\Http\Controllers\Autoschool;


use App\Http\Controllers\Controller;

class AchievementController extends Controller
{

    public function __invoke()
    {
        return view('autoschool.achievement.list');
    }
}