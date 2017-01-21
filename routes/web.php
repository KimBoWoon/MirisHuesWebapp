<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', 'Cognitive\CognitiveAPI@index');
Route::get('/text', 'Cognitive\CognitiveAPI@showText');
Route::get('/tag', 'Cognitive\CognitiveAPI@showTag');

Route::get('/uploadfile', 'File\UploadFileController@index');
Route::post('/uploadfile', 'File\UploadFileController@showUploadFile');

Route::get('images/{filename}', function ($filename) {
    $path = storage_path() . '\public\\' . $filename;

    echo $path;
    echo '<br>';
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});