// Giả lập dữ liệu người dùng từ database
const userData = {
  id: 1,
  name: "Nguyễn Văn A",
  email: "nguyenvana@example.com",
  password: "mysecretpassword123",
};

// Khởi tạo trang
document.addEventListener("DOMContentLoaded", function () {
  // Hiển thị thông tin người dùng
  document.getElementById("name").value = userData.name;
  document.getElementById("email").value = userData.email;
  document.getElementById("password").value = "••••••••";

  // Xử lý nút chỉnh sửa thông tin
  const editInfoBtn = document.getElementById("editInfoBtn");
  editInfoBtn.addEventListener("click", enableEditing);

  // Xử lý nút hủy bỏ
  const cancelEditBtn = document.getElementById("cancelEditBtn");
  cancelEditBtn.addEventListener("click", disableEditing);

  // Xử lý toggle password
  const togglePasswordBtn = document.getElementById("togglePassword");
  togglePasswordBtn.addEventListener("click", togglePasswordVisibility);

  // Xử lý submit form
  const userForm = document.getElementById("userInfoForm");
  userForm.addEventListener("submit", handleFormSubmit);

  // Xử lý đăng xuất
  document.getElementById("logoutBtn").addEventListener("click", function () {
    if (confirm("Bạn có chắc chắn muốn đăng xuất?")) {
      alert("Đăng xuất thành công!");
      window.location.href = "login.html";
    }
  });
});

// Bật chế độ chỉnh sửa
function enableEditing() {
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const editBtn = document.getElementById("editInfoBtn");
  const saveBtn = document.getElementById("saveInfoBtn");
  const cancelBtn = document.getElementById("cancelEditBtn");

  // Cho phép chỉnh sửa các trường
  nameInput.readOnly = false;
  emailInput.readOnly = false;
  passwordInput.readOnly = false;

  // Hiển thị mật khẩu thật khi vào chế độ chỉnh sửa
  passwordInput.value = userData.password;
  passwordInput.type = "text";

  // Thêm style để người dùng biết có thể chỉnh sửa
  nameInput.style.backgroundColor = "white";
  nameInput.style.border = "1px solid #ddd";
  emailInput.style.backgroundColor = "white";
  emailInput.style.border = "1px solid #ddd";
  passwordInput.style.backgroundColor = "white";
  passwordInput.style.border = "1px solid #ddd";

  // Hiển thị nút Lưu/Hủy và ẩn nút Chỉnh sửa
  editBtn.classList.add("hidden");
  saveBtn.classList.remove("hidden");
  cancelBtn.classList.remove("hidden");
}

// Tắt chế độ chỉnh sửa
function disableEditing() {
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const editBtn = document.getElementById("editInfoBtn");
  const saveBtn = document.getElementById("saveInfoBtn");
  const cancelBtn = document.getElementById("cancelEditBtn");

  // Khôi phục giá trị ban đầu
  nameInput.value = userData.name;
  emailInput.value = userData.email;
  passwordInput.value = "••••••••";
  passwordInput.type = "password";

  // Khóa các trường input
  nameInput.readOnly = true;
  emailInput.readOnly = true;
  passwordInput.readOnly = true;

  // Xóa style chỉnh sửa
  nameInput.style.backgroundColor = "transparent";
  nameInput.style.border = "none";
  emailInput.style.backgroundColor = "transparent";
  emailInput.style.border = "none";
  passwordInput.style.backgroundColor = "transparent";
  passwordInput.style.border = "none";

  // Hiển thị nút Chỉnh sửa và ẩn nút Lưu/Hủy
  editBtn.classList.remove("hidden");
  saveBtn.classList.add("hidden");
  cancelBtn.classList.add("hidden");
}

// Hiển thị/ẩn mật khẩu
function togglePasswordVisibility() {
  const passwordInput = document.getElementById("password");
  const eyeIcon = document.querySelector(".toggle-password i");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeIcon.classList.replace("fa-eye", "fa-eye-slash");

    // Nếu ở chế độ xem, hiển thị mật khẩu thật
    if (passwordInput.readOnly) {
      passwordInput.value = userData.password;
    }
  } else {
    passwordInput.type = "password";
    eyeIcon.classList.replace("fa-eye-slash", "fa-eye");

    // Nếu ở chế độ xem, hiển thị dấu sao
    if (passwordInput.readOnly) {
      passwordInput.value = "••••••••";
    }
  }
}

// Xử lý submit form
function handleFormSubmit(e) {
  e.preventDefault();

  // Lấy dữ liệu từ form
  const formData = {
    name: document.getElementById("name").value,
    email: document.getElementById("email").value,
    password: document.getElementById("password").value,
  };

  // Validate dữ liệu
  if (!formData.name || !formData.email || !formData.password) {
    alert("Vui lòng điền đầy đủ thông tin!");
    return;
  }

  if (formData.password.length < 6) {
    alert("Mật khẩu phải có ít nhất 6 ký tự!");
    return;
  }

  // Giả lập gửi dữ liệu lên server
  console.log("Dữ liệu cập nhật:", formData);

  // Cập nhật lại dữ liệu người dùng (trong thực tế sẽ nhận từ server)
  userData.name = formData.name;
  userData.email = formData.email;
  userData.password = formData.password;

  // Tắt chế độ chỉnh sửa
  disableEditing();

  // Hiển thị thông báo
  alert("Cập nhật thông tin thành công!");
}
