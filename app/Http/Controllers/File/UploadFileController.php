<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class UploadFileController extends Controller
{
    public function index()
    {
        return view('file/upload');
    }

    public function showUploadFile(Request $request)
    {
        $file = $request->file('photo');
//
//        //Display File Name
//        echo 'File Name: ' . $file->getClientOriginalName();
//        echo '<br>';
//
//        //Display File Extension
//        echo 'File Extension: ' . $file->getClientOriginalExtension();
//        echo '<br>';
//
//        //Display File Real Path
//        echo 'File Real Path: ' . $file->getRealPath();
//        echo '<br>';
//
//        //Display File Size
//        echo 'File Size: ' . $file->getSize();
//        echo '<br>';
//
//        //Display File Mime Type
//        echo 'File Mime Type: ' . $file->getMimeType();
//        echo '<br>';
//
//        $img = Image::make(Input::file('photo'));
//        $img->save(public_path() . '/images/' . $file->getClientOriginalName());

        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = public_path('images/' . $filename);
        Image::make($file->getRealPath())->resize(468, 249)->save($path);
    }
}
