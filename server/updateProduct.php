<?php
include "import.php";

header('Content-Type: application/json');

// Get product data from POST
$id = $conn->real_escape_string($_POST['id']);
$name = $conn->real_escape_string($_POST['name']);
$brand = $conn->real_escape_string($_POST['brand']);
$price = $conn->real_escape_string($_POST['price']);
$cpu = $conn->real_escape_string($_POST['cpu']);
$ram = $conn->real_escape_string($_POST['ram']);
$screen = $conn->real_escape_string($_POST['screen']);
$gpu = $conn->real_escape_string($_POST['gpu']);
$image = $conn->real_escape_string($_POST['image']);

// Validate required fields
if (empty($id) || empty($name) || empty($brand) || empty($price)) {
    echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin cần thiết']);
    exit;
}

// Update product in database
$sql = "UPDATE products SET name=?, brand=?, price=?, cpu=?, ram=?, screen=?, gpu=?, image=? WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssssi", $name, $brand, $price, $cpu, $ram, $screen, $gpu, $image, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cập nhật sản phẩm thành công']);
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi cập nhật sản phẩm: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>