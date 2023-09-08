<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CheckUserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ThirdPartyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
], function ($routes) {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/refresh-token', [UserController::class, 'refresh']);
});


Route::get('/teachers', [TeacherController::class, 'index']);
Route::get('/teachers/get/{id}', [TeacherController::class, 'show']);
Route::post('/teachers/add', [TeacherController::class, 'store']);
Route::put('/teachers/{id}/update', [TeacherController::class, 'update']);
Route::delete('/teachers/{id}/delete', [TeacherController::class, 'destroy']);

Route::get('/teachers/count', [TeacherController::class, 'count']);
Route::get('/teachers/order', [TeacherController::class, 'order']);

Route::get('/student', [StudentController::class, 'index']);
Route::get('/student/get/{id}', [StudentController::class, 'show']);
Route::post('/student/add', [StudentController::class, 'store']);
Route::put('/student/{id}/update', [StudentController::class, 'update']);
Route::delete('/student/{id}/delete', [StudentController::class, 'destroy']);

Route::get('/student/mark', [StudentController::class, 'mark']);
Route::get('/student/count', [StudentController::class, 'count']);
Route::get('/student/teach', [StudentController::class, 'teach']);

Route::post('/course/add', [StudentController::class, 'add']);

Route::get('/sendEmail', [EmailController::class, 'index']);


Route::group(['middleware' => ['check_user']], function () {
    Route::get('/get-admin', [CheckUserController::class, 'getAdmin']);
    Route::get('/get-teachers', [CheckUserController::class, 'getTeachers']);
    Route::get('/get-students', [CheckUserController::class, 'getStudents']);
});


Route::get('/cache', [TeacherController::class, 'cache']);

Route::get('/check', [TeacherController::class, 'check']);

Route::get('/thirdParty', [ThirdPartyController::class, 'index']);

Route::get('/export', [StudentController::class, 'export']);
