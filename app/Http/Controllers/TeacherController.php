<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Jobs\CheckUserJob;
use App\Models\Post;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        // $user = Auth::user();
        // $includeDelete = $request->query('includeDelete', false);

        // $query = $includeDelete ? Teacher::withTrashed() : Teacher::query();

        // $teachers = $query->get();

        // // return TeacherResource::collection($teachers);
        // return $user;

        $teachers = Teacher::all();

        return TeacherResource::collection($teachers);
    }

    public function check()
    {
        CheckUserJob::dispatch();
        return "success";
    }

    public function cache()
    {
        // $value = Teacher::all();

        // Cache::put('teachers', $value, $seconds = 10);

        $value = Cache::remember('posts', 40, function () {
            return Post::all();
        });

        return response()->json($value);
    }

    public function count()
    {
        // $teachers = Teacher::where('age', '>=', 30)
        // ->get();

        // $teachers = Teacher::where('age', '>=', 50)
        //             ->where('salary', '>', 6000)
        //             ->get();

        // $teachers = Teacher::whereBetween('age', [40, 50])
        //             ->get();

        // $teachers = Teacher::where('age', '>=', 30)
        //             ->orWhere('salary', '>', 5000)
        //             ->get();

        // $teachers = Teacher::whereBetween('age', [40, 50])
        //             ->get();

        // $teachers = Teacher::whereHas('courses', function ($query) {
        //     $query->where('start_date', '>', 2000-01-01);
        // })->get();

        // $teachers = Teacher::whereIn('gender',['Male'])
        //             ->get();

        // $startDate = Carbon::createFromDate(1980, 1, 1);

        // $teachersWithCourses = Teacher::whereHas('courses', function ($query) use ($startDate) {
        //     $query->where('start_date', '>', $startDate);
        // })->with('courses')->get();


        // $startDate = Carbon::createFromDate(1960, 1, 1);

        // $teachersWithCourses = Teacher::whereHas('courses', function ($query) use ($startDate) {
        //     $query->where('start_date', '>', $startDate);
        // })->with('courses')->get();

        // $teachers = Teacher::whereColumn('name', 'department')
        //             ->get();




        $teachers = Teacher::whereHas('students', function ($query) {
            $query->where('mark', '>=', 50);
        })->with('students')->get();


        return $teachers;
    }

    public function order()
    {
        $teachers = Teacher::query()
            ->withCount('teacherCourses')
            ->orderByDesc('teacher_courses_count')
            ->get();

        logger("Test");

        return TeacherResource::collection($teachers);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        $teacher = new Teacher();

        $teacher->name = $request->name;
        $teacher->age = $request->age;
        $teacher->department = $request->department;
        $teacher->date_of_join = Carbon::createFromFormat('Y-m-d', $request->date_of_join);
        $teacher->salary = $request->salary;
        $teacher->gender = $request->gender;

        $data = $teacher->save();
        if ($data == true) {
            return response()->json([
                'status' => 200,
                'message' => 'Teacher Added Successfully!'
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
        return Teacher::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, string $id)
    {

        $teacher = Teacher::find($id);
        if ($teacher) {
            $teacher->name = $request->name;
            $teacher->age = $request->age;
            $teacher->department = $request->department;
            $teacher->date_of_join = Carbon::createFromFormat('Y-m-d', $request->date_of_join);
            $teacher->salary = $request->salary;
            $teacher->gender = $request->gender;
            $teacher->update();
            return response()->json(['message' => 'Teacher Update Successfully'], 200);
        } else {
            return response()->json(['message' => 'No Teacher found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return response()->json(['message' => 'Teacher deleted successfully']);
    }
}
