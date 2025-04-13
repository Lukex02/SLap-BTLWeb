<?php
include "import.php";

header("Content-Type: application/json"); // Định dạng JSON

$name = isset($_GET["name"]) ? $_GET["name"] : "";
$name = $conn->real_escape_string($name);

$get_product = "SELECT * FROM products WHERE name = '$name'";
$result = $conn->query($get_product);

$data = $result->fetch_assoc() ?? ["error" => "Không tìm thấy sản phẩm"];

echo json_encode($data);
$conn->close();
?>
