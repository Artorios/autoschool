<?php

use Illuminate\Database\Seeder;

class AutoSchoolCuponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Finance\Coupon::class, 100)->create();
    }
}
