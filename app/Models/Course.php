<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_courses', 'course_id', 'teacher_id')
                    ->withPivot('mark');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses', 'course_id', 'student_id')
                    ->withPivot('mark');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses', 'course_id', 'user_id');
    }


}