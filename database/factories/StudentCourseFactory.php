<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentCourse>
 */
class StudentCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            'teacher_id' => Teacher::factory(),
            'mark' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}