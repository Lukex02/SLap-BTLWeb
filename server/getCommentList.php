<?php
include "import.php";

header("Content-Type: application/json"); // Định dạng JSON

$get_comments = "SELECT comments.*,
                        articles.title AS article_title,
                        articles.id AS article_id,
                        comments.id AS comment_id,
                        comments.content AS comment_content,
                        comments.created_at AS comment_created_at,
                        (SELECT COUNT(*) FROM comments WHERE comments.article_id = articles.id) AS comments_count,
                        users.id AS user_id,
                        users.avatar AS commenter_avatar,
                        users.username AS commenter_name
                FROM comments
                LEFT JOIN articles ON comments.article_id = articles.id 
                LEFT JOIN users ON comments.user_id = users.id
                ORDER BY comments.article_id, comment_created_at DESC";

$result = $conn->query($get_comments);

$comments = [];

while ($row = mysqli_fetch_assoc($result)) {
  if ($row['id'] !== null) {
    $articleId = $row['article_id']; // Lấy ID của bài viết

    if (!isset($comments[$articleId])) {
      $comments[$articleId] = [
        'article_title' => $row['article_title']
      ];
    }

    // Thêm mảng comments vào
    $comments[$articleId]['comments'][] = [
      'id' => $row['id'],
      'content' => $row['comment_content'],
      'created_at' => $row['comment_created_at'],
      'user_id' => $row['user_id'],
      'commenter_avatar' => $row['commenter_avatar'],
      'commenter_name' => $row['commenter_name']
    ];
  }

}

echo json_encode($comments);
$conn->close();
?>
