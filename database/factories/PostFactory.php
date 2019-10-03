<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->catchPhrase,
        'body'=>$faker->realText($maxNbChars = 700, $indexSize = 2),
        'cover_image'=>$faker->unique()->image('storage/app/public/cover_images',400,300, 'people', false),
        'user_id'=>random_int(\DB::table('users')->min('id'), \DB::table('users')->max('id'))
    ];
});
