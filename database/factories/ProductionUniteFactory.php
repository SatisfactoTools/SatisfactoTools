<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductionUnite;
use Faker\Generator as Faker;

$factory->define(ProductionUnite::class, function (Faker $faker) {
    return [
        'recipe_id' => 1,
        'production_bloc_id' => factory(App\Models\ProductionBloc::class)->create()->id,
        'building_id' => 1,
        'name' => $faker->name,
    ];
});
