<?php
include "import.php";

header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$action = $input["action"] ?? "";

if ($action === "add") {
    $title = $input["title"] ?? "";
    $excerpt = $input["excerpt"] ?? "";
    $thumbnail = $input["thumbnail"] ?? "";
    $slug = $input["slug"] ?? "";

    if (empty($title) || empty($excerpt) || empty($thumbnail) || empty($slug)) {
        echo json_encode(["success" => false, "message" => "Dữ liệu không hợp lệ!"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO articles (title, excerpt, thumbnail, slug) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $excerpt, $thumbnail, $slug);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi khi thêm bài viết!"]);
    }
    $stmt->close();
} elseif ($action === "update") {
    $id = $input["id"] ?? 0;
    $title = $input["title"] ?? "";
    $excerpt = $input["excerpt"] ?? "";
    $thumbnail = $input["thumbnail"] ?? "";
    $slug = $input["slug"] ?? "";

    if ($id <= 0 || empty($title) || empty($excerpt) || empty($thumbnail) || empty($slug)) {
        echo json_encode(["success" => false, "message" => "Dữ liệu không hợp lệ!"]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE articles SET title = ?, excerpt = ?, thumbnail = ?, slug = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $excerpt, $thumbnail, $slug, $id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi khi cập nhật bài viết!"]);
    }
    $stmt->close();
} elseif ($action === "toggle_visibility") {
    $id = $input["id"] ?? 0;

    if ($id <= 0) {
        echo json_encode(["success" => false, "message" => "ID không hợp lệ!"]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE articles SET is_visible = !is_visible WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Lỗi khi thay đổi trạng thái hiển thị!"]);
    }
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Hành động không hợp lệ!"]);
}

$conn->close();
?>