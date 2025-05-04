<?php
include "import.php";
header("Content-Type: application/json");
$sql = "SELECT * FROM products WHERE is_visible = 1 ORDER BY id DESC";
$result = $conn->query($sql);
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
echo json_encode($products);
$conn->close();
?>