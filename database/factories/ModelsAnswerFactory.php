<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Training\Processing\Answer::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'correct' => $faker->randomElement([1,0])
    ];
});
