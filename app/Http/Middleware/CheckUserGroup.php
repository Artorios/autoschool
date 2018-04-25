<?php

namespace App\Http\Middleware;

use App\Models\Training\School\AutoSchoolGroup;
use Closure;

/**
 * Class CheckUserGroup
 * @package App\Http\Middleware
 */
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
        $groupsRelatedToFilial = AutoSchoolGroup::where('auto_school_filial_id', $request->route('id'))->get()->toArray();

        $groupsId = array_map(function($item){
            return $item['id'];
        }, $groupsRelatedToFilial);

        $belongs = in_array($request->route('group_id'), $groupsId);

        if(!$belongs){
            return abort(404);
        }

        return $next($request);
    }
}
