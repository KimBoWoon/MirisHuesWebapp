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
use Google_Service_Drive;
use Google_Service_Storage;
use GuzzleHttp\Client;

class GoogleVisionAPI
{
    public function getText()
    {
        $client = new Google_Client();
        $client->setAuthConfig(__DIR__ . '/miris_client_secret.json');
        $client->setAccessType("offline");        // offline access
        $client->setIncludeGrantedScopes(true);   // incremental auth
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
        $client->setHttpClient(new Client(['verify' => false]));
        $client->setApplicationName("miris");
        $client->setDeveloperKey(env('GOOGLE_CLIENT_KEY'));
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));

        $storageService = new Google_Service_Storage($client);
        $buckets = $storageService->buckets;

        echo var_dump($buckets->listBuckets('miris-vision'));
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
