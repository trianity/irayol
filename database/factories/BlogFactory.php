<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => $faker->text($maxNbChars = 500) ,
        'slug' => $faker->slug,
        'titleseo' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'descseo' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'keywordseo' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
