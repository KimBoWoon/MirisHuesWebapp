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

require_once 'HTTP/Request2.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/a', function () {
    $request = new Http_Request2('https://api.projectoxford.ai/vision/v1.0/ocr');
    $url = $request->getUrl();
    $headers = array(
        // Request headers
        'Content-Type' => 'application/json',
        'Ocp-Apim-Subscription-Key' => '8fcd03e7f72d4ef4b9cbd4bf4bedb0f9',
    );
    $request->setHeader($headers);
    $parameters = array(
        // Request parameters
        'language' => 'en',
        'detectOrientation ' => 'true',
    );
    $url->setQueryVariables($parameters);
    $request->setMethod(HTTP_Request2::METHOD_POST);
    // Request body
    $urlData = array('url' => "https://c2.staticflickr.com/6/5283/5685590377_23207b673d_b.jpg");
    $urlDataJsonEncode = json_encode($urlData);
    $request->setBody($urlDataJsonEncode);
    try {
        $response = $request->send();
        echo $response->getBody();
    } catch (HttpException $ex) {
        echo $ex;
    }
});

Route::get('/b', function () {
    $request = new Http_Request2('https://api.projectoxford.ai/vision/v1.0/tag');
    $url = $request->getUrl();
    $headers = array(
        // Request headers
        'Content-Type' => 'application/json',
        'Ocp-Apim-Subscription-Key' => '8fcd03e7f72d4ef4b9cbd4bf4bedb0f9',
    );
    $request->setHeader($headers);
    $parameters = array(// Request parameters
    );
    $url->setQueryVariables($parameters);
    $request->setMethod(HTTP_Request2::METHOD_POST);
    // Request body
    $urlData = array('url' => "https://c2.staticflickr.com/6/5283/5685590377_23207b673d_b.jpg");
    $urlDataJsonEncode = json_encode($urlData);
    $request->setBody($urlDataJsonEncode);
    try {
        $response = $request->send();
        echo $response->getBody();
    } catch (HttpException $ex) {
        echo $ex;
    }
});

Route::get('/c', function () {
    echo 'Hello, World!';
});

Route::get('/uploadfile', 'UploadFileController@index');
Route::post('/uploadfile', 'UploadFileController@showUploadFile');