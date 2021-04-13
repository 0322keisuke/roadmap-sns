<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tutorial;
use App\User;
use Faker\Generator as Faker;

$factory->define(Tutorial::class, function (Faker $faker) {
    return [
        'title' => $faker->text(30),
        'user_id' => function () {
            return factory(User::class);
        },
        'order' => random_int(1, 10),
        'status' => random_int(1, 3)
    ];
});
