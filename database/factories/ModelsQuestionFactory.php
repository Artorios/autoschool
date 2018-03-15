<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Training\Processing\Question::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->text(300),
        'comment' => $faker->text(300),
    ];
});
