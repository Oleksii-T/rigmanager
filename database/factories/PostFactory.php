<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement( $array = array(1, 2, 3) ),
        'title' => $faker->realText($maxNbChars = 60, $indexSize = 2),
        'type' => $faker->randomElement( $array = array('1', '2', '3') ),
        'role' => $faker->randomElement( $array = array('1', '2') ),
        'condition' => $faker->randomElement( $array = array(2, 3, 4) ),
        'tag_encoded' => $faker->randomElement( $array = array('2','2.0','2.1','2.1.1','2.1.1.1','2.1.1.2','2.1.1.3','2.1.1.4','2.1.1.5','2.1.2','2.1.2.1','2.1.2.2','2.1.2.2.1','2.1.2.2.2','2.1.2.3','2.1.2.4','2.1.2.5','2.1.2.6','2.1.2.6.1','2.1.2.6.1.1','2.1.2.6.1.2','2.1.2.6.1.3','2.1.2.7','2.1.2.7.1','2.1.2.7.2','2.2','2.2.1','2.2.1.1','2.2.1.1.1','2.2.1.1.2','2.2.1.1.3','2.2.1.1.4','2.2.1.2','2.2.1.3','2.2.1.4','2.2.1.5','2.2.1.5.1','2.2.1.5.2','2.2.1.5.3','2.2.1.6','2.2.2','2.3','2.3.1','2.3.1.1','2.3.1.2','2.3.1.3','2.3.1.4','2.3.1.5','2.3.2','2.3.2.1','2.3.2.2','2.3.2.3','2.3.2.4','2.3.2.5','2.4','2.4.1','2.4.2','2.4.2.1','2.4.2.2','2.4.2.3','2.4.3','2.4.4','2.4.5','2.5','2.5.1','2.5.1.1','2.5.1.2','2.5.1.3','2.5.1.3.1','2.5.1.3.2','2.5.1.3.3','2.5.1.3.4','2.5.1.3.5','2.5.2','2.5.3','2.5.4','2.7','2.7.1','2.7.2','2.7.3','2.7.4','2.7.5','2.7.6','2.7.7','2.8','2.8.1','2.8.2','2.8.3','2.8.4','2.9','2.9.1','2.9.2','2.9.3','2.9.4','2.9.5','2.9.6','2.10','2.10.1','2.10.1.1','2.10.1.2','2.10.1.3','2.10.1.4','2.10.1.5','2.10.2','2.10.3','2.10.4','2.10.5','2.10.6','2.11','2.11.1','2.11.2','2.11.3','2.11.4','2.12','2.12.1','2.12.2','2.12.2.1','2.12.2.2','2.12.2.3','2.12.2.4','2.12.2.5','2.12.2.6','2.12.3','2.13','2.13.1','2.13.2','2.13.3','2.13.4','2.14') ),
        'description' => $faker->realText($maxNbChars = 1000, $indexSize = 2),
        'cost' => $faker->numberBetween($min = 1000, $max = 1000000),
        'currency' => $faker->randomElement( $array = array('UAH', 'USD') ),
        'region_encoded' => $faker->randomElement( $array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25) ),
        'town' => $faker->city,
        'user_email' => $faker->email,
        'user_phone_raw' => $faker->numerify('##########'),
        'viber' => $faker->randomElement( $array = array(1, 0) ),
        'telegram' => $faker->randomElement( $array = array(1, 0) ),
        'whatsapp' => $faker->randomElement( $array = array(1, 0) ),
        'created_at' => $faker->dateTime($max = 'now', $timezone = 'EEST'),
        'updated_at' => $faker->dateTime($max = 'now', $timezone = 'EEST')
    ];
});
