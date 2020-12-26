<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'slug' => $faker->slug,
        'description' => $faker->text($maxNbChars = 500),
        'is_active' => 1,
    ];
});
