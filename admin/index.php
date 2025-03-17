<?php
$servername = "localhost";  // Hoặc 127.0.0.1
$username = "root";         // Tài khoản mặc định của XAMPP
$password = "";             // Mặc định không có mật khẩu
$dbname = "slap";     // Tên database đã tạo

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "Kết nối thành công!";
}
?>