<?php

namespace App\Http\Middleware;

use App\Models\Training\School\AutoSchoolFilial;
use Closure;

class CheckUserFilial
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
        $groups_belonging_to_this_user = AutoSchoolFilial::where('auto_school_id', '=', auth()->user()->autoschoolgroup->autoschoolfilial->autoschool->id)->get()->toArray();
        $groups_id = array_map(function($array){
            return $array['id'];
        },$groups_belonging_to_this_user);

        if(!in_array($request->route('id'), $groups_id)){
            return abort(404);
        }

        return $next($request);
    }
}
