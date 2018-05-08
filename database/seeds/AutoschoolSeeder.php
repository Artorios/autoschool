<?php

use Illuminate\Database\Seeder;
use App\Models\Training\School\{AutoSchoolGroup, AutoSchoolFilial, AutoSchool};
use Illuminate\Support\Facades\Auth;
use App\Models\User\User;

class AutoschoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(empty(AutoSchool::find(100))){
            $school = [
                'id' => 100,
                'title' => 'GoodSchool',
                'description' => 'Best of the best school',
                'city_id' => 565
            ];

            AutoSchool::create($school);
        }

        $filial = [
            'name' => 'Filial',
            'address' => 'Бахарева 23',
            'auto_school_id' => 100
        ];

        AutoSchoolFilial::create($filial);

        $filial_id = AutoSchoolFilial::orderBy('id', 'desc')->first()->id;
        if(empty(AutoSchoolGroup::find(100))){
            $group = [
                'id' => 100,
                'name' => 'Group',
                'exam_date' => '2018-06-24',
                'exam_time' => '10:00',
                'auto_school_filial_id' => $filial_id
            ];
            AutoSchoolGroup::create($group);
        }
        else{

            $group = [
                'name' => 'Group',
                'exam_date' => '2018-06-24',
                'exam_time' => '10:00',
                'auto_school_filial_id' => $filial_id
            ];
            AutoSchoolGroup::create($group);
        }
        $group_id = AutoSchoolGroup::orderBy('id', 'desc')->first()->id;

        $admin_data = [
            'name' => 'user123',
            'email' => 'user123@gmail.com',
            'password' => 'adminadmin',
            'role' => 'user',
            'last_name' => 'Adminskiy',
            'phone' => '0777777777',
            'activated' => 1,
            'auto_school_group_id' => $group_id,
            'image' => 'gfdsg'
        ];

        $user = User::create($admin_data);

    }
}
