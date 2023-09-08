<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    use HasFactory;

    public function teachers()
{
    return $this->belongsTo(Teacher::class);
}

public function courses()
{
    return $this->belongsTo(Course::class);
}
}
