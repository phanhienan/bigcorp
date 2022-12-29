<?php
$hostName = 'localhost';
$userName = 'root';
$passWord = '';
$databaseName = 'web';
// khởi tạo kết nối
$db = new mysqli($hostName, $userName, $passWord, $databaseName);

//Kiểm tra kết nối
if ($db->connect_error) {
    exit('Kết nối không thành công. chi tiết lỗi:' . $db->connect_error);
}
?>