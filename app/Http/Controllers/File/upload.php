<?php
/**
 * Created by PhpStorm.
 * User: secret
 * Date: 1/15/17
 * Time: 3:52 PM
 */
if (!$_FILES['userfile']['name']) {
    $str = $_FILES['userfile']['name'];
    echo "<script>alert($str);</script>";
    echo "<script>alert('업로드 할 파일이 입력되지 않았습니다.');";
    echo "history.back();</script>";
    exit;
}

if (strlen($_FILES['userfile']['name']) > 255) {
    echo "<script>alert('파일 이름이 너무 깁니다.');";
    echo "history.back();</script>";
    exit;
}

$date = date("YmdHis", time());
$dir = "./files/";
$file_hash = $date . $_FILES['userfile']['name'];
$file_hash = md5($file_hash);
$upfile = $dir . $file_hash;

if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)) {
        echo "upload error";
        exit;
    }
}

@ $db = new mysqli('DB호스트명', '아이디', '비밀번호', 'DB명');
if (mysqli_connect_errno()) {
    echo "DB error";
    exit;
}

$query = "insert into ftp (name, hash, time) 
              values('" . $_FILES['userfile']['name'] . "', 
              '" . $file_hash . "', '" . $date . "')";
$result = $db->query($query);
if (!$result) {
    echo "DB upload error";
    exit;
}

$db->close();

echo "<script>alert('업로드 성공');";
echo "history.back();</script>";

?>