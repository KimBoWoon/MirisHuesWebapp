<?php

/**
 * Created by PhpStorm.
 * User: Null
 * Date: 2017-02-27
 * Time: 오후 1:25
 */

namespace App\Http\Controllers\Google;

use Google\Cloud\Vision\VisionClient;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\ServiceBuilder;
use Google_Client;
use Google_Service_Books;

class GoogleVisionAPI
{
    public function getText()
    {
        $projectId = 'miris-vision';
        $bucketName = 'miris-storage';
        $objectName = 'image1.jpg';

        $builder = new ServiceBuilder([
            'projectId' => $projectId,
        ]);
        $vision = $builder->vision();
        $storage = $builder->storage();

        // fetch the storage object and annotate the image
        $object = $storage->bucket($bucketName)->object($objectName);
        $image = $vision->image($object, ['TEXT_DETECTION']);
        $result = $vision->annotate($image);

        // print the response
        print("Texts:\n");
        foreach ((array)$result->text() as $text) {
            print($text->description() . PHP_EOL);
        }
//        $projectId = 'miris-vision';
//        $bucketName = 'miris-storage';
//        $objectName = 'image1.jpg';
//
//        $builder = new ServiceBuilder([
//            'projectId' => $projectId,
//        ]);
//        $vision = $builder->vision();
//        $storage = $builder->storage();
//
//        // fetch the storage object and annotate the image
//        $object = $storage->bucket($bucketName)->object($objectName);
//        $image = $vision->image($object, ['TEXT_DETECTION']);
//        $result = $vision->annotate($image);
//
//        // print the response
//        print("Texts:\n");
//        foreach ((array)$result->text() as $text) {
//            print($text->description() . PHP_EOL);
//        }
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