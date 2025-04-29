<?php
session_start();
require "import.php";
header("Content-Type: application/json"); // Định dạng JSON
$json_data = file_get_contents('php://input');
$data = json_decode($json_data);

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
  $userId = $data->account_id;

  // Logout tài khoản (xóa session và cookies) trong trường hợp tự xóa tài khoản đang sử dụng
  if ($userId == $_SESSION['user_id']) {
    // Hủy session
    session_unset();
    session_destroy();

    // Hủy cookie
    setcookie(session_name(), '', time() - 86400, '/');

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    echo json_encode(["success" => true, "message" => "Xóa tài khoản thành công"]);
    $stmt->close();
  } else {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    echo json_encode(["success" => true, "message" => "Xóa tài khoản thành công"]);
    $stmt->close();
  }
}