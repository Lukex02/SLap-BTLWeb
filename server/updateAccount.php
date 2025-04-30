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

    if ($data->isAdmin == 1) {
      // Đảo ngược trạng thái admin
      $isAdminCurr = $row["isAdmin"];
      $stmt = $conn->prepare("UPDATE users SET 
      `isAdmin` = ?
        WHERE `id` = ?");
      $changeAdmin = !boolval($isAdminCurr);
      $stmt->bind_param("ii", $changeAdmin, $userId);
    } else if ($data->isLock == 1) {
      // Đảo ngược trạng thái khóa
      $isLockCurr = $row["isLock"];
      $stmt = $conn->prepare("UPDATE users SET 
      `isLock` = ?
        WHERE `id` = ?");
      $changeLock = !boolval($isLockCurr);
      $stmt->bind_param("ii", $changeLock, $userId);
    } else {
      // Reset password
      $stmt = $conn->prepare("UPDATE users SET 
      `password` = ?
        WHERE `id` = ?");
      $newPass = password_hash("123456", PASSWORD_DEFAULT);
      $stmt->bind_param("si", $newPass, $userId);
    }

    if ($stmt->execute()) {
      echo json_encode(["success" => true, "message" => "Cập nhật quyền hạn thành công"]);
    } else {
      echo json_encode(["success" => true, "message" => $stmt->error]);
      $stmt->close();
    }
  } else {
    echo json_encode(["success" => false, "message" => "Lỗi database"]);
  }
}