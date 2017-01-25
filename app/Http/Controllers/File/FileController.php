<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use MicrosoftAzure\Storage\Blob\Models\BlockList;
use MicrosoftAzure\Storage\Common\ServiceException;
use WindowsAzure\Common\ServicesBuilder;

class FileController extends Controller
{
    public function index()
    {
        return view('file/upload');
    }

    public function showUploadFile(Request $request)
    {
        $file = $request->file('photo');

        $connectionString = 'DefaultEndpointsProtocol=https;AccountName=' . env('ACCOUNTNAME') . ';AccountKey=' . env('ACCOUNTKEY');

        // Create blob REST proxy.
        $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

        try {
            //Upload blob
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $blockId = 1;
            $blocklist = new BlockList();
            $blocklist->addLatestEntry(md5($blockId));
            $content = file_get_contents($file->getRealPath());
            $blobRestProxy->createBlobBlock('images', $filename, md5($blockId), $content);
            $blobRestProxy->commitBlobBlocks("images", $filename, $blocklist->getEntries());
        } catch (ServiceException $e) {
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/library/azure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code . ": " . $error_message . "<br />";
        }
    }

    static function getImageUrl()
    {
        $connectionString = 'DefaultEndpointsProtocol=https;AccountName=' . env('ACCOUNTNAME') . ';AccountKey=' . env('ACCOUNTKEY');

        // Create blob REST proxy.
        $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

        try {
            // List blobs.
            $blob_list = $blobRestProxy->listBlobs('images');
            $blobs = $blob_list->getBlobs();

//            var_dump($blobs);
            ksort($blobs);
//            foreach ($blobs as $blob) {
//                echo $blob->getName() . ": " . $blob->getUrl() . "<br />";
//            }
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
