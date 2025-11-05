<?php
$host = "localhost";
$user = "root";      // hoặc tài khoản MySQL của bạn
$pass = "";          // mật khẩu MySQL của bạn
$dbname = "udn";
$port = 3307;

$con = mysqli_connect($host, $user, $pass, $dbname, $port);
if (!$con) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>
