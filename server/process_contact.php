<?php
include '../server/import.php';

// Xử lý form khi được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Làm sạch dữ liệu đầu vào
    $full_name = htmlspecialchars(trim($_POST['full_name'] ?? ''), ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST['address'] ?? ''), ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars(trim($_POST['message'] ?? ''), ENT_QUOTES, 'UTF-8');


    // Kiểm tra dữ liệu bắt buộc
    if (empty($full_name) || empty($email) || empty($phone) || empty($address) || empty($message)) {
        header("Location: /contact?status=error&message=" . urlencode("Vui lòng điền đầy đủ tất cả các trường."));
        exit;
    }

    // Sử dụng prepared statement để lưu dữ liệu
    $stmt = $conn->prepare("INSERT INTO contacts (full_name, email, phone, address, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $email, $phone, $address, $message);

    // Thực thi và kiểm tra
    if ($stmt->execute()) {
        header("Location: /contact?status=success");
    } else {
        header("Location: /contact?status=error&message=" . urlencode("Có lỗi xảy ra. Vui lòng thử lại."));
    }

    // Đóng statement và kết nối
    $stmt->close();
    $conn->close();
    exit;
}
?>