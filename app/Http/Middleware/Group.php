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
        $id = $request->id;

        if(AutoSchoolGroup::find($id)){
            $autoschool_id = AutoSchoolGroup::where('id', $id)->first()->auto_school_id;
            if(!empty($autoschool_id)){
                $director = AutoSchool::where('id', $autoschool_id)->first()->director_id;
                if($director == Auth::user()->id){
                    return $next($request);
                }
                else{
                    return back();
                }
            }
            else{
                return back();
            }
        }
        else{
            return back();
        }
    }
}