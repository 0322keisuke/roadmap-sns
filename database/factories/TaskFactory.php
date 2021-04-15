<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\Tutorial;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'tutorial_id' => function () {
            return factory(Tutorial::class);
        },
        'order' => random_int(1, 100),
        'status' => random_int(1, 3)
    ];
});
