<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    public function index()
    {
        return view('file/upload');
    }

    public function showUploadFile(Request $request)
    {
        $file = $request->file('image');

        //Display File Name
        echo 'File Name: ' . $file->getClientOriginalName();
        echo '<br>';

        //Display File Extension
        echo 'File Extension: ' . $file->getClientOriginalExtension();
        echo '<br>';

        //Display File Real Path
        echo 'File Real Path: ' . $file->getRealPath();
        echo '<br>';

        //Display File Size
        echo 'File Size: ' . $file->getSize();
        echo '<br>';

        //Display File Mime Type
        echo 'File Mime Type: ' . $file->getMimeType();

        //Move Uploaded File
        Storage::disk('local')->put('public/' . $file->getClientOriginalName(), "");
        echo '<br>';

        echo Storage::url('image.jpg');
        echo '<br>';
    }
}
