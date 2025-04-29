<?php
session_start();
require "import.php";
header("Content-Type: application/json"); // Định dạng JSON
$json_data = file_get_contents('php://input');
$data = json_decode($json_data);

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
  $userId = $data->account_id;

  $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check quyền hạn của tài khoản này
    if ($row["isAdmin"] === 1) {
      $isAdmin = 1;
    } else {
      $isAdmin = 0;
    }

    // Bỏ qua nếu tài khoản này đã là admin
    if ($data->isAdmin === $isAdmin) {
      echo json_encode(["success" => false, "message" => "Tài khoản này đã có quyền tương đương"]);
    } else {
      $stmt = $conn->prepare("UPDATE users SET 
      `isAdmin` = ?
        WHERE `id` = ?");
      $stmt->bind_param("ii", $data->isAdmin, $userId);
      if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Cập nhật quyền hạn thành công"]);
      } else {
        echo json_encode(["success" => true, "message" => $stmt->error]);
      }
      $stmt->close();
    }
  } else {
    echo json_encode(["success" => false, "message" => "Lỗi database"]);
  }
}