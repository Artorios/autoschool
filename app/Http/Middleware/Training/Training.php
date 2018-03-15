<?php

namespace App\Http\Middleware\Training;

use Closure;

/**
 * Class Training
 * @package App\Http\Middleware\Training
 */
class Training
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user   = \Auth::user();
        $lesson = $request->route('lesson');

        if ( ! $user_video = $user->lessonsVideos->where('lesson_id', $lesson->id)->first()) {
            return redirect('/account/lessons/' . $lesson->id);
        }

        if ( ! $user_video->pivot->viewed) {
            return redirect('/account/lessons/' . $lesson->id);
        }

        return $next($request);
    }
}
