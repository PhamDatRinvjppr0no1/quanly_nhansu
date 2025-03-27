<?php
class ProductModel {
    private $conn;

    // Constructor để kết nối database
    public function __construct() {
        $servername = "localhost"; // Đổi nếu cần
        $username = "root";        // Đổi nếu cần
        $password = "";            // Đổi nếu cần
        $dbname = "QL_NhanSu";

        // Kết nối MySQL bằng MySQLi
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    // Lấy danh sách tất cả nhân viên
    public function getAllEmployees() {
        $sql = "SELECT * FROM NHANVIEN";
        $result = $this->conn->query($sql);
        
        $employees = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
        }
        return $employees;
    }

    // Thêm nhân viên mới
    public function addEmployee($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong) {
        $sql = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssi", $ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);
        return $stmt->execute();
    }

    // Cập nhật thông tin nhân viên
    public function updateEmployee($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong) {
        $sql = "UPDATE NHANVIEN SET Ten_NV=?, Phai=?, Noi_Sinh=?, Ma_Phong=?, Luong=? WHERE Ma_NV=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssis", $ten_nv, $phai, $noi_sinh, $ma_phong, $luong, $ma_nv);
        return $stmt->execute();
    }

    // Xóa nhân viên
    public function deleteEmployee($ma_nv) {
        $sql = "DELETE FROM NHANVIEN WHERE Ma_NV=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $ma_nv);
        return $stmt->execute();
    }

    // Lấy thông tin nhân viên theo mã NV
    public function getEmployeeById($ma_nv) {
        $sql = "SELECT * FROM NHANVIEN WHERE Ma_NV=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $ma_nv);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Đóng kết nối
    public function __destruct() {
        $this->conn->close();
    }
}
?>
