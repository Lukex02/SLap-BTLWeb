<?php
include "import.php";

$title = $_POST['title'];
$content = $_POST['content'];
$imageName = "";

// Kiểm tra và xử lý ảnh mới nếu có upload
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $imageName = basename($_FILES['image']['name']);
    $targetPath = "../pic/" . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
    
    // Cập nhật cả ảnh
    $stmt = $conn->prepare("UPDATE intro_content SET title=?, content=?, image=? WHERE id=1");
    $stmt->bind_param("sss", $title, $content, $imageName);
} else {
    // Không thay đổi ảnh
    $stmt = $conn->prepare("UPDATE intro_content SET title=?, content=? WHERE id=1");
    $stmt->bind_param("ss", $title, $content);
}

if ($stmt->execute()) {
    header("Location: ../page/gioithieu.php"); // Trở lại trang giới thiệu sau khi cập nhật
    exit();
} else {
    echo "Cập nhật thất bại: " . $conn->error;
}
?>
