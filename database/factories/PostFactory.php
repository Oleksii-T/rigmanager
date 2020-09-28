<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement( $array = array(1, 2, 3, 4) ),
        'thread' => 1,
        'title' => $faker->realText($maxNbChars = 60, $indexSize = 2),
        'type' => $faker->randomElement( $array = array('1', '2', '3', '4') ),
        'role' => $faker->randomElement( $array = array('1', '2') ),
        'condition' => $faker->randomElement( $array = array(2, 3, 4) ),
        'tag_encoded' => $faker->randomElement( $array = array('1','1.1','1.2','1.3','1.4','1.5','1.6','2','2.1','2.2','2.3','2.4','2.5','2.6','3','3.1','3.2','3.3','3.4','3.5','3.6','4','4.1','4.2','4.3','5','5.1','5.2','6','6.1','6.2','6.3','6.4','6.5','6.6','7','7.1','7.2','7.3','7.4','7.5','7.6','7.7','7.8','7.9','7.10','7.11','8','8.1','8.2','8.3','8.3.1','8.3.2','8.3.3','8.3.4','8.3.5','8.3.6','9','10','10.1','10.2','10.3','11','12','13','14','15','16','17','17.1','18','18.1','18.2','19','19.1','19.2','19.3','19.4','19.5','20','20.1','20.1.1','20.1.2','20.1.3','20.2','20.3','21','22','22.1','22.2','22.3','23','23.1','23.1.1','23.1.2','23.2','23.3','23.4','23.5','23.6','24','25','26','27','27.1','27.2','27.3','27.4','28','29','30','30.1','30.1.1','30.2','30.3','30.4','30.5','30.6','30.7','30.8','30.8.1','30.8.2','30.8.3','31','31.1','31.2','31.3','31.4','31.5','32','33','33.1','33.2','33.2.1','33.2.2','34','34.1','34.2','34.3','34.4','35','35.1','35.2','36','36.1','36.1.1','36.1.2','36.2','36.3','36.4','36.5','36.6','37','37.1','37.2','37.3','37.4','38','38.1','38.2','39') ),
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
