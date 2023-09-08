<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    public function index()
        {
            $data = [
                'title' => 'test email.',
                'body'=>'Hello, this is for testing email using smtp'
            ];

            // $recipientEmail = 'sohaibdweekat@gmail.com';

            Mail::to('sohaibdweekat@gmail.com')->send(new HelloMail($data));

            return response()->json(['message' => 'Email sent successfully']);
            // dd('Email is Success');
        }


}
