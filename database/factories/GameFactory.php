<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'name' => $faker->name,
    ];
});
