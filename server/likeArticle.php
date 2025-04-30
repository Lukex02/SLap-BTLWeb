<?php
include "import.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int) $_POST['id'] ?? null;
  $id = $conn->real_escape_string($id);

  $like = "UPDATE articles SET likes = likes + 1 WHERE id = $id";
  $result = $conn->query($like);

  echo "Bạn đã thích bài viết";
  $conn->close();
}