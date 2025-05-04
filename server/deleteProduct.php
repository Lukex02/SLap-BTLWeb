<?php
include "import.php";

header('Content-Type: application/json');

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ']);
    exit;
}
$sql_get_image = "SELECT image FROM products WHERE id = ?";
$stmt = $conn->prepare($sql_get_image);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if ($row['image'] != "/pic/prop_laptop.jpg" && file_exists(".." . $row['image'])) {
        if (unlink(".." . $row['image'])) {
        }
    }
}
// Delete product
$sql = "DELETE FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Xóa sản phẩm thành công']);
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi xóa sản phẩm: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>