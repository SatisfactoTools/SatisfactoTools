<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BuildingRecipe;
use Faker\Generator as Faker;

$factory->define(BuildingRecipe::class, function (Faker $faker) {
    return [
        'recipe_id' => 1,
        'building_id' => 1,
    ];
});
