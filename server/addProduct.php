<?php
include "import.php";

header('Content-Type: application/json');

// Get product data from POST
$name = $conn->real_escape_string($_POST['name']);
$brand = $conn->real_escape_string($_POST['brand']);
$price = $conn->real_escape_string($_POST['price']);
$cpu = $conn->real_escape_string($_POST['cpu']);
$ram = $conn->real_escape_string($_POST['ram']);
$screen = $conn->real_escape_string($_POST['screen']);
$gpu = $conn->real_escape_string($_POST['gpu']);
$image = $conn->real_escape_string($_POST['image']);

// Validate required fields
if (empty($name) || empty($brand) || empty($price)) {
    echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin cần thiết']);
    exit;
}

// Insert product into database
$sql = "INSERT INTO products (name, brand, price, cpu, ram, screen, gpu, image) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssss", $name, $brand, $price, $cpu, $ram, $screen, $gpu, $image);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Thêm sản phẩm thành công']);
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi thêm sản phẩm: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>