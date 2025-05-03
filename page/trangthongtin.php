<!DOCTYPE html>
<html lang="vi">


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tài khoản cá nhân</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="/css/trangthongtin.css" />
  <link rel="stylesheet" href="/css/breadcrumb.css" />
</head>

<!-- Navigation -->
<?php include "navbar.html" ?>
<?php session_start() ?>
<body>

  <div class="container">
    <!-- Breadcrumb navigation -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item active">Thông tin cá nhân</li>
      </ol>
    </nav>

    <h2>Thông tin cá nhân</h2>

    <div class="profile-container">
      <!-- Form thông tin người dùng -->
      <form class="user-info-form" id="userInfoForm">
        <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div class="form-group">
          <label for="name">Họ và tên</label>
          <input type="text" id="name" name="name" readonly />
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" readonly />
        </div>

        <div class="form-group password-group hidden" id="old-password-container">
          <label for="password">Nhập lại mật khẩu</label>
          <div class="password-input">
            <input type="password" id="old-password" />
            <button type="button" class="toggle-password visually-hidden" id="toggleOldPassword">
              <i class="fas fa-eye"></i>
            </button>
          </div>
        </div>

        <div class="form-group password-group" id="new-password-container">
          <label for="password">Mật khẩu mới</label>
          <div class="password-input">
            <input type="password" id="password" readonly />
            <button type="button" class="toggle-password visually-hidden" id="toggleNewPassword">
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
      <div class="d-flex justify-content-between flex-column">
        <div class="avatar-container position-relative d-inline-flex" style="height: 10rem; width: 10rem;">
          <img id="avatar" alt="Avatar của bạn" class="rounded-circle">
          <div class="avatar-overlay rounded-circle" id="avatar-overlay">
            Thay đổi avatar
          </div>
          <input type="file" id="input-avatar" class="visually-hidden" accept="image/*" name="avatar">
        </div>
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
  </div>

  <script src="/js/trangthongtin.js"></script>
</body>

</html>