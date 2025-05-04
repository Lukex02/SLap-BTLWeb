<?php
include '../server/import.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    // Kiểm tra ID hợp lệ
    if ($id <= 0) {
        echo json_encode(['success' => false, 'error' => 'ID không hợp lệ']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE contacts SET is_read = 1 WHERE id = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'error' => 'Lỗi chuẩn bị truy vấn: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Lỗi thực thi truy vấn: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Yêu cầu không hợp lệ hoặc thiếu ID']);
}
?>