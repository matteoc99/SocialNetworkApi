<?php

/** @var Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(User::class, function (Faker $faker) {
    return [
        "name"=>$faker->name,
        'email' => $faker->unique()->safeEmail,
        "password"=>bcrypt("1234"),
        "profile_image"=>null,
        "role_id"=>1,
        "post_visibility"=>1,
        "show_location"=>1,
        "online"=>0,
        "lat"=>$faker->latitude,
        "lng"=>$faker->longitude,
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
        ];
});
