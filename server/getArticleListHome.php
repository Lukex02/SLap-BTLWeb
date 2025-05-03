<?php
include "import.php";
header("Content-Type: application/json");
$sql = "SELECT * FROM articles WHERE is_visible = 1 ORDER BY id DESC";
$result = $conn->query($sql);
$articles = [];
while ($row = $result->fetch_assoc()) {
    $articles[] = $row;
}
echo json_encode($articles);
$conn->close();
?>