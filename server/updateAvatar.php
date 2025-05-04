<?php
session_start();
require "import.php";
header("Content-Type: application/json"); // Định dạng JSON

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    echo json_encode(["success" => false, "message" => "Token CSRF không hợp lệ"]);
    exit;
  }
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_id'])) {
  $loggedInUserId = $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT avatar FROM users WHERE id = ?");
  $stmt->bind_param("i", $loggedInUserId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $oldAvatarPath = $row['avatar']; // Lấy đường dẫn avatar cũ

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
      $fileTmpPath = $_FILES['avatar']['tmp_name'];
      $fileName = $_FILES['avatar']['name'];
      $fileSize = $_FILES['avatar']['size'];
      $fileType = $_FILES['avatar']['type'];

      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
      $maxFileSize = 2 * 1024 * 1024; // 2MB

      if (!in_array($fileExtension, $allowedExtensions)) {
        echo json_encode(["success" => false, "message" => "Chỉ chấp nhận các định dạng: " . implode(", ", $allowedExtensions)]);
        exit();
      }

      if ($fileSize > $maxFileSize) {
        echo json_encode(["success" => false, "message" => "Kích thước file quá lớn. Vui lòng tải file dưới " . ($maxFileSize / (1024 * 1024)) . "MB."]);
        exit();
      }

      // Kiểm tra MIME type (an toàn hơn)
      $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
      if (!in_array($fileType, $allowedMimeTypes)) {
        echo json_encode(["success" => false, "message" => "Loại file không hợp lệ."]);
        exit();
      }

      $newFileName = $loggedInUserId . uniqid('_ava_', true) . '.' . $fileExtension;
      $destPath = '/pic/' . $newFileName; // Đảm bảo thư mục /pic/ có quyền ghi

      if (move_uploaded_file($fileTmpPath, '..' . $destPath)) {
        // Xóa ảnh cũ nếu không phải là mặc định và tồn tại
        if ($oldAvatarPath != "/pic/def_author_avatar.png" && !empty($oldAvatarPath) && file_exists(".." . $oldAvatarPath)) {
          if (!unlink(".." . $oldAvatarPath)) {
            echo json_encode(["success" => false, "message" => "Không thể xóa file ảnh cũ."]);
            exit();
          }
        }

        $stmt = $conn->prepare("UPDATE users SET `avatar` = ? WHERE `id` = ?");
        $stmt->bind_param("si", $destPath, $loggedInUserId);
        if ($stmt->execute()) {
          echo json_encode(["success" => true, "message" => "Cập nhật avatar thành công", "newAvatar" => $destPath]);
        } else {
          echo json_encode(["success" => false, "message" => "Lỗi cập nhật database: " . $stmt->error]);
        }
        $stmt->close();

      } else {
        echo json_encode(["success" => false, "message" => "Không thể di chuyển file. Lỗi: " . json_encode(error_get_last())]);
      }

    } else {
      echo json_encode(["success" => false, "message" => "Chưa chọn file hoặc file lỗi: " . $_FILES['avatar']['error']]);
    }

  } else {
    echo json_encode(["success" => false, "message" => "Lỗi truy vấn thông tin người dùng."]);
  }
} else {
  echo json_encode(["success" => false, "message" => "Người dùng chưa đăng nhập."]);
}
?>