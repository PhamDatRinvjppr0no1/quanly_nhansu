<?php
include 'db.php'; // Kết nối database


// $servername = "localhost"; // Máy chủ (XAMPP dùng localhost)
// $username = "root"; // Tài khoản mặc định của XAMPP
// $password = ""; // Mặc định XAMPP không có mật khẩu
// $database = "ql_nhansu"; // Tên database của bạn

// // Kết nối MySQL
// $conn = mysqli_connect($servername, $username, $password, $database);

// // Kiểm tra kết nối
// if (!$conn) {
//     die("Kết nối thất bại: " . mysqli_connect_error());
// }

// // Thiết lập charset UTF-8 để tránh lỗi font tiếng Việt
// mysqli_set_charset($conn, "utf8");




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    // Kiểm tra dữ liệu không được rỗng
    if (!empty($ma_nv) && !empty($ten_nv) && !empty($phai) && !empty($noi_sinh) && !empty($ma_phong) && !empty($luong)) {
        $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
                VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$ma_phong', '$luong')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Thêm nhân viên thành công!'); window.location.href='list.php';</script>";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
    <link rel="stylesheet" href="style.css"> <!-- Kết nối file CSS -->
</head>
<body>
    <h2>Thêm Nhân Viên</h2>
    <form method="POST">
        <label>Mã Nhân Viên:</label>
        <input type="text" name="ma_nv" required><br>

        <label>Tên Nhân Viên:</label>
        <input type="text" name="ten_nv" required><br>

        <label>Giới Tính:</label>
        <select name="phai">
            <option value="NAM">Nam</option>
            <option value="NU">Nữ</option>
        </select><br>

        <label>Nơi Sinh:</label>
        <input type="text" name="noi_sinh" required><br>

        <label>Phòng Ban:</label>
        <select name="ma_phong">
            <option value="TC">Tài Chính</option>
            <option value="QT">Quản Trị</option>
            <option value="KT">Kỹ Thuật</option>
        </select><br>

        <label>Lương:</label>
        <input type="number" name="luong" required><br>

        <button type="submit">Thêm Nhân Viên</button>
    </form>
    <a href="list.php">Quay lại</a>
</body>
</html>
