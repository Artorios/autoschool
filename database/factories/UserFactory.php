<?php

use Faker\Generator as Faker;
use App\Models\User\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    return [
        'activated' => 1,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'last_name' => $faker->name,
        'second_name' => $faker->name,
        'phone' => str_random(20),
        'sms_notice' => 1,
        'email_notice' => 1,
        'remember_token' => str_random(10),
        'auto_school_group_id' => \App\Models\Training\School\AutoSchoolGroup::all()->random()->id,
        'license' => str_random(20),
        'confirmation_code' => str_random(20),
        'city_id' => $faker->randomElement(['158', '565', '15598']),
    ];
});
