<?php
// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
require_once 'HTTP/Request2.php';

$request = new Http_Request2('https://api.projectoxford.ai/emotion/v1.0/recognize');
$url = $request->getUrl();

$headers = array(
    // Request headers
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => 'b9d5f8ef58c240eb8e9177c49b51fdd4',
);

$request->setHeader($headers);

$parameters = array(// Request parameters
);

$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);

// Request body
//$urlData = "http://cfile21.uf.tistory.com/image/226B71385742AA7B20B62A";
$urlData = array ('url'=>"http://cfile21.uf.tistory.com/image/226B71385742AA7B20B62A");
$urlDataJsonEncode = json_encode($urlData);
//$urlDataJsonEncode = '{"url": ' . $urlData . '}';

$request->setBody($urlDataJsonEncode);

try {
    $response = $request->send();
    echo $response->getBody();
} catch (HttpException $ex) {
    echo $ex;
}

?>