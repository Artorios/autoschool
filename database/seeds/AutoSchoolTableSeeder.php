<?php

use Illuminate\Database\Seeder;

class AutoSchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Training\School\AutoSchool::class, 5)->create();
    }
}
