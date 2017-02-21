<?php

/**
 * Created by PhpStorm.
 * User: secret
 * Date: 2/22/17
 * Time: 12:38 AM
 */

namespace App\Http\Controllers\Tesseract;

use TesseractOCR;

class ocr
{
    public function index()
    {
        echo (new TesseractOCR('/home/secret/Github/Cognitive-API/app/Http/Controllers/Tesseract/text.png'))->lang('kor')->run();
    }
}