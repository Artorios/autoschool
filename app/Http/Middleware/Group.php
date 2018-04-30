<?php

namespace App\Http\Middleware;

use App\Models\Training\School\{AutoSchoolGroup, AutoSchool};
use Illuminate\Support\Facades\Auth;
use Closure;

class Group
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $schoolId = AutoSchoolGroup::where('id',$request->route('id'))->firstOrFail()->auto_school_id;
        $director = AutoSchool::where('id', $schoolId)->firstOrFail()->director_id;

        return $director == Auth::user()->id ? $next($request) : back();

    }
}