<?php
include "import.php";

header("Content-Type: application/json"); // Định dạng JSON

$slug = isset($_GET["slug"]) ? $_GET["slug"] : "";
$slug = $conn->real_escape_string($slug);

$get_product = "SELECT articles.*,
                        articles.content AS article_content,
                        comments.id AS comment_id,
                        comments.content AS comment_content,
                        comments.created_at AS comment_created_at,
                        (SELECT COUNT(*) FROM comments WHERE comments.article_id = articles.id) AS comments_count,
                        users.id AS user_id,
                        users.username AS commenter_name
                FROM articles
                LEFT JOIN comments ON articles.id = comments.article_id
                LEFT JOIN users ON comments.user_id = users.id
                WHERE articles.slug = '$slug'";

$result = $conn->query($get_product);

$article = null;
$comments = [];

while ($row = mysqli_fetch_assoc($result)) {
    if ($article === null) {
        $article = [
            'id' => $row['id'],
            'title' => $row['title'],
            'slug' => $row['slug'],
            'author_name' => $row['author_name'],
            'author_avatar' => $row['author_avatar'],
            'category' => $row['category'],
            'tags' => $row['tags'],
            'published_at' => $row['published_at'],
            'updated_at' => $row['updated_at'],
            'content' => $row['article_content'],
            'thumbnail' => $row['thumbnail'],
            'excerpt' => $row['excerpt'],
            'views' => $row['views'],
            'likes' => $row['likes'],
            'comments_count' => $row['comments_count'],
        ];
    }

    if ($row['comment_id'] !== null) {
        $comments[] = [
            'id' => $row['comment_id'],
            'content' => $row['comment_content'],
            'created_at' => $row['comment_created_at'],
            'user_id' => $row['user_id'],
            'commenter_name' => $row['commenter_name']
        ];
    }

}

echo json_encode(["article" => $article, "comments" => $comments]);
$conn->close();
?>