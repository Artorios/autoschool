<?php

namespace App\Http\Middleware;

use App\Models\Training\School\AutoSchoolFilial;
use App\Models\Training\School\AutoSchoolGroup;
use Closure;

class CheckUserGroup
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
        $groups_belonging_to_this_filial = AutoSchoolGroup::where('auto_school_filial_id', '=', $request->route('id'))->get()->toArray();
        $groups_id = array_map(function($array){
            return $array['id'];
        }, $groups_belonging_to_this_filial);

        if(!in_array($request->route('group_id'), $groups_id)){
            return abort(404);
        }
        return $next($request);
    }
}
