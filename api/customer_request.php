<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Kết nối cơ sở dữ liệu
require '../config/db.php';

$method = $_SERVER['REQUEST_METHOD'];

// Kiểm tra phương thức HTTP
if ($method === 'GET') {
    try {
        // Lấy dữ liệu từ bảng `customer_request`
        $stmt = $pdo->query("SELECT * FROM customer_request");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Trả về dữ liệu dưới dạng JSON
        echo json_encode([
            "status" => "success",
            "data" => $data
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        // Trả về lỗi nếu có
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
} else {
    // Phương thức không hợp lệ
    echo json_encode([
        "status" => "error",
        "message" => "Phương thức HTTP không được hỗ trợ."
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
?>