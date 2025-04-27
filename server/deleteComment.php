<?php
require_once "import.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $json_data = file_get_contents('php://input');

  // Decode the JSON data into a PHP associative array or object
  $data = json_decode($json_data, true);
  if ($data !== null && isset($data['comment_ids'])) {
    // Access the 'comment_ids' array
    $comment_ids = $data['comment_ids'];

    $sanitizedIds = array_map('intval', $comment_ids);
    if (!empty($sanitizedIds)) {
      $inClause = implode(',', $sanitizedIds);
      $delete_comment_sql = "DELETE FROM comments WHERE id IN ($inClause)";
      if ($conn->query($delete_comment_sql) === TRUE) {
        echo "Đã xóa thành công " . $conn->affected_rows . " comment.";
      } else {
        echo "Lỗi xóa comment: " . $conn->error;
      }
    } else {
      echo "Không có chọn comment để xóa";
    }
  }
}