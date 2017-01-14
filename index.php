<?php
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'HTTP/Request2.php';

$urlData = array('url' => "https://c2.staticflickr.com/6/5283/5685590377_23207b673d_b.jpg");
$urlDataJsonEncode = json_encode($urlData);

getImageTag($urlDataJsonEncode);
//getImageText($urlDataJsonEncode);

function getImageText($urlDataJsonEncode)
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
    $request->setBody($urlDataJsonEncode);

    try {
        $response = $request->send();
        echo $response->getBody();
    } catch (HttpException $ex) {
        echo $ex;
    }
}

function getImageTag($urlDataJsonEncode)
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
    $request->setBody($urlDataJsonEncode);

    try {
        $response = $request->send();
        echo $response->getBody();
    } catch (HttpException $ex) {
        echo $ex;
    }
}

?>