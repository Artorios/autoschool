<?php

namespace App\Http\Middleware;

use App\Models\Training\School\AutoSchoolFilial;
use Closure;
use Illuminate\Support\Facades\Auth;

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
        $groupsBelongsToUser = AutoSchoolFilial::where(
            'auto_school_id', '=', Auth::user()->autoschoolgroup->autoschoolfilial->autoschool->id
        )->get()->toArray();

        $groupsId = array_map(function ($item) {
            return $item['id'];
        }, $groupsBelongsToUser);

        $belongs = in_array($request->route('id'), $groupsId);

        if(!$belongs){
            return abort(404);
        }

        return $next($request);
    }
}
