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

// Notification
Route::get('/noti', 'Notification\Send@send');

// OCR
Route::get('/ocr', 'Cognitive\CognitiveAPI@getOCRText');
Route::get('/storage', 'Google\GoogleVisionAPI@googleStorage');