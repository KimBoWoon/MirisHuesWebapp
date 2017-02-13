<?php

/**
 * Created by PhpStorm.
 * User: Null
 * Date: 2017-02-10
 * Time: 오후 4:09
 */

namespace App\Http\Controllers\Cognitive;

use App\Http\Controllers\Controller;

class GetAzureToken
{
    public function index()
    {
        return view('file/upload');
    }

    function getToken($azure_key)
    {
        $url = 'https://api.cognitive.microsoft.com/sts/v1.0/issueToken';
        $ch = curl_init();
        $data_string = json_encode('{body}');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Ocp-Apim-Subscription-Key: ' . $azure_key
            )
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $strResponse = curl_exec($ch);
        curl_close($ch);
        return $strResponse;
    }

    function curlRequest($url, $authHeader)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader, "Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, False);
        $curlResponse = curl_exec($ch);
        curl_close($ch);
        return $curlResponse;
    }

    function translateText($inputText)
    {
        $azure_key = env("AZURE_KEY");  // !!! TODO: secret key here !!!
        $fromLanguage = "en";
        $toLanguage = "ko";

        $accessToken = GetAzureToken::getToken($azure_key);
        $authHeader = "Authorization: Bearer ". $accessToken;
        $params = "text=" . urlencode($inputText) . "&to=" . $toLanguage . "&from=" . $fromLanguage . "&appId=Bearer " . $accessToken;
        $translateUrl = "http://api.microsofttranslator.com/v2/Http.svc/Translate?$params";
        $curlResponse = GetAzureToken::curlRequest($translateUrl, $authHeader);
        $xmlObj = simplexml_load_string($curlResponse);
        foreach ((array)$xmlObj[0] as $val) {
            $translatedStr = $val;
        }
        // Translation output:

        return $translatedStr;
    }
}