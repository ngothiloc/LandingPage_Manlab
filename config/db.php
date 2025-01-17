<?php
$host = 'localhost'; // Địa chỉ máy chủ
$dbname = 'manlab_vn'; // Tên cơ sở dữ liệu
$username = 'root'; // Tên người dùng
$password = ''; // Mật khẩu

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}
?>