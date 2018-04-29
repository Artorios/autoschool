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
        $id = (integer)$request->id;


        $autoschool_id = AutoSchoolGroup::where('id', $id)->firstOrFail()->auto_school_id;

        $director = AutoSchool::where('id', $autoschool_id)->firstOrFail()->director_id;
        if($director == Auth::user()->id){
            return $next($request);
        }
        else{
            return back();
        }

    }
}