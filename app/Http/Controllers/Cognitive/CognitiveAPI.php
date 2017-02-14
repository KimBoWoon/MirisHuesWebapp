<?php
/**
 * Created by PhpStorm.
 * User: secret
 * Date: 1/22/17
 * Time: 4:05 PM
 */

namespace App\Http\Controllers\Cognitive;

use App\Http\Controllers\Controller;
use MicrosoftAzure\Storage\Common\ServiceException;
use MicrosoftAzure\Storage\Common\ServicesBuilder;

require_once 'HTTP/Request2.php';

class CognitiveAPI extends Controller
{
    public function showText()
    {
        $request = new \Http_Request2('https://api.projectoxford.ai/vision/v1.0/ocr');
        $url = $request->getUrl();
        $headers = array(
            // Request headers
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => env('COGNITIVE_VISION_KEY'),
        );
        $request->setHeader($headers);
        $parameters = array(
            // Request parameters
            'language' => 'en',
            'detectOrientation ' => 'true',
        );
        $url->setQueryVariables($parameters);
        $request->setMethod(\HTTP_Request2::METHOD_POST);
        // Request body
        $urlString = CognitiveAPI::getImageUrl();
        $urlData = array('url' => $urlString);
        $urlDataJsonEncode = json_encode($urlData);
        $request->setBody($urlDataJsonEncode);
        try {
            $response = $request->send();
            echo $response->getBody();
        } catch (HttpException $ex) {
            echo $ex;
        }
    }

    public function showTag()
    {
        $request = new \Http_Request2('https://api.projectoxford.ai/vision/v1.0/tag');
        $url = $request->getUrl();
        $headers = array(
            // Request headers
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => env('COGNITIVE_VISION_KEY'),
        );
        $request->setHeader($headers);
        $parameters = array(// Request parameters
        );
        $url->setQueryVariables($parameters);
        $request->setMethod(\HTTP_Request2::METHOD_POST);
        // Request body
        $urlString = CognitiveAPI::getImageUrl();
        $urlData = array('url' => $urlString);
        $urlDataJsonEncode = json_encode($urlData);
        $request->setBody($urlDataJsonEncode);
        try {
            $response = $request->send();
            echo $response->getBody();
        } catch (HttpException $ex) {
            echo $ex;
        }
    }

    public function showDescription()
    {
        $translate = new GetAzureToken();
        $request = new \Http_Request2('https://westus.api.cognitive.microsoft.com/vision/v1.0/analyze');
        $url = $request->getUrl();

        $headers = array(
            // Request headers
            'Content-Type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => env('COGNITIVE_VISION_KEY'),
        );

        $request->setHeader($headers);

        $parameters = array(
            // Request parameters
            'visualFeatures' => 'Description',
            'language' => 'en',
        );

        $url->setQueryVariables($parameters);

        $request->setMethod(\HTTP_Request2::METHOD_POST);

        // Request body
        $urlString = CognitiveAPI::getImageUrl();
        $urlData = array('url' => $urlString);
        $urlDataJsonEncode = json_encode($urlData);
        $request->setBody($urlDataJsonEncode);

        try {
            $response = $request->send();
//            echo $response . '<br>';
            $inputText = json_decode(utf8_encode($response->getBody()), TRUE);
            $str = $translate->translateText($inputText['description']['captions'][0]['text']);
            echo $inputText['description']['captions'][0]['text'] . '<br>';
            echo json_encode(array('description' => array('text' => $str)));
        } catch (HttpException $ex) {
            echo $ex;
        }
    }

    function getImageUrl()
    {
        $connectionString = 'DefaultEndpointsProtocol=https;AccountName=' . env('ACCOUNT_NAME') . ';AccountKey=' . env('ACCOUNT_KEY');

        // Create blob REST proxy.
        $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

        try {
            // List blobs.
            $blob_list = $blobRestProxy->listBlobs('images');
            $blobs = $blob_list->getBlobs();
            ksort($blobs);
            return $blobs[count($blobs) - 2]->getUrl();
        } catch (ServiceException $e) {
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/library/azure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code . ": " . $error_message . "<br />";
        }
    }
}
