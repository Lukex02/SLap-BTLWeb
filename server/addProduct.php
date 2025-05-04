<?php
include "import.php";

header('Content-Type: application/json');

// Get product data from POST
$name = $conn->real_escape_string($_POST['name']);
$brand = $conn->real_escape_string($_POST['brand']);
$price = $conn->real_escape_string($_POST['price']);
$cpu = $conn->real_escape_string($_POST['cpu']);
$ram = $conn->real_escape_string($_POST['ram']);
$screen = $conn->real_escape_string($_POST['screen']);
$gpu = $conn->real_escape_string($_POST['gpu']);
$image = empty($_POST['image-old']) ? "/pic/prop_laptop.jpg" : (string) $_POST['image-old'];
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];

    // Lấy đuôi file
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Danh sách định dạng cho phép
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExtension, $allowedExtensions)) {
        // Tạo tên mới để tránh trùng
        $newFileName = uniqid("product_", true) . '.' . $fileExtension;

        // Đường dẫn lưu file
        $destPath = '/pic/' . $newFileName;

        // Di chuyển file tạm sang thư mục đích
        if (move_uploaded_file($fileTmpPath, '..' . $destPath)) {
            if ($image != "/pic/prop_laptop.jpg" && file_exists(".." . $image)) {
                if (unlink(".." . $image)) {
                }
            }
            // echo "Tải ảnh thành công! Đường dẫn: $destPath \n";
            $image = $destPath;
        }
    }
}

// Validate required fields
if (empty($name) || empty($brand) || empty($price)) {
    echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin cần thiết']);
    exit;
}

// Insert product into database
$sql = "INSERT INTO products (name, brand, price, cpu, ram, screen, gpu, image) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssss", $name, $brand, $price, $cpu, $ram, $screen, $gpu, $image);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Thêm sản phẩm thành công']);
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi thêm sản phẩm: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>