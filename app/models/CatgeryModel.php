<?php
class CategoryModel {
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

    // Lấy danh sách tất cả phòng ban
    public function getAllCategories() {
        $sql = "SELECT * FROM PHONGBAN";
        $result = $this->conn->query($sql);
        
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }

    // Thêm phòng ban mới
    public function addCategory($ma_phong, $ten_phong) {
        $sql = "INSERT INTO PHONGBAN (Ma_Phong, Ten_Phong) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $ma_phong, $ten_phong);
        return $stmt->execute();
    }

    // Cập nhật thông tin phòng ban
    public function updateCategory($ma_phong, $ten_phong) {
        $sql = "UPDATE PHONGBAN SET Ten_Phong=? WHERE Ma_Phong=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $ten_phong, $ma_phong);
        return $stmt->execute();
    }

    // Xóa phòng ban
    public function deleteCategory($ma_phong) {
        $sql = "DELETE FROM PHONGBAN WHERE Ma_Phong=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $ma_phong);
        return $stmt->execute();
    }

    // Lấy thông tin phòng ban theo mã phòng
    public function getCategoryById($ma_phong) {
        $sql = "SELECT * FROM PHONGBAN WHERE Ma_Phong=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $ma_phong);
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
