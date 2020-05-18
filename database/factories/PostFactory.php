<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        "user_id" => random_int(1, 6),
        "text" => $faker->text,
        "post_type" => 1,
        "status" => 1,
        "post_visibility" =>  random_int(0, 2),
        "media_uuid" => $faker->uuid,
    ];
});
