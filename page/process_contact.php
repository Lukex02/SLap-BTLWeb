<?php
include '../server/import.php'; 

// Xử lý form khi được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Làm sạch dữ liệu đầu vào
    $full_name = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
  

    // Kiểm tra dữ liệu bắt buộc
    if (empty($full_name) || empty($email) || empty($phone) || empty($address) || empty($message)) {
        header("Location: tranglienhe.php?status=error&message=" . urlencode("Vui lòng điền đầy đủ tất cả các trường."));
        exit;
    }

    // Sử dụng prepared statement để lưu dữ liệu
    $stmt = $conn->prepare("INSERT INTO contacts (full_name, email, phone, address, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $email, $phone, $address, $message);

    // Thực thi và kiểm tra
    if ($stmt->execute()) {
        header("Location: tranglienhe.php?status=success");
    } else {
        header("Location: tranglienhe.php?status=error&message=" . urlencode("Có lỗi xảy ra. Vui lòng thử lại."));
    }

    // Đóng statement và kết nối
    $stmt->close();
    $conn->close();
    exit;
}
?>