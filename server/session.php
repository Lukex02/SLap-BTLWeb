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
    $isAdmin  = boolval($row["isAdmin"]);
    $isLocked = boolval($row["isLock"]);

    if ($isLocked) {
        session_unset();
        session_destroy();

        // Hủy cookie
        setcookie(session_name(), '', time() - 86400, '/');

        echo json_encode(["success" => false, "message" => "Tài khoản bị khóa"]);
        exit;
    }

    echo json_encode([
      "success" => true,
      "user_id" => $loggedInUserId,
      "username" => $username,
      "avatar" => $avatar,
      "email" => $email,
      "isAdmin" => $isAdmin,
    ]);
  } else {
    echo json_encode(["success" => false, "message" => "Lỗi database"]);
  }
} else {
  echo json_encode(["success" => false, "message" => "Người dùng chưa đăng nhập"]);
}
?>