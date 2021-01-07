<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'content' => $this->faker->text($maxNbChars = 500),
            'slug' => $this->faker->slug,
            'titleseo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'descseo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'keywordseo' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
