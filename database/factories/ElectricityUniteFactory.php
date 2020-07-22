<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ElectricityUnite;
use Faker\Generator as Faker;

$factory->define(ElectricityUnite::class, function (Faker $faker) {
    return [
        'building_id' => 1,
        'name' => $faker->name,
    ];
});
