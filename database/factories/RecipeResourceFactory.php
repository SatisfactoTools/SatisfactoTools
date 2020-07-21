<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RecipeResource;
use Faker\Generator as Faker;

$factory->define(RecipeResource::class, function (Faker $faker) {
    return [
        "recipe_id" => 1,
        "resource_id" => 1,
        "quantity" => $faker->randomFloat(2, 200, 1)
    ];
});
