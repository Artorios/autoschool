<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(LessonsSettings::class);
         $this->call(AutoSchoolTableSeeder::class);
         $this->call(AutoSchoolGroupSeeder::class);
         $this->call(AutoSchoolStudentSeeder::class);
         $this->call(AutoSchoolCuponSeeder::class);
    }
}
