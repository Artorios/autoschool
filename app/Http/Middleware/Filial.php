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
        $id = $request->id;
        if(AutoSchool::find($id)){
            $autoschool = AutoSchool::where('id', $id)->first();
            if($autoschool->director_id == Auth::user()->id){
                return $next($request);
            }
            else{

                return redirect('/autoschool/filials');
            }

        }
        return redirect('/');
    }
}
