<?php

namespace App\Http\Middleware\Training;

use Closure;
use DateTime;
use DateTimeZone;

/**
 * Class Exam
 * @package App\Http\Middleware\Training
 */
class Exam
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
        $user          = \Illuminate\Support\Facades\Auth::user();
        $lesson        = $request->route('lesson');
        $user_training = $user->lessonsTrainings()->where([
            'lesson_id' => $lesson->id,
            'type'      => 'training'
        ])->where('status', '!=', null)->first();

        if ( ! $user_training) {
            return redirect('/account/lessons/' . $lesson->id);
        }

        if ( ! $user->lessonsTrainings()->where(['lesson_id' => $lesson->id, 'status' => 'passed', 'type' => 'exam'])->first()) {
            $last_failed = $user->lessonsTrainings()->where(['lesson_id' => $lesson->id, 'status' => 'failed', 'type' => 'exam'])->orderby('updated_at', 'DESC')->first(['updated_at']);

            if ($last_failed) {
                $last_date = new DateTime();
                $last_date->setTimezone(new DateTimeZone('UTC'));
                $interval = $last_date->diff(new DateTime($last_failed->updated_at->timezone('UTC')));

                if ((int) $interval->format('%h') == 0) {
                    $minutes = 60 - (int) $interval->format('%i');

                    return redirect('/account/lessons/exam/banned')->with(['lesson' => $lesson->toArray(), 'minutes' => $minutes]);
                }
            }
        }

        return $next($request);
    }
}
