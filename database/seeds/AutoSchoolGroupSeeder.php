<?php

use Illuminate\Database\Seeder;

class AutoSchoolGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Training\School\AutoSchoolGroup::class, 5)->create();
    }
}
