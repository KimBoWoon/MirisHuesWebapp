<html>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: secret
 * Date: 1/15/17
 * Time: 6:36 PM
 */
//echo Form::open(array('url' => '/uploadfile', 'files' => 'true'));
echo 'Select the file to upload.';
//echo Form::file('image');
//echo Form::submit('Upload File');
//echo Form::close();
?>
<!-- 데이터 인코딩형 enctype은 꼭 아래처럼 설정해야 합니다 -->
<form enctype="multipart/form-data" action="/uploadfile" method="POST">
    <!-- MAX_FILE_SIZE는 file 입력 필드보다 먼저 나와야 합니다 -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- input의 name은 $_FILES 배열의 name을 결정합니다 -->
    이 파일을 전송합니다: <input name="image" type="file" />
    <input type="submit" value="파일 전송" />
</form>
</body>
</html>