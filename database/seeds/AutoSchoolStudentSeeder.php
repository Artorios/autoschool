<?php

use Illuminate\Database\Seeder;

class AutoSchoolStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User\User::class, 5)->create();
    }
}
