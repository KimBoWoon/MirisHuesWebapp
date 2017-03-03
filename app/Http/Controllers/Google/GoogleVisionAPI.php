<?php

/**
 * Created by PhpStorm.
 * User: Null
 * Date: 2017-02-27
 * Time: 오후 1:25
 */

namespace App\Http\Controllers\Google;

use Google\Cloud\Storage\StorageClient;
use Google_Client;
use Google_Service_Storage;
use GuzzleHttp\Client;
use Google\Cloud\Vision\VisionClient;
use Google\Cloud\ServiceBuilder;

class GoogleVisionAPI
{
    public function getText()
    {
        # Your Google Cloud Platform project ID
        $projectId = 'miris-vision';

        # Instantiates a client
        $vision = new VisionClient([
            'projectId' => $projectId,
            'keyFilePath' => __DIR__ . '/miris-vision.json'
        ]);

        # The name of the image file to annotate
        $fileName = __DIR__ . '/image1.jpg';

        # Prepare the image to be annotated
        $image = $vision->image(fopen($fileName, 'r'), [
            'TEXT_DETECTION'
        ]);

        # Performs label detection on the image file
        $texts = $vision->annotate($image)->text();

        echo json_encode(array('description' => $texts[0]->description()));
    }

    public function googleStorage()
    {
        # Your Google Cloud Platform project ID
        $projectId = 'miris-vision';

        # Instantiates a client
        $storage = new StorageClient([
            'projectId' => $projectId
        ]);

        # The name for the new bucket
        $bucketName = 'miris-storage';

        # Creates the new bucket
        $bucket = $storage->createBucket($bucketName);

        echo 'Bucket ' . $bucket->name() . ' created.';
    }
}
