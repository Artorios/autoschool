<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Account\NotificationController;
use App\Http\Requests\{NewRegistrationStudent, Registration};
use App\Mail\ConfirmEmail;
use App\Models\User\{Contract, Notification ,  User};
use App\Models\Location\Region;
use App\Notifications\UserRegistration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, Mail, Validator};
use Psy\Exception\ErrorException;
use Illuminate\Mail\Mailer;
use App\Models\Training\Lesson\Lesson;

/**
 * Class RegistrationController
 * @package App\Http\Controllers\Site
 */
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registration(NewRegistrationStudent $request, Notification $notification, Mailer $mailer)
    {
        $request->validated();
        try {
            $data = $request->only([
                'name',
                'last_name',
                'second_name',
                'email',
                'phone',
                'password',
                'city_id',
                'license'
            ]);

            $data['role']              = 'user';
            $data['confirmation_code'] = str_random(30);
            $data['activated'] = 0;
            $user                      = User::create($data);
            $full_name                 = $user->name . ' ' . $user->last_name;
            $user['password_for_send_user_email'] = $data['password'];

            $contract = Contract::create([
                'name' => generateContractNumber($user),
                'user_id' => $user->id
            ]);

            $mailer->to($data['email'])->send(new ConfirmEmail($user));

            Controller::notification($user->id,'Вы поступили в Школу Автотренер! 
Мы скоро свяжемся с Вами и согласуем детали обучения.');
            Auth::loginUsingId($user->id);

            //$user->notify(new UserRegistration($full_name, $user->confirmation_code));
            $lessons = Lesson::where('license', auth()->user()->license)->orderBy('lesson_num', 'ASC')->get();
//        $lessons = Lesson::all();

            $user_lessons = $user->lessons;
            $lessons->load('videos.userVideos');

            foreach ($user_lessons as $user_lesson) {
                foreach ($lessons as $lesson) {
                    if ($user_lesson->id === $lesson->id) {
                        $lesson->locked = 0;
                    }
                }
            }


            return response()->json(['status' => 1], 201);
        } catch (ErrorException $e) {
            return response(['status' => 0], 400);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);

        if (count($validator)) {
            return response()->json(['status' => 0], 400);
        }

        $credentials = $request->only(['email', 'password']);

    }
}
