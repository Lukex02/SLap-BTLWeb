<?php
session_start();
require "import.php";
header("Content-Type: application/json"); // Định dạng JSON
$json_data = file_get_contents('php://input');
$data = json_decode($json_data);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  if (!hash_equals($_SESSION['csrf_token'], $data->csrf_token)) {
    echo json_encode(["success" => false, "message" => "Token CSRF không hợp lệ"]);
    exit;
  }
}

$username = $data->username;
$email = $data->email;
$oldPassword = $data->oldPassword;
$password = $data->password;

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
  $loggedInUserId = $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->bind_param("i", $loggedInUserId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($oldPassword, $row["password"])) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE users SET 
      `username` = ?, 
      `email` = ?,
      `password` = ?
        WHERE `id` = ?");
      $stmt->bind_param("sssi", $username, $email, $password, $loggedInUserId);
      if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Cập nhật thành công"]);
      } else {
        echo json_encode(["success" => true, "message" => $stmt->error]);
      }
      $stmt->close();
    } else {
      echo json_encode(["success" => false, "message" => "Mật khẩu cũ không chính xác"]);
    }
  } else {
    echo json_encode(["success" => false, "message" => "Lỗi database"]);
  }
} else {
  echo json_encode(["success" => false, "message" => "Người dùng chưa đăng nhập"]);
}