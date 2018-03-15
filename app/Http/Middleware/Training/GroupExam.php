<?php

namespace App\Http\Middleware\Training;

use Closure;

/**
 * Class GroupExam
 * @package App\Http\Middleware\Training
 */
class GroupExam
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
        $user   = \Illuminate\Support\Facades\Auth::user();
        $lesson = $request->route('lesson');

        $user_exam = $user->lessonsTrainings()
            ->where(['lesson_id' => $lesson->id, 'status' => 'passed', 'type' => 'exam'])
            ->first();

        if ( ! $user_exam) {
            return redirect('/account/lessons/' . $lesson->id);
        }

        return $next($request);
    }
}
