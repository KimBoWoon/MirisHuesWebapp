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

use Intervention\Image\Facades\Image;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', 'Cognitive\CognitiveAPI@index');
Route::get('/text', 'Cognitive\CognitiveAPI@showText');
Route::get('/tag', 'Cognitive\CognitiveAPI@showTag');

Route::get('/uploadfile', 'File\FileController@index');
Route::post('/uploadfile', 'File\FileController@showUploadFile');

//Route::get('/images/{filename}', function ($filename) {
//    return Image::make(storage_path() . '/images/' . $filename)->response();
//});

Route::get('/images', 'File\FileController@getImageUrl');