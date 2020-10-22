<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement( $array = array(1, 2, 3, 4) ),
        'thread' => 1,
        'origin_lang' => 'en',
        'user_translations' => '{"title":[],"description":[]}',
        'title' => $faker->realText($maxNbChars = 60, $indexSize = 2),
        'type' => $faker->randomElement( $array = array('1', '2', '3', '4') ),
        'role' => $faker->randomElement( $array = array('1', '2') ),
        'condition' => $faker->randomElement( $array = array(2, 3, 4) ),
        'tag_encoded' => $faker->randomElement( $array = array('0','1','1.1','1.2','1.3','1.4','1.5','1.6','1.7','1.8','1.9','1.10','2','2.1','2.2','2.3','2.4','2.5','2.5.1','2.6','2.7','2.8','2.9','2.10','2.10.1','2.10.2','2.11','2.12','2.13','3','3.1','3.2','3.3','3.4','3.5','3.6','3.7','3.8','3.9','3.10','4','4.1','4.1.1','4.1.2','4.1.3','4.1.4','4.2','4.2.1','4.2.2','4.2.3','4.2.4','4.2.5','4.2.6','4.2.7','4.2.8','4.2.9','4.2.10','4.3','4.4','4.5','4.6','4.7','4.7.1','4.7.2','4.7.3','4.7.4','5','5.1','5.2','5.3','5.4','5.5','5.6','5.7','5.7.1','5.7.2','5.7.3','5.7.4','5.8','5.8.1','5.8.2','5.8.3','5.9','5.9.1','5.10','5.11','5.12','6','6.1','6.1.1','6.1.2','6.1.3','6.1.4','6.1.5','6.2','6.2.1','6.2.2','6.2.3','6.2.4','6.2.5','6.2.6','6.2.7','6.2.8','6.2.9','6.2.10','6.2.11','6.2.12','6.2.13','6.2.14','6.2.15','7','7.1','7.1.1','7.1.2','7.2','7.3','7.4','7.5','7.6','7.6.1','7.6.1','8','8.1','8.2','8.3','8.4','8.5','9','10','10.1','10.2','10.3','10.4','10.5','10.6','11','11.1','11.2','11.3','11.4','11.5','11.6','12','12.1','12.2','12.3','12.4','12.5','12.6','13','13.1','13.2','13.3','13.3.1','13.3.2','13.3.3','13.3.4','13.4','13.5','13.6','13.7','13.7.1','13.7.2','13.7.3','13.7.4','13.7.5','13.7.6','13.7.7','13.7.8','14','14.1','14.2','14.3','14.3.1','14.3.2','14.3.3','14.4','14.5','14.6','15','15.1','15.2','15.3','15.4','15.5','16','16.1','16.2','16.3','16.4','16.5','17','17.1','17.2','18','18.1','18.2','18.3','18.4','18.5','19','19.1','19.2','19.3','19.4','20','20.1','20.1.1','20.1.2','20.1.3','20.2','20.3','20.4','20.4.1','20.4.2','20.5','20.5.1','20.5.2','20.6','20.6.1','20.6.2','20.6.3','20.7','20.7.1','20.7.2','20.7.3','20.7.4','20.8','20.8.1','20.8.2','20.8.3','20.8.4','21','21.1','21.2','21.3','21.3.1','21.3.2','21.3.3','21.3.4','21.3.5','21.3.6','21.3.7','21.3.8','21.3.9','21.3.10','21.3.11','21.3.12','21.3.13','21.3.14','21.4','21.5','21.6','21.7','21.8','22','22.1','22.2','22.3','22.4','23','23.1','23.2','23.2.1','23.2.2','24','24.1','24.2','24.3','24.4','24.5','25','25.1','25.2','25.3','25.4','26','26.1','26.2','26.3','26.3.1','26.3.2','26.3.3','26.3.4','26.3.5','26.3.6','26.4','26.5','26.6','26.7','27','27.1','27.2','27.3','27.4','27.5','27.5.1','27.5.2','28','28.1','28.2','28.3','28.4','28.5','28.6','29','29.1','29.2','29.2.1','29.3','29.4','29.5','29.6','29.7','29.8','29.9','30','30.1','30.2','31','31.1','31.2','31.3','31.4','31.5','31.6','32','32.1','32.2','32.3','32.4','32.5','32.6','33','33.1','33.2') ),
        'description' => $faker->realText($maxNbChars = 1000, $indexSize = 2),
        'cost' => $faker->numberBetween($min = 1000, $max = 1000000),
        'currency' => $faker->randomElement( $array = array('UAH', 'USD') ),
        'region_encoded' => $faker->randomElement( $array = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25) ),
        'town' => $faker->city,
        'user_email' => $faker->email,
        'user_phone_raw' => $faker->numerify('0#########'),
        'viber' => $faker->randomElement( $array = array(1, 0) ),
        'telegram' => $faker->randomElement( $array = array(1, 0) ),
        'whatsapp' => $faker->randomElement( $array = array(1, 0) ),
        'created_at' => $faker->dateTime($max = 'now', $timezone = 'EEST'),
        'updated_at' => $faker->dateTime($max = 'now', $timezone = 'EEST')
    ];
});
