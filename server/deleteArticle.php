<?php
include "import.php";
$id = isset($_GET["id"]) ? (int) $_GET["id"] : null;
$id = $conn->real_escape_string($id);

if ($id != null) {
  // header("Content-Type: application/json"); // Định dạng JSON
  $sql_get_thumbnail = "SELECT thumbnail FROM articles WHERE id = ?";
  $stmt = $conn->prepare($sql_get_thumbnail);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if ($row['thumbnail'] != "/pic/prop_laptop.jpg" && file_exists(".." . $row['thumbnail'])) {
      if (unlink(".." . $row['thumbnail'])) {
        echo "Đã xóa ảnh cũ thành công.\n";
      } else {
        echo "Không thể xóa file.\n";
      }
    } else {
      echo "Không có link ảnh cũ\n";
    }
  }

  $sql = "DELETE FROM articles WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $comment_sql = "DELETE FROM comments WHERE article_id = ?";
  $stmt = $conn->prepare($comment_sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  echo "OK";
}

$conn->close();
?>