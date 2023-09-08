<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'age' => $this->faker->numberBetween(25, 65),
            'department' => $this->faker->jobTitle(),
            'date_of_join' => $this->faker->date(),
            'salary' => $this->faker->randomFloat(2, 3000, 10000),
            'gender' => $this->faker->randomElement(['Female', 'Male']),
        ];
    }
}