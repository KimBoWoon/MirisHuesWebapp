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

// Index Page
Route::get('/', function () {
    return view('welcome');
});

// Cognitive API
Route::get('/text', 'Cognitive\CognitiveAPI@showText');
Route::get('/tag', 'Cognitive\CognitiveAPI@showTag');
Route::get('/description', 'Cognitive\CognitiveAPI@showDescription');
Route::get('/test', 'Cognitive\GetAzureToken@translateText');

// File
// 업로드 확인을 위한 라우팅
//Route::get('/uploadfile', 'File\FileController@index');
//Route::post('/uploadfile', 'File\FileController@storageFileUpload');

// Image Url 디버깅용
// Route::get('/images', 'File\FileController@getImageUrl');
