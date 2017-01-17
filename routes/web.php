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

Route::get('/c', function () {
    echo 'Hello, World!';
});

Route::get('/uploadfile', 'UploadFileController@index');
Route::post('/uploadfile', 'UploadFileController@showUploadFile');