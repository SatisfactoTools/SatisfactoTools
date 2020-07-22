<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductionUnite;
use Faker\Generator as Faker;

$factory->define(ProductionUnite::class, function (Faker $faker) {
    return [
        'recipe_id' => 1,
        'production_bloc_id' => 1,
        'building_id' => 1,
        'name' => $faker->name,
    ];
});
