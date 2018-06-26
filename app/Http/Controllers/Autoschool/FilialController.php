<?php

namespace App\Http\Controllers\Autoschool;

use App\Http\Requests\{
    StoreFilial, StoreGroup
};
use App\Http\Controllers\Controller;
use App\Models\Finance\Order;
use App\Models\User\User;
use App\Models\Training\School\{
    AutoSchool, AutoSchoolGroup
};
use App\Models\User\UserSchool;
use Illuminate\Support\Facades\{
    Auth, DB
};

/**
 * Class FilialController
 * @package App\Http\Controllers\Autoschool
 */
class FilialController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $filials = AutoSchool::orderBy('id', 'asc')
            ->where('director_id', Auth::user()->id)
            ->with('addresses')
            ->with('city')
            ->get();

        $autoschool = AutoSchool::where('director_id', Auth::user()->id)->get();
        return view('autoschool.filials.filials', compact('filials', 'autoschool'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function newStudents()
    {
        $orders = Order::where('auto_school_id', '!=', '0')->get()->toArray();

        $users_id = array_map(
            function ($order) {
                return $order['user_id'];
            }, $orders
        );

        $students = User::where('auto_school_group_id', null)->where('role', 'user')->whereIn('id', $users_id)->get();
        $group = collect([
            'name' => 'Нераспределённые'
        ]);
        return view('autoschool.students.new', compact('students', 'group'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function newSelectStudents()
    {
        $orders = Order::where('auto_school_id', '!=', '0')->get()->toArray();
        $schools = AutoSchool::where('director_id', Auth::user()->id)->get()->toArray();
        $schools_id = array_map(
            function ($school) {
                return $school['id'];
            }, $schools
        );
        $users = UserSchool::all()->whereIn('school_id', $schools_id)->toArray();
        $users_id = array_map(
            function ($select) {
                return $select['user_id'];
            }, $users
        );
        $new_id = array_map(
            function ($order) {
                return $order['user_id'];
            }, $orders
        );

        $students = User::where('auto_school_group_id', null)->where('role', 'user')->whereIn('id', $users_id)->whereNotIn('id', $new_id)->get();
        $group = collect([
            'name' => 'Выбрали автошколу(неоплачено)'
        ]);
        return view('autoschool.students.new', compact('students', 'group'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage()
    {
        return view('autoschool.index.edit');
    }

    /**
     * @param  StoreFilial $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createFilial(StoreFilial $request)
    {
        DB::transaction(function () use ($request) {
            $filial = AutoSchool::create($request->validated());
            $filial->contacts()->create([
                'type' => 'address',
                'value' => $request->post('address')
            ]);
        });
        return response()->json(['status' => 1], 201);
    }

    /**
     * @param  StoreGroup $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createGroup(StoreGroup $request)
    {
        $data = $request->all();
        $idNumber = AutoSchoolGroup::where('auto_school_id', $data['auto_school_id'])->count();
        $data['id_number'] = ++$idNumber;
        $group = AutoSchoolGroup::create($data);
        return response()->json(['status' => 1, 'group' => $group], 201);
    }

    /**
     * @param  integer $id
     * @param  AutoSchoolGroup $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, AutoSchoolGroup $group)
    {
        $filial = AutoSchool::where('id', $id)->first();
        $groups = $group->where(['auto_school_id' => $id])->get();


        //new students, not payment

        $orders = Order::where('auto_school_id', '!=', '0')->get()->toArray();
        $schools = AutoSchool::where('director_id', Auth::user()->id)->get()->toArray();
        $schools_id = array_map(
            function ($school) {
                return $school['id'];
            }, $schools
        );
        $users = UserSchool::all()->whereIn('school_id', $schools_id)->toArray();
        $users_id = array_map(
            function ($select) {
                return $select['user_id'];
            }, $users
        );
        $new_id = array_map(
            function ($order) {
                return $order['user_id'];
            }, $orders
        );


        $students_pay = User::where('auto_school_group_id', null)->where('role', 'user')->whereIn('id', $users_id)->whereNotIn('id', $new_id)->count();

        //new students, payment

        $students_id = array_map(
            function ($order) {
                return $order['user_id'];
            }, $orders
        );

        $students_unpay = User::where('auto_school_group_id', null)->where('role', 'user')->whereIn('id', $students_id)->count();

        return view('autoschool.filials.groups', compact('filial', 'groups', 'students_pay', 'students_unpay'));
    }

    /**
     * @param  integer $id
     * @param  User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStudents($id, User $user)
    {
        return view('autoschool.students.list');//, compact('students'));
    }
}
