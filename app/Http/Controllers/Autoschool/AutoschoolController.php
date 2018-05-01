<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\{
    AutoSchoolFilial, AutoSchoolGroup, AutoSchool
};
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class AutoschoolController
 * @package App\Http\Controllers\Autoschool
 */
class AutoschoolController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        $autoschool = AutoSchool::findOrFail(Auth::user()->autoschoolgroup->autoschoolfilial->auto_school_id);
        foreach ($autoschool->filials as $filial){
            $countOfUsers = 0;
            foreach (AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get() as $group){
                $countOfUsers += count($group->users->whereNotIn('role', ['admin','investor','autoschool']));
            }
            $filial->setAttribute('student_count', $countOfUsers);
        }
        return view('autoschool.filials.school_filials', compact('autoschool'));
    }

    /**
     * @return mixed
     */
    public function editPage(){
        return view('autoschool.index.edit');
    }

    public function getCountMain(AutoSchoolGroup $autoSchoolGroup, User $user){
        $filials = AutoSchoolFilial::where('auto_school_id', '=', Auth::user()->autoschoolgroup->autoschoolfilial->auto_school_id)->get();
        $groups = [];
        foreach ($filials as $filial){
            if(!empty(AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get()[0])){
                array_push($groups, AutoSchoolGroup::where('auto_school_filial_id', '=', $filial->id)->get());
            }
        }
        $counts = 0;

        foreach ($groups as $arrayGroup){
            foreach ($arrayGroup as $group){
                $counts += $user->where(['auto_school_group_id' => $group->id])->whereNotIn('role', ['admin','investor','autoschool'])->count();
            }
        }

        return response()->json(['counts' => $counts, 'coupons' => 0, 'income' => 0]);
    }

}
=========
<?php

namespace App\Http\Controllers\Autoschool;

use App\Models\Training\School\{
    AutoSchoolGroup, AutoSchool
};
use App\Models\User\User;
use App\Http\Controllers\Controller;
use App\Services\CountersService;
use Illuminate\Support\Facades\Auth;

/**
 * Class AutoschoolController
 * @package App\Http\Controllers\Autoschool
 */
class AutoschoolController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $filials = AutoSchool::select('id')->where('director_id', Auth::user()->id)->get()->toArray();

        $groups_id = array_map(function ($filial) {
            return $filial['id'];
        }, $filials);

        $groups = AutoSchoolGroup::whereIn('auto_school_id', $groups_id)->get();

        return view('autoschool.index.index', compact('groups'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage()
    {
        $info_about_school = Auth::user()->autoschoolgroup->autoschool->info;
        return view('autoschool.index.edit', compact('info_about_school'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountMain(CountersService $countersService)
    {
        return response()->json([
            'counts' => $countersService->getCountStudentsInAutoSchool(),
            'coupons' => $countersService->getCountFreeCupon(),
            'income' => $countersService->getCountIncomeAutoSchool()
        ]);
    }

    /**
     * @param  integer $filial_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountFilials($filial_id)
    {
        $groups = AutoSchoolGroup::where('auto_school_id', $filial_id)->get()->toArray();
        $groups_id = array_map(function ($group) {
            return $group['id'];
        }, $groups);
        $counts = User::all()->whereIn('auto_school_group_id', $groups_id)
            ->whereIn('role', ['user'])
            ->count();

        return response()->json(['counts' => $counts, 'coupons' => 0, 'income' => 0]);
    }
}