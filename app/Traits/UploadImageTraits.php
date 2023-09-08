<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadImageTraits
{
    public function UploadImage(Request $request,$folderName){
        $image = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs($folderName,$image,'public');
        return $path;
    }
}
