<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Building;
use Faker\Generator as Faker;

$factory->define(Building::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        "img" => $faker->imageUrl(640, 480),
        "electricity" => $faker->randomFloat(2, 200, 1)

    ];
});
