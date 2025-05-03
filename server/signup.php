<?php
require_once "import.php";
session_start();
header("Content-Type: application/json"); // Định dạng JSON
$json_data = file_get_contents('php://input');
$data = json_decode($json_data);

$username = $data->username;
$email = $data->email;
$password = $data->password;

if ($username && $email && $password) {
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email đã tồn tại"]);
  } else {
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, avatar) VALUES (?, ?, ?, ?)");
    $avatar = "/pic/def_author_avatar.png";
    $encryptPass = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("ssss", $username, $email, $encryptPass, $avatar);
    $stmt->execute();
    $user_id = $conn->insert_id;

    $sessionID = session_id();

    // Setup cookies
    $token = bin2hex(random_bytes(16));
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
      "user_id" => $user_id,
      "username" => $username,
      "avatar" => $avatar,
      "token" => $token,
    ]);
  }
}