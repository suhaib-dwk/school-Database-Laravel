<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**composer install
     * Display a listing of the resource.
     */
    public function index()
    {
        return Student::all();
    }

    public function export()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    public function mark(Request $request)
    {

        $includeValue = $request->query('includeValue');

        $students = Student::whereHas('courses', function ($query) use ($includeValue) {
            $query->where('mark', '>', $includeValue);
        })->get();

        return $students;
    }

    public function add()
    {
        $student = Student::first();

        $course = Course::find(5);

        $student->courses()->attach($course->id);

        return response()->json([
            'status' => 200,
            'message' => 'courses Added Successfully!'
        ]);
    }


    public function addSync()
    {
        $student = Student::first();

        $courseIdsToAdd = [1, 2, 3];

        $student->courses()->sync($courseIdsToAdd);

        return response()->json([
            'status' => 200,
            'message' => 'courses Added Successfully!'
        ]);
    }

    public function count()
    {
        $students = Student::whereHas('courses', function ($query) {
            $query->where('mark', '>', 50);
        })->with('teachers.courses')->get();




        // $courses = Course::whereHas('students', function ($query) {
        //     $query->where('mark', '>', 30) ;
        // })->get();

        // $count = $students->count();
        // $maximum = $students->max();
        // $minimum = $students->min();

        // return ['max'=>$maximum , 'count'=>$count , 'min'=>$minimum];
        return StudentResource::collection($students);
    }

    public function teach()
    {
        $students = Student::whereHas('teachers', function ($query) {
        })->with(['teachers'])->get();
        return $students;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)

    {


        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->ScientificQualification = $request->ScientificQualification;
        $student->gender = $request->gender;



        $data = $student->save();

        if ($data == true) {
            return response()->json([
                'status' => 200,
                'message' => 'Student Added Successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'error' => 'something is wrong'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->name = $request->name;
            $student->email = $request->email;
            $student->ScientificQualification = $request->ScientificQualification;
            $student->gender = $request->gender;
            $student->update();
            return response()->json(['message' => 'Student Update Successfully'], 200);
        } else {
            return response()->json(['message' => 'No student found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        StudentCourse::where('student_id', $student->id)->delete();

        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
