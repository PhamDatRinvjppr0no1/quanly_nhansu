<?php
include 'db.php'; // Kết nối database



function getGenderImage($gender) {
    if ($gender == "NAM") {
        return "<img src='images/male.png' alt='Nam' width='30' height='30'>";
    } else {
        return "<img src='images/female.png' alt='Nữ' width='30' height='30'>";
    }
}

// Số nhân viên mỗi trang
$limit = 5;

// Xác định trang hiện tại (nếu không có thì mặc định là trang 1)
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$page = max(1, intval($page)); // Đảm bảo page >= 1

// Tính toán offset (bắt đầu lấy từ nhân viên thứ mấy)
$offset = ($page - 1) * $limit;

// Truy vấn tổng số nhân viên để tính tổng số trang
$total_sql = "SELECT COUNT(*) AS total FROM nhanvien";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_records / $limit);

// Truy vấn lấy danh sách nhân viên có phân trang
$sql = "SELECT * FROM nhanvien LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Nhân Viên</title>
    <link rel="stylesheet" href="style1.css"> <!-- Kết nối CSS -->
</head>
<body>
    <h2>Danh Sách Nhân Viên</h2>

    <table>
        <tr>
            <th>Mã NV</th>
            <th>Tên Nhân Viên</th>
            <th>Giới Tính</th>
            <th>Nơi Sinh</th>
            <th>Phòng Ban</th>
            <th>Lương</th>
            <th>Hành Động</th>
        </tr>

        <?php
        // Hiển thị dữ liệu nhân viên
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['Ma_NV']."</td>";
                echo "<td>".$row['Ten_NV']."</td>";
                echo "<td>".getGenderImage($row['Phai'])."</td>"; 
                echo "<td>".$row['Noi_Sinh']."</td>";
                echo "<td>".$row['Ma_Phong']."</td>";
                echo "<td>".$row['Luong']."</td>";
                echo "<td>
                        <a href='edit.php?id=".$row['Ma_NV']."'>Sửa</a> | 
                        <a href='delete.php?id=".$row['Ma_NV']."' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Không có nhân viên nào!</td></tr>";
        }
        ?>
    </table>

    <!-- Hiển thị nút phân trang -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="list.php?page=<?= $page - 1 ?>">« Trang Trước</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="list.php?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="list.php?page=<?= $page + 1 ?>">Trang Sau »</a>
        <?php endif; ?>
    </div>

    <a href="add.php" class="add-btn">➕ Thêm Nhân Viên</a>
    
</body>
</html>

<?php
// Đóng kết nối database
mysqli_close($conn);
?>
<?php if ($_SESSION['role'] == 'admin'): ?>
    <a href="add.php">Thêm Nhân Viên</a>
    <a href="edit.php">Sửa Nhân Viên</a>
    <a href="delete.php">Xóa Nhân Viên</a>
<?php endif; ?>

<a href="list.php">Danh sách Nhân Viên</a>
<a href="login.php">Đăng Xuất</a>
