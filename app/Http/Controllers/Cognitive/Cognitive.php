<?php
/**
 * Created by PhpStorm.
 * User: Null
 * Date: 2017-01-17
 * Time: 오후 7:18
 */

namespace App\Http\Controllers;

require_once 'HTTP/Request2.php';

class CognitiveAPI extends Controller
{
    public function index()
    {
        return view('/file/cognitive');
    }

    public function showText(Request $request)
    {
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
    }

    public function showTag(Request $request)
    {
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
    }
}