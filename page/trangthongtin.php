<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>THÔNG TIN NGƯỜI DÙNG</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="../css/trangthongtin.css" />

</head>

<body>
  <!-- Navigation -->
  <?php include "navbar.html" ?>

  <div class="container">
    <!-- Breadcrumb navigation -->
    <nav class="breadcrumb-nav">
      <ul>
        <li><a href="../page/trangchu.html">Trang chủ</a></li>
        <li>Thông tin người dùng</li>
      </ul>
    </nav>

    <h2>Thông tin cá nhân</h2>

    <div class="profile-container">
      <!-- Form thông tin người dùng -->
      <form class="user-info-form" id="userInfoForm">
        <div class="form-group">
          <label for="name">Họ và tên</label>
          <input type="text" id="name" name="name" readonly />
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" readonly />
        </div>

        <div class="form-group password-group">
          <label for="password">Mật khẩu</label>
          <div class="password-input">
            <input type="password" id="password" readonly />
            <button type="button" class="toggle-password" id="togglePassword">
              <i class="fas fa-eye"></i>
            </button>
          </div>
        </div>

        <div class="form-actions" id="formActions">
          <button type="button" class="btn-edit" id="editInfoBtn">Chỉnh sửa thông tin</button>
          <button type="submit" class="btn-save hidden" id="saveInfoBtn">Lưu thay đổi</button>
          <button type="button" class="btn-cancel hidden" id="cancelEditBtn">Hủy bỏ</button>
        </div>
      </form>

      <!-- Các action khác -->
      <div class="user-actions">
        <div class="action-card" id="logoutBtn">
          <div class="action-icon">
            <i class="fas fa-sign-out-alt"></i>
          </div>
          <div class="action-content">
            <h4>Đăng xuất</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/trangthongtin.js"></script>
</body>

</html>