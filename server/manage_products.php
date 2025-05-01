<?php
include "import.php";

header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$action = $input["action"] ?? "";

if ($action === "add") {
    $name = $input["name"] ?? "";
    $price = $input["price"] ?? 0;
    $image = $input["image"] ?? "";

    if (empty($name) || $price <= 0 || empty($image)) {
        echo json_encode(["success" => false, "message" => "Dữ liệu không hợp lệ!"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $image);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi khi thêm sản phẩm!"]);
    }
    $stmt->close();
} elseif ($action === "update") {
    $id = $input["id"] ?? 0;
    $name = $input["name"] ?? "";
    $price = $input["price"] ?? 0;
    $image = $input["image"] ?? "";

    if ($id <= 0 || empty($name) || $price <= 0 || empty($image)) {
        echo json_encode(["success" => false, "message" => "Dữ liệu không hợp lệ!"]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sdsi", $name, $price, $image, $id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi khi cập nhật sản phẩm!"]);
    }
    $stmt->close();
} elseif ($action === "delete") {
    $id = $input["id"] ?? 0;

    if ($id <= 0) {
        echo json_encode(["success" => false, "message" => "ID không hợp lệ!"]);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi khi xóa sản phẩm!"]);
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Hành động không hợp lệ!"]);
}

$conn->close();
?>