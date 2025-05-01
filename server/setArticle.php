<?php
include "import.php";
header("Content-Type: application/json"); // Định dạng JSON

function slugify($string)
{
  $string = preg_replace(
    [
      '/[áàảãạăắằẳẵặâấầẩẫậ]/u',
      '/[ÁÀẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬ]/u',
      '/[éèẻẽẹêếềểễệ]/u',
      '/[ÉÈẺẼẸÊẾỀỂỄỆ]/u',
      '/[íìỉĩị]/u',
      '/[ÍÌỈĨỊ]/u',
      '/[óòỏõọôốồổỗộơớờởỡợ]/u',
      '/[ÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢ]/u',
      '/[úùủũụưứừửữự]/u',
      '/[ÚÙỦŨỤƯỨỪỬỮỰ]/u',
      '/[ýỳỷỹỵ]/u',
      '/[ÝỲỶỸỴ]/u',
      '/đ/u',
      '/Đ/u'
    ],
    [
      'a',
      'A',
      'e',
      'E',
      'i',
      'I',
      'o',
      'O',
      'u',
      'U',
      'y',
      'Y',
      'd',
      'D'
    ],
    $string
  );
  $slug = strtolower($string);
  $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
  $slug = preg_replace('/-+/', '-', $slug);
  $slug = trim($slug, '-');
  return $slug;
}
// POST nếu như lưu bài viết mới hoặc ghi đè bài viết cũ
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = (int) $_POST['article-id'] ?? null;
  $title = $_POST['title'];
  $slug = slugify($title);
  $authorName = empty($_POST['author']) ? "Ẩn danh" : $_POST['author'];
  $authorAvatar = "/pic/def_author_ava.jpg";
  $category = $_POST['category'] ?? "";
  $tags = $_POST['tags'] ?? "";
  $publishedAt = gmdate("Y-m-d H:i:s", time());
  $updatedAt = gmdate("Y-m-d H:i:s", time());
  $excerpt = $_POST['excerpt'] ?? "";
  $likes = 0; // Vì chỉ dùng khi Insert nên để 0 luôn
  $content = $_POST['tinymce_content'] ?? "";
  $thumbnail = empty($_POST['thumbnail-old']) ? "/pic/prop_laptop.jpg" : (string) $_POST['thumbnail-old'];

  if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
    $fileName = $_FILES['thumbnail']['name'];
    // $fileSize = $_FILES['thumbnail']['size'];
    // $fileType = $_FILES['thumbnail']['type'];

    // Lấy đuôi file
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Danh sách định dạng cho phép
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileExtension, $allowedExtensions)) {
      // Tạo tên mới để tránh trùng
      $newFileName = uniqid('img_', true) . '.' . $fileExtension;

      // Đường dẫn lưu file
      $destPath = '/pic/' . $newFileName;

      // Di chuyển file tạm sang thư mục đích
      if (move_uploaded_file($fileTmpPath, '..' . $destPath)) {
        if ($thumbnail != "/pic/prop_laptop.jpg" && file_exists(".." . $thumbnail)) {
          if (unlink(".." . $thumbnail)) {
            echo "Đã xóa ảnh cũ thành công.\n";
          } else {
            echo "Không thể xóa file.\n";
          }
        } else {
          echo "Không có link ảnh cũ\n";
        }
        // echo "Tải ảnh thành công! Đường dẫn: $destPath \n";
        $thumbnail = $destPath;
      } else {
        echo "Không thể di chuyển file.";
      }
    } else {
      echo "Chỉ chấp nhận các định dạng: " . implode(", ", $allowedExtensions);
    }
  } else {
    echo "Chưa chọn file hoặc file lỗi.";
  }
  // Đăng bài mới
  $sql = "INSERT INTO articles (`title`, `slug`, `author_name`, `author_avatar`, `category`, `tags`, `published_at`, `updated_at`, `content`, `excerpt`, `thumbnail`, `likes`) VALUES
    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $types = "sssssssssssi";

  if ($id) {
    // Cập nhật bài cũ
    $types = "sssssssssi";
    $sql = "UPDATE articles SET 
  `title` = ?, 
  `slug` = ?,
  `author_name` = ?, 
  `category` = ?, 
  `tags` = ?, 
  `updated_at` = ?, 
  `content` = ?, 
  `excerpt` = ?, 
  `thumbnail` = ?
    WHERE `id` = ?";
    // echo "Add update sql";
  }
  $stmt = $conn->prepare($sql);
  if ($stmt) {
    if ($id) {
      // echo "Update! ";
      $stmt->bind_param($types, $title, $slug, $authorName, $category, $tags, $updatedAt, $content, $excerpt, $thumbnail, $id);
    } else {
      // echo "New ";
      $stmt->bind_param($types, $title, $slug, $authorName, $authorAvatar, $category, $tags, $publishedAt, $updatedAt, $content, $excerpt, $thumbnail, $views, $likes);
    }
    if ($stmt->execute()) {
      echo "Nội dung đã được lưu thành công vào cơ sở dữ liệu.<br>";
    } else {
      echo "Lỗi khi lưu nội dung vào cơ sở dữ liệu: " . $stmt->error . "<br>";
    }

    $stmt->close();
  } else {
    echo "Lỗi chuẩn bị câu truy vấn: " . $conn->error . "<br>";
  }

  $conn->close();
}

?>