<?php

namespace App\Http\Resources;

use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $salary = $this->salary;

        // if ($salary > 5000) {
        //     $salary = null;
        // }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'date_of_join' => $this->date_of_join,
            'salary' => $this->when($this->salary >= 2000, $this->salary),
            'department'=> $this->department,
            'gender'=>$this->gender,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // 'shekel_to_usd' => $this->salary / 3.30,
            // 'teacher_courses_count' => $this->when($this->teacher_courses_count != null, $this->teacher_courses_count),
            // 'course_name' =>  $this->when($this->getCoursesWithMarks()->isNotEmpty(), $this->getCoursesWithMarks()),
            // 'students' => $this->when($this->students->isNotEmpty(), $this->getStudentDetails()),
        ];

    }
    // protected function getCoursesWithMarks()
    // {
    //     return $this->courses->map(function ($course) {
    //         return $course->title;
    //     });
    // }



    // protected function getStudentDetails()
    // {
    //     return $this->students->map(function ($student) {
    //         return [
    //             'name' => $student->name,
    //             'mark' => $student->pivot->mark,
    //         ];
    //     });
    // }

}
