<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TRANG LIÊN HỆ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/tranglienhe.css" />
    <link rel="stylesheet" href="/css/breadcrumb.css" />
  </head>
  <body>
    <?php include "navbar.html" ?>
    <div class="container">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/index.php">Trang chủ</a></li>
          <li class="breadcrumb-item active">Liên hệ</li>
        </ol>
      </nav>

      <h2>Gửi tin nhắn cho chúng tôi</h2>

      <div class="contact-form">
        <form>
          <input type="text" placeholder="Họ tên*" required />
          <input type="email" placeholder="Email*" required />
          <input type="tel" placeholder="Điện thoại*" required />
          <input type="text" placeholder="Địa chỉ*" required />
          <textarea placeholder="Nhập nội dung*" required></textarea>
          <button type="submit">Gửi liên hệ</button>
        </form>

        <div class="contact-info">
          <div class="info-item">
            <img src="../hình ảnh/placeholder.png" class="icon" alt="Địa chỉ" />
            <div>
              <strong>Địa chỉ</strong><br />
              102 Thái Thịnh, Trung Liệt, Đống Đa, Hà Nội
            </div>
          </div>

          <div class="info-item">
            <img
              src="../hình ảnh/phone-call.png"
              class="icon"
              alt="Điện thoại"
            />
            <div>
              <strong>Điện thoại</strong><br />
              09xxxxxxx
            </div>
          </div>

          <div class="info-item">
            <img src="../hình ảnh/message.png" class="icon" alt="Email" />
            <div>
              <strong>Email</strong><br />
              contact@nhanh.vn
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
