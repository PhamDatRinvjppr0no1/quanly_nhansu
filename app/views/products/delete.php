<?php
include 'db.php'; // Kết nối database

// Kiểm tra nếu có ID nhân viên được truyền vào từ danh sách
if (isset($_GET['id'])) {
    $ma_nv = $_GET['id'];

    // Câu lệnh SQL xóa nhân viên
    $sql = "DELETE FROM nhanvien WHERE Ma_NV = '$ma_nv'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Xóa nhân viên thành công!'); window.location.href='list.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa nhân viên!'); window.location.href='list.php';</script>";
    }
} else {
    echo "<script>alert('Không có ID nhân viên!'); window.location.href='list.php';</script>";
}

// Đóng kết nối
mysqli_close($conn);
?>
