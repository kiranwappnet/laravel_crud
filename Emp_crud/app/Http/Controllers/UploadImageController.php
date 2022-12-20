<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    public function upload(Request $request){
       $image = $request->profile;
       $name = $image->getclientoriginalName();
       $image->storeAs('public/images',$name);
       $image_save = new Image;
       $image_save->name = $name;
       $image_save->save();

       return back();

    }
}
