<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\AutoSchool;
use App\Models\Training\School\AutoSchoolGroup;
use App\Models\User\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $group = AutoSchoolGroup::where('id',$id)->first();

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
        return view('autoschool.filials.add-student', compact('autoschool'));
    }

    public function saveNewStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|min:3',
            'last_name'   => 'required|string|min:3',
            'second_name' => 'string|min:3',
            'email'       => 'required|email|unique:users,email',
            'phone'       => 'required',
            'auto_school_id' 		  => 'required|exists:auto_schools,id',
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
            'auto_school_id',
            'license',
            'auto_school_group_id'
        ]);

        try {
            $data['role']              = 'user';
            $data['confirmation_code'] = str_random(30);
            $user                      = User::create($data);

            $contract = Contract::create([
                'name' => generateContractNumber($user),
                'user_id' => $user->id
            ]);
            return response()->json(['status' => 1, 'group' => $user['auto_school_group_id']], 201);

        }catch (ErrorException $e){
            return response(['status' => 0], 400);
        }
    }

    public function getGroupsAutoSchool(Request $request)
    {
        return AutoSchoolGroup::where('id', $request->input('id'))->get();
    }
}
