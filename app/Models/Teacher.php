<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory , SoftDeletes;
    protected $hidden=['deleted_at'];

    // public function courses()
    // {
    //     return $this->belongsToMany(Course::class, 'teacher_courses', 'teacher_id', 'course_id')
    //                 ->withPivot('start_date');
    // }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'teacher_id', 'course_id')
                    ->withPivot('mark');
    }

    public function students()
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'teacher_id', 'student_id')
                    ->withPivot('mark');
    }

    public function teacherCourses()
    {
        return $this->hasMany(TeacherCourse::class);
    }

    public function studentCourses()
    {
        return $this->hasManyThrough(StudentCourse::class, TeacherCourse::class);
    }



    protected function Name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }
}