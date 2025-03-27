<?php
$servername = "localhost"; // Máy chủ (XAMPP dùng localhost)
$username = "root"; // Tài khoản mặc định của XAMPP
$password = ""; // Mặc định XAMPP không có mật khẩu
$database = "ql_nhansu"; // Tên database của bạn

// Kết nối MySQL
$conn = mysqli_connect($servername, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Thiết lập charset UTF-8 để tránh lỗi font tiếng Việt
mysqli_set_charset($conn, "utf8");

?>
