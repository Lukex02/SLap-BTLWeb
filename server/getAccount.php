<?php
include "import.php";

header("Content-Type: application/json"); // Định dạng JSON

$get_account = "SELECT * FROM users";
$result = $conn->query($get_account);

$data = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
} else {
  echo json_encode(["success" => false, "message" => "Không có dữ liệu!"]);
}

echo json_encode(["success" => true, "accounts" => $data]);
$conn->close();