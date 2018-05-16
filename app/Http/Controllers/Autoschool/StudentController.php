<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Finance\Coupon;
use App\Models\Training\School\{AutoSchool, AutoSchoolGroup};
use App\Models\User\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Support\Facades\{Auth, Validator, DB};
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

    public function indexStudent(Request $request)
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
            ->select(['*', 'auto_school_groups.name as autoSchoolGroupName'])
            ->where('users.id', $request->student)
            ->get()
            ->first();

        $studentWithAddress = User::leftjoin('cities', 'users.city_id', 'cities.id')
            ->where('users.id', $request->student)
            ->select(['*', 'cities.name as cityName'])
            ->get()
            ->first();

        return view('autoschool.personal.index', compact('studentWithOrders', 'studentWithAutoSchool', 'studentWithAddress'));

    }

    public function addStudent()
    {
        $autoschool = AutoSchool::where('director_id', Auth::user()->id)
            ->with('autoschoolGroups')
            ->get();
        $schools   = AutoSchool::select('id')->where('director_id', Auth::user()->id)->get()->toArray();
        $schools_id = array_map(function ($school) {
            return $school['id'];
        }, $schools);
        $coupons = Coupon::whereIn('auto_school_id', $schools_id)->where('status', 1)->get();
        return view('autoschool.filials.add-student', compact('autoschool', 'coupons'));
    }

    public function saveNewStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|min:3',
            'last_name'   => 'required|string|min:3',
            'second_name' => 'string|min:3',
            'email'       => 'required|email|unique:users,email',
            'phone'       => 'required',
            'coupon' 		  => 'required|exists:coupons,id',
            'auto_school_group_id' 		  => 'required|exists:auto_school_groups,id',
        ]);

        if (count($validator->errors())) {
            return response()->json(['registerErrors' => $validator->errors(), 'status' => 0], 400);
        }

        $data = $request->only([
            'name',
            'last_name',
            'second_name',
            'email',
            'phone',
            'password',
            'license',
            'auto_school_group_id'
        ]);

        try {
            $data['role']              = 'user';
            $data['confirmation_code'] = str_random(30);

            DB::transaction(function () use ($data, $request) {

                $user = User::create($data);
                $coupon = Coupon::where('id', $request->coupon)->update([
                    'status' => 3,
                    'student_id' => $user->id
                ]);
                $contract = Contract::create([
                    'name' => generateContractNumber($user),
                    'user_id' => $user->id
                ]);

            });

            return response()->json(['status' => 1, 'group' => $data['auto_school_group_id']], 201);

        }catch (ErrorException $e){
            return response(['status' => 0], 400);
        }
    }

    public function getGroupsAutoSchool(Request $request)
    {
        return AutoSchoolGroup::where('auto_school_id', $request->input('id'))->get();
    }
}
