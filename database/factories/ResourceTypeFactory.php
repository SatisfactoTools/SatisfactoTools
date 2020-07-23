<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ResourceType;
use Faker\Generator as Faker;

$factory->define(ResourceType::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "unity" => "/min"
    ];
});
