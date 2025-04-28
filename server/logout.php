<?php
session_start();
require "import.php";
header("Content-Type: application/json"); // Định dạng JSON

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
  $loggedInUserId = $_SESSION['user_id'];

  // Hủy session
  session_unset();
  session_destroy();

  // Hủy cookie
  setcookie(session_name(), '', time() - 86400, '/');

  echo json_encode(["success" => true, "message" => "Đăng xuất thành công"]);
} else {
  echo json_encode(["success" => false, "message" => "Người dùng chưa đăng nhập"]);
}