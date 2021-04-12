<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Roadmap;
use App\User;
use Faker\Generator as Faker;

$factory->define(Roadmap::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body' => $faker->text(500),
        'user_id' => function () {
            return factory(User::class);
        },
        'estimated_time' => $faker->numberBetween(0, 300),
        'level' => $faker->numberBetween(1, 3)
    ];
});
