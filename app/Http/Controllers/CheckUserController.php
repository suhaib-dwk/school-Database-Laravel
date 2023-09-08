<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CheckUserController extends Controller
{

    public function getAdmin(){
        $teachers = User::where('user_type', 'Teacher')->get();
        $students = User::where('user_type', 'Student')->get();
        return response()->json(['teachers' => $teachers , 'students' => $students]);

    }
    public function getTeachers(Request $request) {
        $teachers = User::where('user_type', 'Teacher')->get();
        return response()->json(['teachers' => $teachers]);
    }

    public function getStudents(Request $request) {
        $students = User::where('user_type', 'Student')->get();
        return response()->json(['students' => $students]);
    }
}