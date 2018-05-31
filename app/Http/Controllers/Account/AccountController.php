<?php

namespace App\Http\Controllers\Account;

use App\Events\UserPasswordChangeRequestEvent;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use App\Models\{
    Location\City,
    User\User
};
use App\Services\ChangePasswordService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\{
    Auth,
    DB,
    Storage,
    Validator
};

/**
 * Class AccountController
 * @package App\Http\Controllers\Account
 */
class AccountController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateProfile(Request $request, User $user, City $city)
    {
        $itempost = $request->except(
        'autoschool',
            'lesson_now',
            'last_exam',
            'progress'
        );
        $itempost['auto_school_group_id'] = $itempost['autoschoolgroup']['id'];
        unset($itempost['autoschoolgroup']);
        $validator = Validator::make($itempost, [
            'name'      => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'phone'     => 'required',
            'city_id'   => 'required',
            'license'   => 'required'
        ]);
        if (count($validator->errors())) {
            return response()->json(['status' => 0], 400);
        }

        $validator = Validator::make($itempost, [
            'email' => 'unique:users,email,' . $itempost['id']
        ]);

        if (count($validator->errors())) {
            return response()->json(['status' => 5], 400);
        }

        $user->where(['id' => $itempost['id']])->update($itempost);
        return response()->json(['status' => 1], 201);

    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
//    public function updatePassword(Request $request, User $user)
//    {
//        $password = $request->input('password');
//        $newPassword = $request->input('new_password');
//        $newPassword = bcrypt($newPassword);
//        $userNow = Auth::user();
//        $oldPassword = $user->select('password')->where(['id' => $userNow['id']])->firstOrFail();
//
//        switch (Auth::user()->role) {
//            case 'admin':
//                $redirectTo = '/admin'; break; //TODO::set URL
//            case 'autoschool':
//                $redirectTo = '/autoschool/profile-edit'; break;
//            case 'user':
//                $redirectTo = '/account/edit-profile'; break;
//            case 'investor':
//                $redirectTo = '/investor/profile/edit'; break;
//        }
//        if (Hash::check($password, $oldPassword['password'])) {
//            $user->where(['id' => $userNow['id']])->update(['password' => $newPassword]);
//            return response()->json(['status' => 1, 'redirectUrl' => $redirectTo], 201);
//        } else {
//            return response()->json(['status' => 0, 'redirectUrl' => $redirectTo], 422);
//        }
//    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function editNotifySettings(Request $request)
    {
        User::where(['id' => $request->input('id')])->update(['email_notice' => $request->input('email_notice')]);
        User::where(['id' => $request->input('id')])->update(['sms_notice' => $request->input('sms_notice')]);
        return response()->json(['status' => 1], 204);

    }

    public function saveProfileImage(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('img')) {
            $file = $request->file('img');

            $validator = Validator::make($request->all(), [
                'img' => 'required|mimes:jpeg,bmp,png',
            ]);

            if (count($validator->errors())) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            try {
                $file_name = sha1_file($file) . $file->getCTime() . '.' . $file->getClientOriginalExtension();
                Storage::putFileAs('public/user', $file, $file_name);
                if ($user->image && 'public/user/' . $user->image) {
                    //delete photo
                    Storage::delete('public/user/' . $user->image);
//                    unlink('public/user' . $user->image);
                }
                $user->update(['image' => $file_name]);
                return response()->json(['status' => 1], 201);
            } catch (ErrorException $e) {
                return response()->json(['status' => 0], 402);
            }
            return response()->json(['status' => 6], 200);
        }


//        return response()->json(['status' => 0], 200);
    }

    public function editProfile()
    {
        $cities = City::where('show_city', 1)->get();
        $user = Auth::user();
        return view('account.profile.index', compact('cities', 'user'));

    }

    /**
     * @param ChangePasswordRequest $request
     * @param Mailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createPassword(ChangePasswordRequest $request, Mailer $mailer)
    {
        $token = str_random();

        DB::table('password_resets')->insert([
            'email'      => Auth::user()->email,
            'token'      => $token,
            'created_at' => Carbon::now()
        ]);

        $url = [url('/')];
        $url[] = '/change-password';
        $url[] = '/' . encrypt($token);
        $url[] = '/' . encrypt($request->get('password'));

        event(new UserPasswordChangeRequestEvent(implode($url), Auth::user()->email));

        session()->flash('pass_message', 'Check email in order to change password');
        session()->flash('pass_class', 'success');

        return back();
    }

    /**
     * @param string $token
     * @param string $password
     * @param Mailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(string $token, string $password)
    {
        $instance = DB::table('password_resets')->where('token', decrypt($token))->first();

        session()->flash('pass_message', 'Date expired');
        session()->flash('pass_class', 'danger');

        if (Carbon::parse($instance->created_at)->addHour() > Carbon::now()) {

            $passwordChanged = app(ChangePasswordService::class, [
                    'password' => decrypt($password),
                    'user'     => User::where('email', $instance->email)->first()]
            )->changeUserPassword();

            if ($passwordChanged) {
                session()->flash('pass_message', 'Password changed');
                session()->flash('pass_class', 'success');
            }
        }

        return redirect()->route('home');
    }
}
