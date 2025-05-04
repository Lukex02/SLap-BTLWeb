<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang liên hệ</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/tranglienhe.css" />
  <link rel="stylesheet" href="/css/breadcrumb.css" />
</head>
<body>
  <?php include "navbar.html"; ?>
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item active">Liên hệ</li>
      </ol>
    </nav>

    <h2>Gửi tin nhắn cho chúng tôi</h2>

    <!-- Hiển thị thông báo -->
    <?php if (isset($_GET['status'])): ?>
      <div
        class="alert <?php echo $_GET['status'] === 'success' ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show"
        role="alert">
        <?php
        if ($_GET['status'] === 'success') {
          echo "Đã gửi liên hệ thành công!";
        } else {
          echo htmlspecialchars(urldecode($_GET['message']));
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="contact-form">
      <form action="/server/process_contact.php" method="POST">
        <input type="text" name="full_name" placeholder="Họ tên*" required />
        <input type="email" name="email" placeholder="Email*" required />
        <input type="tel" name="phone" placeholder="Điện thoại*" required />
        <input type="text" name="address" placeholder="Địa chỉ*" required />
        <textarea name="message" placeholder="Nhập nội dung*" required></textarea>
        <button type="submit">Gửi liên hệ</button>
      </form>

      <div class="contact-info">
        <div class="info-item">
          <img src="../pic/placeholder.png" class="icon" alt="Địa chỉ" />
          <div>
            <strong>Địa chỉ</strong><br />
            123 Đường ABC, Phường XYZ, Quận 1, TP.HCM
          </div>
        </div>

        <div class="info-item">
          <img src="../pic/phone-call.png" class="icon" alt="Điện thoại" />
          <div>
            <strong>Điện thoại</strong><br />
            09xxxxxxx
          </div>
        </div>

        <div class="info-item">
          <img src="../pic/message.png" class="icon" alt="Email" />
          <div>
            <strong>Email</strong><br />
            contact@example.com
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include "footer.html" ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>