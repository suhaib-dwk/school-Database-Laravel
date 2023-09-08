<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Traits\UploadImageTraits;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use UploadImageTraits;

    public function index(){
        $images = Image::all();

        // foreach($images as $image){
        //     return response()->json([
        //         'id' => $image->id,
        //         "path"=> url('storage/app/'.$image->path)
        //     ]);
        // }

        return view('index', compact('images'));
    }

    public function show(){
        return view('upload');
    }
    public function store(Request $request)
    {
        $path = $this->UploadImage($request ,'users');

        Image::create(
            [
                'path'=>$path
            ]
            );

        return response()->json([
            'message'=>"ok uploadImage",
            "user"=>$path,
        ]);
    }


}