<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notification;
use Faker\Generator as Faker;

$factory->define(Notification::class, function (Faker $faker) {
    return [
        "user_id" => random_int(1, 5),
        "read" => $faker->boolean,
        "payload" => $faker->sentence,
    ];
});
