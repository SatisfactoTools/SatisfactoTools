<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductionBloc;
use Faker\Generator as Faker;

$factory->define(ProductionBloc::class, function (Faker $faker) {
    return [
        'game_id' => factory(App\Models\Game::class)->create()->id,
        'name' => $faker->name,
        'parent_id' => null,
    ];
});
