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

class GoogleVisionAPI
{
    public function getText()
    {
        $client = new Google_Client();
        $client->setAuthConfig(__DIR__ . '/miris-vision.json');
        $client->setAccessType("offline");
        $client->authorize(new Client(['verify' => false]));
        $client->addScope(Google_Service_Storage::DEVSTORAGE_READ_WRITE);
        $client->setApplicationName("miris");
        $client->setDeveloperKey(env('GOOGLE_CLIENT_KEY'));

        $storageService = new Google_Service_Storage($client);
        $buckets = $storageService->buckets;

        echo $buckets->get('miris-vision')->getAcl();
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
