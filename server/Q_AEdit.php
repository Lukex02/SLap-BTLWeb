<?php
include 'import.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $comment = $_POST['comment'];

    // Sử dụng prepared statement để bảo mật
    $stmt = $conn->prepare("UPDATE tb_data SET comment = ? WHERE id = ?");
    $stmt->bind_param("si", $comment, $id);

    if ($stmt->execute()) {
        header("Location: ../admin/Q_AAdmin.php"); // Trở lại trang quản lý sau khi sửa
        exit();
    } else {
        echo "Lỗi khi cập nhật bình luận: " . $conn->error;
    }

    $stmt->close();
}
?>
