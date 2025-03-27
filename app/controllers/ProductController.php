<?php
include 'CategoryController.php';
include 'ProductController.php';

$categoryController = new CategoryController();
// $productController = new ProductController();

// Lấy danh sách phòng ban
$categories = json_decode(file_get_contents("http://localhost/CategoryController.php?action=getCategories"), true);

// Lấy danh sách nhân viên
$employees = json_decode(file_get_contents("http://localhost/ProductController.php?action=getEmployees"), true);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Sự</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Quản Lý Nhân Sự</h1>

    <!-- Danh sách phòng ban -->
    <h2>Danh sách phòng ban</h2>
    <table>
        <tr>
            <th>Mã Phòng</th>
            <th>Tên Phòng</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($categories as $category): ?>
        <tr>
            <td><?php echo $category['Ma_Phong']; ?></td>
            <td><?php echo $category['Ten_Phong']; ?></td>
            <td>
                <button onclick="deleteCategory('<?php echo $category['Ma_Phong']; ?>')">Xóa</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Thêm phòng ban -->
    <h3>Thêm Phòng Ban</h3>
    <form method="POST" action="CategoryController.php">
        <input type="hidden" name="action" value="addCategory">
        Mã Phòng: <input type="text" name="ma_phong" required>
        Tên Phòng: <input type="text" name="ten_phong" required>
        <button type="submit">Thêm</button>
    </form>

    <!-- Danh sách nhân viên -->
    <h2>Danh sách Nhân Viên</h2>
    <table>
        <tr>
            <th>Mã NV</th>
            <th>Tên NV</th>
            <th>Phái</th>
            <th>Nơi Sinh</th>
            <th>Mã Phòng</th>
            <th>Lương</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee['Ma_NV']; ?></td>
            <td><?php echo $employee['Ten_NV']; ?></td>
            <td><?php echo $employee['Phai']; ?></td>
            <td><?php echo $employee['Noi_Sinh']; ?></td>
            <td><?php echo $employee['Ma_Phong']; ?></td>
            <td><?php echo $employee['Luong']; ?></td>
            <td>
                <button onclick="deleteEmployee('<?php echo $employee['Ma_NV']; ?>')">Xóa</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Thêm nhân viên -->
    <h3>Thêm Nhân Viên</h3>
    <form method="POST" action="ProductController.php">
        <input type="hidden" name="action" value="addEmployee">
        Mã NV: <input type="text" name="ma_nv" required>
        Tên NV: <input type="text" name="ten_nv" required>
        Phái: 
        <select name="phai">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
        Nơi Sinh: <input type="text" name="noi_sinh" required>
        Mã Phòng: <input type="text" name="ma_phong" required>
        Lương: <input type="number" name="luong" required>
        <button type="submit">Thêm</button>
    </form>

    <script>
        function deleteCategory(maPhong) {
            if (confirm("Bạn có chắc chắn muốn xóa phòng ban này?")) {
                fetch("CategoryController.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "action=deleteCategory&ma_phong=" + maPhong
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Xóa thành công!");
                        location.reload();
                    } else {
                        alert("Xóa thất bại!");
                    }
                });
            }
        }

        function deleteEmployee(maNV) {
            if (confirm("Bạn có chắc chắn muốn xóa nhân viên này?")) {
                fetch("ProductController.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "action=deleteEmployee&ma_nv=" + maNV
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Xóa thành công!");
                        location.reload();
                    } else {
                        alert("Xóa thất bại!");
                    }
                });
            }
        }
    </script>
</body>
</html>
