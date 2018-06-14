<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Training\School\AutoSchoolGroup::class, function(Faker $faker) {
    return [
        'name' => $faker->name(),
        'auto_school_id' => \App\Models\Training\School\AutoSchool::all()->random()->id,
        'exam_date' => $faker->date(),
        'exam_time' => $faker->time(),
        'id_number' => 1,
    ];
});
