<?php
use Faker\Generator as Faker;

$factory->define(\App\Models\Training\School\AutoSchool::class, function(Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->text(10),
        'city_id' => $faker->randomElement(['158', '565', '15598']),
        'investor_id' => '2',
        'director_id' => '3',
        'filial_name' => $faker->name()
    ];
});
