<?php
session_start();
require "import.php";
header("Content-Type: application/json"); // Định dạng JSON

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
  $json_data = file_get_contents('php://input');
  $data = json_decode($json_data);

  $content = $data->content;
  $article_id = (int) $data->article_id;
  $user_id = (int) $_SESSION['user_id'];
  $created_at = gmdate("Y-m-d H:i:s", time());

  $stmt = $conn->prepare("INSERT INTO comments (user_id, article_id, content, created_at) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("iiss", $user_id, $article_id, $content, $created_at);

  if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Bình luận đã được đăng thành công"]);
  } else {
    echo json_encode(["success" => false, "message" => "Lỗi database"]);
  }
  $stmt->close();
} else {
  echo json_encode(["success" => false, "message" => "Người dùng chưa đăng nhập"]);
}