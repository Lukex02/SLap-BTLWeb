<?php
session_start();
require "import.php";
header("Content-Type: application/json"); // Định dạng JSON

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
  $loggedInUserId = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->bind_param("i", $loggedInUserId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
    $avatar = $row["avatar"];
    $email = $row["email"];
    $isAdmin = boolval($row["isAdmin"]);

    echo json_encode([
      "success" => true,
      "user_id" => $loggedInUserId,
      "username" => $username,
      "avatar" => $avatar,
      "email" => $email,
      "isAdmin" => $isAdmin,
    ]);
  } else {
    echo json_encode(["success" => false, "message" => "Không tìm thấy tài khoản"]);
  }
} else {
  echo json_encode(["success" => false, "message" => "Người dùng chưa đăng nhập"]);
}
?>