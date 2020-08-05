<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Log;
use Faker\Generator as Faker;

$factory->define(Log::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'table' => $faker->name,
        'action' => $faker->name,
    ];
});
