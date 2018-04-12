<?php

namespace App\Http\Middleware\Training;

use App\Models\Training\Lesson\Lesson;
use Closure;
use DateTime;
use DateTimeZone;

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
        $group_limit = 3;

        $lessons     = Lesson::with('questions')
            ->where('id', '<=', $lesson->lesson_num)
            ->limit($group_limit)
            ->offset($lesson->lesson_num - $group_limit)
            ->get();

        $user_exam = $user->lessonsTrainings()
            ->where(['lesson_id' => $lesson->id, 'status' => 'passed', 'type' => 'exam'])
            ->first();

        if ( ! $user_exam) {
            return redirect('/account/lessons/' . $lesson->id);
        }

        if ( $user->lessonsTrainings()->where(['lesson_id' => $lesson->id, 'status' => 'failed', 'type' => 'group'])
            ->orderBy('id', 'desc')->first()) {

            $last_failed = $user->lessonsTrainings()->where(['lesson_id' => $lesson->id, 'status' => 'failed', 'type' => 'group'])->orderby('updated_at', 'DESC')->first(['updated_at']);
            if ($last_failed) {
                $last_date = new DateTime();
                $last_date->setTimezone(new DateTimeZone('UTC'));
                $interval = $last_date->diff(new DateTime($last_failed->updated_at->timezone('UTC')));

                if ((int) $interval->format('%h') == 0) {
                    $minutes = 60 - (int) $interval->format('%i');
                    return redirect('/account/lessons/group/banned')->with(['lessons' => $lessons->toArray(),
                        'lesson' => $lesson->toArray(), 'minutes' => $minutes]);
                }
            }
        }


        return $next($request);
    }
}
