<?php

namespace App\Http\Controllers\Admin\UserActions;

use App\Http\Requests\Admin\{
    CreateUserInAdmin, SearchUser, UpdateUserInAdmin, PaymentUserInAdmin, InvestorUserInAdmin
};
use App\Models\Finance\Order;
use App\Models\Training\School\AutoSchool;
use App\Models\User\InvestorInfo;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\{Validator, DB};
use Illuminate\Validation\Rule;
use Psy\Exception\ErrorException;
use App\Models\User\Contract;
use App\Mail\ConfirmEmail;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin\UserActions
 */
class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listUsers(User $user, AutoSchool $autoSchool)
    {
        $users_list = $user->with('autoschoolgroup')->with('directors')->with('city.region')->with('orders')->with('coupons')->with('info')->get()->toArray();
        $schools = $autoSchool->get()->toArray();

        $users = array_map(function ($user) use ($schools) {
            foreach ($schools as $school) {
                if (isset($user['autoschool']) && $user['autoschool'] === $school['id']) {
                    $user['school'] = $school;
                }
            }
            return $user;
        }, $users_list);

        $role = 'all';

        return view('admin.user.index', compact('users', 'role'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public function listUsersRole(User $user, AutoSchool $autoSchool, $role)
    {

        $users_list = $user->where('role', $role)->with('autoschoolgroup')->with('orders')->with('coupons')->with('info')->with('city.region')->get()->toArray();
        $schools = $autoSchool->get()->toArray();

        $users = array_map(function ($user) use ($schools) {
            foreach ($schools as $school) {
                if (isset($user['autoschool']) && $user['autoschool'] === $school['id']) {
                    $user['school'] = $school;
                }
            }
            return $user;
        }, $users_list);


        return view('admin.user.index', compact('users', 'role'));

    }

    /**
     * @param User $user
     * @param UpdateUserInAdmin $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(User $user, UpdateUserInAdmin $request)
    {
        $validated = $request->validated();
        if(isset($validated['central'])){
            $central_id = $validated['central'];
            unset($validated['central']);

        }
        else{
            $central_id = 0;
        }
        DB::transaction(function () use ($validated,$central_id, $user) {

            $user->update($validated);
            if($central_id != 0)  {
                $school = AutoSchool::where('id', $central_id)->first();
                $schools = AutoSchool::where('director_id', $school->director_id)->update(['central' => 0]);
                AutoSchool::where('id', $central_id)->update(['central' => 1]);
            }
        });
        return response()->json(['status' => 1], 202);

    }

    /**
     * @param Order $order
     * @param PaymentUserInAdmin $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function pay(Order $order, PaymentUserInAdmin $request)
    {


        $order->create($request->validated());
        return response()->json(['status' => 1], 202);


    }

    /**
     * @param InvestorInfo $info
     * @param PaymentUserInAdmin $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function investorInfoSave(InvestorInfo $info, InvestorUserInAdmin $request)
    {
        $count = $info->where('user_id', $request->get('user_id'))->count();
        if ($count > 0) {
            $info->where('user_id', $request->get('user_id'))->update($request->validated());
        } else {
            $info->create($request->validated());
        }

        return response()->json(['status' => $request->validated()], 202);

    }

    /**
     * @param CreateUserInAdmin $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateUserInAdmin $request, Mailer $mailer)
    {

        $data = $request->validated();
        $data['email_notice'] = 1;
        $data['confirmation_code'] = str_random(30);
        $data['sms_notice'] = 1;
        $data['activated'] = 0;
        DB::transaction(function () use ($data, $mailer) {
            $user = User::create($data);
            $contract = Contract::create([
                'name' => generateContractNumber($user),
                'user_id' => $user->id
            ]);
            Controller::notification($user->id, 'Вы поступили в Школу Автотренер! 
Мы скоро свяжемся с Вами и согласуем детали обучения.');
            $mailer->to($data['email'])->send(new ConfirmEmail($user));


        });


        return response()->json(['status' => $data], 201);

    }

    public function listStudents()
    {
        return view('admin.students.index');
    }

    public function getListStudents()
    {
        $data = AutoSchool::join('auto_school_groups', 'auto_schools.id', '=', 'auto_school_groups.auto_school_id')
            ->join('users', 'auto_school_groups.id', '=', 'users.auto_school_group_id')
            ->join('cities', 'users.city_id', '=', 'cities.id')
            ->leftjoin('coupons', 'users.id', '=', 'coupons.student_id')
            ->select(['*',
                'users.name as studentName',
                'users.second_name as studentSecondName',
                'users.last_name as studentLastName',
                'cities.name as cityName',
                'auto_schools.title as AutoschoolName',
                'auto_school_groups.name as AutoschoolGroupName',
                'users.phone as UserPhone',
                'users.email as UserEmail',
                'coupons.status as CuponStatus',
            ])
            ->get();
        return response()->json([
            'data' => $data
        ], 201);
    }
}
