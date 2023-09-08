<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\Post;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\Teacher;
use App\Models\TeacherCourse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Teacher::factory()->count(10)->create();
        Student::factory()->count(10)->create();
        Course::factory()->count(10)->create();
        StudentCourse::factory()->count(10)->create();
        TeacherCourse::factory()->count(10)->create();
        // Post::factory()->count(10000)->create();
    }
}
