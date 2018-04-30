<?php

namespace App\Http\Middleware;

use App\Models\Training\School\AutoSchool;
use Illuminate\Support\Facades\Auth;
use Closure;

class Filial
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
        $autoschool = AutoSchool::where('id', $request->get('id'))->firstOrFail();
        return $autoschool->director_id === Auth::user()->id ? $next($request) : redirect('/autoschool/filials');
    }
}
