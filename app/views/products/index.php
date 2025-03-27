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

// include 'controllers/ProductController.php';

// Lấy danh sách nhân viên từ API
// $employees = json_decode(file_get_contents("http://localhost/ProductController.php?action=getEmployees"), true);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Nhân Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            color: blue;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: red;
            color: white;
        }
        tr:nth-child(even) {
            background-color: lightgray;
        }
        .gender-icon {
            width: 30px;
        }
    </style>
</head>
<body>

    <h1>THÔNG TIN NHÂN VIÊN</h1>

    <table>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Tên Nhân Viên</th>
            <th>Giới Tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
        </tr>
        

        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee['Ma_NV']; ?></td>
            <td><?php echo $employee['Ten_NV']; ?></td>
            <td>
                <?php if ($employee['Phai'] == 'Nam'): ?>
                    <img src="male_icon.png" class="gender-icon" alt="Nam">
                <?php else: ?>
                    <img src="female_icon.png" class="gender-icon" alt="Nữ">
                <?php endif; ?>
            </td>
            <td><?php echo $employee['Noi_Sinh']; ?></td>
            <td><?php echo $employee['Ten_Phong']; ?></td>
            <td><?php echo $employee['Luong']; ?></td>
        </tr>
        <?php endforeach; ?>
        

    </table>
    <?php require 'app/views/shares/footer.php'; ?>
</body>
</html>
