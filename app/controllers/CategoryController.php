<?php
include 'CategoryModel.php';

class CategoryController {
    private $model;

    public function __construct() {
        $this->model = new CategoryModel();
    }

    // Lấy danh sách phòng ban
    public function getCategories() {
        $categories = $this->model->getAllCategories();
        echo json_encode($categories);
    }

    // Lấy thông tin phòng ban theo mã phòng
    public function getCategoryById($ma_phong) {
        $category = $this->model->getCategoryById($ma_phong);
        echo json_encode($category);
    }

    // Thêm phòng ban mới
    public function addCategory($ma_phong, $ten_phong) {
        $result = $this->model->addCategory($ma_phong, $ten_phong);
        echo json_encode(["success" => $result]);
    }

    // Cập nhật thông tin phòng ban
    public function updateCategory($ma_phong, $ten_phong) {
        $result = $this->model->updateCategory($ma_phong, $ten_phong);
        echo json_encode(["success" => $result]);
    }

    // Xóa phòng ban
    public function deleteCategory($ma_phong) {
        $result = $this->model->deleteCategory($ma_phong);
        echo json_encode(["success" => $result]);
    }
}

// Kiểm tra yêu cầu từ frontend
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $controller = new CategoryController();

    switch ($_GET['action']) {
        case 'getCategories':
            $controller->getCategories();
            break;
        case 'getCategoryById':
            if (isset($_GET['ma_phong'])) {
                $controller->getCategoryById($_GET['ma_phong']);
            }
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $controller = new CategoryController();

    switch ($_POST['action']) {
        case 'addCategory':
            if (isset($_POST['ma_phong'], $_POST['ten_phong'])) {
                $controller->addCategory($_POST['ma_phong'], $_POST['ten_phong']);
            }
            break;
        case 'updateCategory':
            if (isset($_POST['ma_phong'], $_POST['ten_phong'])) {
                $controller->updateCategory($_POST['ma_phong'], $_POST['ten_phong']);
            }
            break;
        case 'deleteCategory':
            if (isset($_POST['ma_phong'])) {
                $controller->deleteCategory($_POST['ma_phong']);
            }
            break;
    }
}
?>
