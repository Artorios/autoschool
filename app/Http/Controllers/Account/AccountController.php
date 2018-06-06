<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\ChangePasswordRequest;
use App\Mail\ConfirmEmail;
use App\Mail\ConfirmPasswordChange;
use App\Mail\PasswordChanged;
use App\Models\Location\City;
use App\Models\Training\School\AutoSchool;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\{Auth, Hash, Storage, Validator};

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
            'name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'phone' => 'required',
            'city_id' => 'required',
            'license' => 'required'
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

    public function editNotifySettings(Request $request){
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
        $url = 'http://';

        if ($request->secure()) {
            $url = 'https://';
        }

        $url .= $request->getHttpHost();
        $url .= '/change-password';
        $url .= '/' . encrypt(Auth::id());
        $url .= '/' . encrypt($request->get('password'));
        $url .= '/' . encrypt(Carbon::now());

        $mailer->to(Auth::user()->email)->send(new ConfirmPasswordChange($url));

        session()->flash('pass_message', 'Check email in order to change password');
        session()->flash('pass_class', 'success');

        return back();
    }

    /**
     * @param string $id
     * @param string $password
     * @param string $date
     * @param Mailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(string $id, string $password, string $date, Mailer $mailer)
    {
        if (decrypt($date)->addHour() > Carbon::now()) {
            $user = User::find(decrypt($id));
            $password = decrypt($password);

            $user->update([
                'password' => Hash::make($password)
            ]);

            $mailer->to($user->email)->send(new PasswordChanged());

            session()->flash('pass_message', 'Password changed');
            session()->flash('pass_class', 'success');
        } else {
            session()->flash('pass_message', 'Date expired');
            session()->flash('pass_class', 'danger');
        }

        return redirect()->route('home');
    }
}
