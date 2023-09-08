<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory , SoftDeletes;

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id')->with('teachers')
                    ->withPivot('mark');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'student_courses', 'student_id', 'teacher_id')
                    ->withPivot('mark');
    }

//     public function coursesWithGoodMarks()
// {
//     return $this->belongsToMany(Course::class, 'student_courses')
//                 ->wherePivot('mark', '>', 50)
//                 ->with('teachers')
//                 ->withPivot('mark');
// }

}