<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Middleware\Group;
use App\Http\Requests\NewStudent;
use App\Mail\ConfirmEmail;
use App\Models\Finance\Coupon;
use App\Models\Location\City;
use App\Models\Training\School\{AutoSchool, AutoSchoolGroup};
use App\Models\User\{
    Contract, UserLessonTrainingQuestion, User, UserSchool
};
use App\Services\StatisticService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\{
    Auth, Hash, Validator, DB
};
use Psy\Exception\ErrorException;

class StudentController extends Controller
{
    /**
     * @param  integer $id
     * @param  User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id, User $user)
    {
        $students = $user->where(['auto_school_group_id' => $id])->whereIn('role', ['user'])->get();
        /*foreach ($students as $student){
            return dd($student->progress);
        }*/
        $group    = AutoSchoolGroup::where('id',$id)->first();

        return view('autoschool.students.list', compact('students', 'group'));
    }

    public function indexStudent(Request $request, User $user)
    {
        $studentWithOrders = User::leftjoin('orders', 'users.id', 'orders.user_id')
            ->where('users.id', $request->student)
            ->select(['*',
                'users.name as userName',
                'users.created_at as DateCreateUser'
            ])
            ->get()
            ->first();


        $studentWithAutoSchool = User::leftjoin('auto_school_groups', 'users.auto_school_group_id', 'auto_school_groups.id')
            ->join('auto_schools', 'auto_school_groups.auto_school_id', 'auto_schools.id')
            ->select(['*', 'auto_school_groups.name as autoSchoolGroupName', 'users.id as userId'])
            ->where('users.id', $request->student)
            ->get()
            ->first();

        $studentWithAddress = User::leftjoin('cities', 'users.city_id', 'cities.id')
            ->where('users.id', $request->student)
            ->select(['*', 'cities.name as cityName'])
            ->get()
            ->first();

        $director = Auth::user();
        $student = $user->where('id', $request->student)->with('orders')->with('coupons')->with('city')->first();
        $group = AutoSchoolGroup::where('id', $student->auto_school_group_id)->with('autoschool')->first();
        return view('autoschool.personal.index', compact('studentWithOrders', 'studentWithAutoSchool', 'studentWithAddress','student','director','group'));

    }

    public function indexStudentNew($id)
    {
        $student = User::where('users.id', $id)
            ->with('city')
            ->with('orders')
            ->with('coupons')
            ->get()
            ->first();
        $status = 0;
        if($student->orders()->count() > 0){
            $status = 'paid';
        }
        else{
            if($student->coupons()->count() > 0){
                foreach ($student->coupons as $coupon){
                    $st = 0;
                    if($coupon->status == 3){
                        $status = 'paid';
                        $st = 1;
                    }
                }
                if($st == 0){
                    $status = 'not_paid';
                }
            }
            else{
                $status = 'not_paid';
            }

        }

        $director = Auth::user();
        $school_id = UserSchool::where('user_id', $student->id)->first();
        $school = '';
        if(!empty($school_id)){
            $school = AutoSchool::find($school_id->school_id);
        }
        return view('autoschool.personal.new', compact('student','status','director', 'school'));
    }

    public function addStudent($filial)
    {
        $schools   = AutoSchool::select('id')->where('director_id', Auth::user()->id)->get()->toArray();
        $schools_id = array_map(function ($school) {
            return $school['id'];
        }, $schools);
        if($filial == 0){
            $groups = AutoSchoolGroup::whereIn('auto_school_id', $schools_id)->get();
            $coupons = Coupon::whereIn('auto_school_id', $schools_id)->where('status', 1)->get();

        }
        else{
            $groups = AutoSchoolGroup::where('auto_school_id', $filial)->get();
            $coupons = Coupon::where('auto_school_id', $filial)->where('status', 1)->get();

        }
        $cities = City::where('show_city', 1)->get();
        return view('autoschool.filials.add-student', compact('schools', 'groups', 'coupons', 'cities'));
    }

    public function saveGroupNew(Request $request){
        $itempost = $request->all();
        if(!empty($itempost['user_id']) && !empty($itempost['auto_school_group_id'])){
            User::where('id', $itempost['user_id'])->update(['auto_school_group_id' => $itempost['auto_school_group_id']]);
            return response()->json(['status' => $itempost], 202);
        }
        else{
            return response()->json(['status' => $itempost], 402);
        }

    }

    public function saveNewStudent(NewStudent $request, Mailer $mailer)
    {
        $request->validated();

        $data = $request->only([
            'name',
            'last_name',
            'second_name',
            'email',
            'phone',
            'license',
            'city_id',
            'auto_school_group_id'
        ]);

        $passwordForSendEmail = str_random(8);


        try {
            $data['role']              = 'user';
            $data['confirmation_code'] = str_random(30);
            $data['password'] = $passwordForSendEmail;
            $data['email_notice'] = 1;
            $data['sms_notice'] = 1;
            $data['activated'] = 0;

            $user = User::create($data);
            $user['password_for_send_user_email'] = $passwordForSendEmail;

            DB::transaction(function () use ($user, $request) {
                if(!empty($request->coupon)){
                    $coupon = Coupon::where('id', $request->coupon)->update([
                        'status' => 3,
                        'student_id' => $user->id,
                        'activated_at' => Carbon::now()
                    ]);
                }

                $contract = Contract::create([
                    'name' => generateContractNumber($user),
                    'user_id' => $user->id
                ]);

            });
            Controller::notification($user->id, 'Вы поступили в Школу Автотренер! 
Мы скоро свяжемся с Вами и согласуем детали обучения.');

            $mailer->to($data['email'])->send(new ConfirmEmail($user));

            return response()->json(['status' => 1, 'group' => $data['auto_school_group_id']], 201);

        }catch (ErrorException $e){
            return response(['status' => 0], 400);
        }
    }

    public function getGroupsAutoSchool(Request $request)
    {
        return AutoSchoolGroup::where('auto_school_id', $request->input('id'))->get();
    }

    public function statisticsTests($id_group, $id_student, StatisticService $statisticService, UserLessonTrainingQuestion $userLessonTrainingQuestion)
    {
        $user = User::where('id', $id_student)->get()->first();
        $lessons = $user->lessons->unique('lesson_num');
        $lessons = $lessons->toArray();

        if (count($lessons)) {
            return view('autoschool.statistic.index',
                $statisticService->progress($user, $lessons, $userLessonTrainingQuestion));
        }
        return view('autoschool.statistic.index');
    }

    public function examStatistics($id, $id_student, StatisticService $statisticService)
    {
        $user = User::where('id', $id_student)->get()->first();
        return view('autoschool.exams.index', $statisticService->exam($user));
    }
}
