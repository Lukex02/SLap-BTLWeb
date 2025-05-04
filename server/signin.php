<?php
require_once "import.php";
session_start();
header("Content-Type: application/json"); // Định dạng JSON
$json_data = file_get_contents('php://input');
$data = json_decode($json_data);

$email = $data->email;
$password = $data->password;

if ($email && $password) {
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
      $user_id = $row["id"];
      $username = $row["username"];
      $avatar = $row["avatar"];

      $sessionID = session_id();

      // Setup cookies
      $expire = time() + 86400; // Thời hạn 1 ngày
      $path = '/';
      $domain = $_SERVER['HTTP_HOST'];
      $secure = true; // Chỉ gửi qua HTTPS
      $httponly = true; // Ngăn JavaScript truy cập
      setcookie(session_name(), $sessionID, $expire, $path, $domain, $secure, $httponly);

        // Setup session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['loggedin'] = true;

      echo json_encode([
        "success" => true,
        "message" => "Đăng nhập thành công"
      ]);
    } else {
      echo json_encode(["success" => false, "message" => "Email hoặc mật khẩu không chính xác"]);
    }
  } else {
    echo json_encode(["success" => false, "message" => "Email không tồn tại"]);
  }

}