<?php
namespace Modules\Courses\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Courses\Entities\Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'instructor_id' => 1,
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'slug' => $this->faker->slug,
            'description' => $this->faker->text($maxNbChars = 500),
            'level' => $this->faker->randomElement(['basic, intermediate, advance']),
            'keywords' => $this->faker->text($maxNbChars = 10),
            'includes' => $this->faker->text($maxNbChars = 10),
            'visibility' => $this->faker->randomElement(['published, draft, pending_review']),
            'access' => $this->faker->randomElement(['free, pay']),
        ];
    }
}

