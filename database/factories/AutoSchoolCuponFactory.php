<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Finance\Coupon::class, function (Faker $faker) {
    return [
        'investor_id' => '2',
        'auto_school_id' => \App\Models\Training\School\AutoSchool::all()->random()->id,
        'auto_school_group_id' => \App\Models\Training\School\AutoSchoolGroup::all()->random()->id,
        'code' => str_random(10),
        'student_id' => \App\Models\User\User::all()->random()->id,
        'generation_date' => $faker->date(),
        'activated_at' => $faker->date(),
        'sale_date' => $faker->date(),
        'payment_amount' => 12345,
        'fee_amount' => 200,
        'status' => $faker->randomElement(['1', '2', '3'])
    ];
});
