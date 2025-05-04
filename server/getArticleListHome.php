<?php
include "import.php";
header("Content-Type: application/json");
$sql = "SELECT * FROM articles WHERE is_visible = 1 ORDER BY id DESC";
$result = $conn->query($sql);
if (!$result) {
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(['error' => 'Database query failed: ' . $conn->error]);
    $conn->close();
    exit;
}
$articles = [];
while ($row = $result->fetch_assoc()) {
    $articles[] = $row;
}
echo json_encode($articles);
$conn->close();
?>