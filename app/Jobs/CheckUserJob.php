<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\StudentCourse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelloMail;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class CheckUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {

    }


    public function handle(): void
    {
        $teachers = Teacher::whereHas('students', function ($query) {
            $query->where('mark', '>=', 10);
        })->with('students')->get();


        $data = [
            'title' => 'test email.',
            'body'=>$teachers
        ];
        Mail::to('sohaibdweekat@gmail.com')->send(new HelloMail($data));
    }
}
