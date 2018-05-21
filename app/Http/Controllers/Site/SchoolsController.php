<?php

namespace App\Http\Controllers\Site;

use App\Models\Training\School\AutoSchool;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

/**
 * Class SchoolsController
 * @package App\Http\Controllers\Site
 */
class SchoolsController extends Controller
{
    /**
     * @param int $city_id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchools($city_id = 0)
    {
        $schools = AutoSchool::with('city', 'phones', 'addresses');

        if ($city_id) {
            $schools->where('city_id', $city_id);
        }

        return response()->json($schools->get(), 200);
    }

    public function confirmStudent($confirmation_code)
    {
        try {
            $user = User::where('confirmation_code', $confirmation_code)->get()->first();
            $user->update(['activated' => '1']);
            Auth::loginUsingId($user->id);
            return redirect('account/');
        }catch (\Exception $exception) {
            return redirect('/');
        }
    }
}
