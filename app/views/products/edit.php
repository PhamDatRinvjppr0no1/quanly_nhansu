<?php
include 'db.php'; // Kết nối database

// Kiểm tra nếu có ID nhân viên được truyền vào từ danh sách
if (isset($_GET['id'])) {
    $ma_nv = $_GET['id'];

    // Lấy thông tin nhân viên từ database
    $sql = "SELECT * FROM nhanvien WHERE Ma_NV = '$ma_nv'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Nếu không tìm thấy nhân viên
    if (!$row) {
        echo "<script>alert('Nhân viên không tồn tại!'); window.location.href='list.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Không có ID nhân viên!'); window.location.href='list.php';</script>";
    exit();
}

// Xử lý cập nhật dữ liệu khi nhấn nút "Cập Nhật"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    // Câu lệnh SQL cập nhật thông tin nhân viên
    $sql_update = "UPDATE nhanvien SET Ten_NV='$ten_nv', Phai='$phai', Noi_Sinh='$noi_sinh', Ma_Phong='$ma_phong', Luong='$luong' WHERE Ma_NV='$ma_nv'";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='list.php';</script>";
    } else {
        echo "Lỗi cập nhật: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Nhân Viên</title>
    <link rel="stylesheet" href="style.css"> <!-- Kết nối CSS -->
</head>
<body>
    <h2>Chỉnh Sửa Nhân Viên</h2>
    <form method="POST">
        <label>Mã Nhân Viên:</label>
        <input type="text" name="ma_nv" value="<?= $row['Ma_NV'] ?>" readonly><br>

        <label>Tên Nhân Viên:</label>
        <input type="text" name="ten_nv" value="<?= $row['Ten_NV'] ?>" required><br>

        <label>Giới Tính:</label>
        <select name="phai">
            <option value="NAM" <?= ($row['Phai'] == 'NAM') ? 'selected' : '' ?>>Nam</option>
            <option value="NU" <?= ($row['Phai'] == 'NU') ? 'selected' : '' ?>>Nữ</option>
        </select><br>

        <label>Nơi Sinh:</label>
        <input type="text" name="noi_sinh" value="<?= $row['Noi_Sinh'] ?>" required><br>

        <label>Phòng Ban:</label>
        <select name="ma_phong">
            <option value="TC" <?= ($row['Ma_Phong'] == 'TC') ? 'selected' : '' ?>>Tài Chính</option>
            <option value="QT" <?= ($row['Ma_Phong'] == 'QT') ? 'selected' : '' ?>>Quản Trị</option>
            <option value="KT" <?= ($row['Ma_Phong'] == 'KT') ? 'selected' : '' ?>>Kỹ Thuật</option>
        </select><br>

        <label>Lương:</label>
        <input type="number" name="luong" value="<?= $row['Luong'] ?>" required><br>

        <button type="submit">Cập Nhật</button>
    </form>

    <a href="list.php">⬅ Quay lại danh sách</a>
</body>
</html>
