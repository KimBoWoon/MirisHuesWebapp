<html>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: secret
 * Date: 1/15/17
 * Time: 6:36 PM
 */
echo Form::open(array('url' => '/uploadfile', 'files' => 'true'));
echo 'Select the File to upload.';
echo Form::File('image');
echo Form::submit('Upload File');
echo Form::close();
?>