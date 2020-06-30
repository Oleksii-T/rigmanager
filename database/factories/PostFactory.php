<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => 3,
        'title' => $faker->realText($maxNbChars = 60, $indexSize = 2),
        'condition' => 'Новое',
        'tag' => 'Другое',
        'description' => $faker->realText($maxNbChars = 1000, $indexSize = 2),
        'cost' => $faker->numberBetween($min = 1000, $max = 100000),
        'location' => $faker->city,
        'user_email' => $faker->email,
        'user_phone' => $faker->e164PhoneNumber
    ];
});
