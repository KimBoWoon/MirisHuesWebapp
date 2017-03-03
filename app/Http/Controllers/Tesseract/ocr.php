<?php

/**
 * Created by PhpStorm.
 * User: secret
 * Date: 2/22/17
 * Time: 12:38 AM
 */

namespace App\Http\Controllers\Tesseract;

use App\Http\Controllers\Cognitive\CognitiveAPI;
use TesseractOCR;

class ocr
{
    public function index()
    {
        $imgUrl = CognitiveAPI::getImageUrl();
        $translateText = (new TesseractOCR($imgUrl))->lang('kor')->run();
        echo json_encode(array('description' => $translateText));
    }
}