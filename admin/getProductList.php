<?php
include "import.php";

header("Content-Type: application/json"); // Định dạng JSON

$get_all = "SELECT * FROM products";
$result = $conn->query($get_all);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo json_encode(["message" => "Không có dữ liệu!"]);
}

echo json_encode($data);
$conn->close();
?>
