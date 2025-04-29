<?php
session_start();
include "import.php";
header("Content-Type: application/json"); // Định dạng JSON

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
  $loggedInUserId = $_SESSION['user_id'];
  $query = "SELECT 
                c.id AS c_id,
                c.content AS comment_content,
                a.title AS article_title,
                c.id AS comment_id,
                u.username AS commenter_name,
                u.avatar AS commenter_avatar
            FROM comments c
            LEFT JOIN articles a ON c.article_id = a.id
            LEFT JOIN users u ON c.user_id = u.id
            ORDER BY c.created_at DESC
            LIMIT 4;";
  $stmt = $conn->query($query);

  $comments = [];

  while ($row = mysqli_fetch_assoc($stmt)) {
    if ($row['c_id'] !== null) {
      // Thêm mảng comments vào
      $comments[] = [
        'id' => $row['c_id'],
        'content' => $row['comment_content'],
        'commenter_avatar' => $row['commenter_avatar'],
        'commenter_name' => $row['commenter_name'],
        'article_title' => $row['article_title']
      ];
    }
  }

  $query_count = "SELECT
  (SELECT COUNT(*) FROM comments) AS comments_count,
  (SELECT COUNT(*) FROM articles) AS articles_count,
  (SELECT COUNT(*) FROM users) AS users_count,
  (SELECT COUNT(*) FROM products) AS products_count;
  ";
  $stmt = $conn->query($query_count);

  while ($row = mysqli_fetch_assoc($stmt)) {
    $comments_count = $row["comments_count"];
    $articles_count = $row["articles_count"];
    $users_count = $row["users_count"];
    $products_count = $row["products_count"];
  }

  echo json_encode([
    "success" => true,
    "comments" => $comments,
    "comments_count" => (int) $comments_count,
    "articles_count" => (int) $articles_count,
    "users_count" => (int) $users_count,
    "products_count" => (int) $products_count
  ]);
  $conn->close();
}