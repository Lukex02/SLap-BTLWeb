// Khởi tạo trang
var userData = {
  name: "",
  email: "",
  password: "••••••••",
};
document.addEventListener("DOMContentLoaded", function () {
  // Hiển thị thông tin người dùng
  fetch("/server/session.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        document.getElementById("name").value = data.username;
        document.getElementById("email").value = data.email;
        document.getElementById("password").value = "••••••••";
        document.getElementById("avatar").src = data.avatar;
        userData = { name: data.username, email: data.email };
      } else {
        console.log(data.message);
      }
    });

  // Xử lý tải avatar
  const inputAvatar = document.getElementById("input-avatar");
  document.getElementById("avatar-overlay").addEventListener("click", () => {
    inputAvatar.click();
  });
  inputAvatar.addEventListener("change", function () {
    if (this.files && this.files[0]) {
      const formData = new FormData();
      formData.append("avatar", this.files[0]);
      fetch("/server/updateAvatar.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert(data.message);
          } else {
            alert(data.message);
          }
        })
        .catch((error) => console.error("Lỗi tải dữ liệu:", error));
    }
  });

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
  document.getElementById("logoutBtn").addEventListener("click", () => {
    if (confirm("Bạn có chắc chắn muốn đăng xuất?")) {
      fetch("/server/logout.php")
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert(data.message);
            window.location.href = "/";
          } else {
            alert(data.message);
          }
        })
        .catch((error) => console.error("Lỗi đăng xuất:", error));
    }
  });
});

// Bật chế độ chỉnh sửa
function enableEditing() {
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const oldPasswordInputContainer = document.getElementById("old-password-container");
  const oldPasswordInput = document.getElementById("old-password");
  const passwordInput = document.getElementById("password");
  const editBtn = document.getElementById("editInfoBtn");
  const saveBtn = document.getElementById("saveInfoBtn");
  const cancelBtn = document.getElementById("cancelEditBtn");

  // Cho phép chỉnh sửa các trường
  nameInput.readOnly = false;
  emailInput.readOnly = false;
  passwordInput.readOnly = false;

  oldPasswordInput.value = "";
  passwordInput.value = null;
  passwordInput.type = "password";

  // Thêm style để người dùng biết có thể chỉnh sửa
  oldPasswordInput.style.backgroundColor = "white";
  oldPasswordInput.style.border = "1px solid #ddd";
  nameInput.style.backgroundColor = "white";
  nameInput.style.border = "1px solid #ddd";
  emailInput.style.backgroundColor = "white";
  emailInput.style.border = "1px solid #ddd";
  passwordInput.style.backgroundColor = "white";
  passwordInput.style.border = "1px solid #ddd";

  // Hiển thị nút Lưu/Hủy và ẩn nút Chỉnh sửa
  oldPasswordInputContainer.classList.remove("hidden");
  editBtn.classList.add("hidden");
  saveBtn.classList.remove("hidden");
  cancelBtn.classList.remove("hidden");
}

// Tắt chế độ chỉnh sửa
function disableEditing() {
  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const oldPasswordInputContainer = document.getElementById("old-password-container");
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
  oldPasswordInputContainer.classList.add("hidden");
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
      passwordInput.value = "hashedPass";
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
    oldPassword: document.getElementById("old-password").value,
    password: document.getElementById("password").value,
  };

  // Validate dữ liệu
  if (!formData.name || !formData.email || !formData.oldPassword) {
    alert("Vui lòng điền đầy đủ thông tin!");
    return;
  }

  if (formData.password && formData.password.length < 6) {
    alert("Mật khẩu phải có ít nhất 6 ký tự!");
    return;
  }

  fetch("/server/updateUser.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      username: formData.name,
      email: formData.email,
      oldPassword: formData.oldPassword,
      password: formData.password ? formData.password : null,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      // console.log(data);
      if (data.success) {
        alert(data.message);
        // Tắt chế độ chỉnh sửa
        disableEditing();
        window.location.reload();
      } else {
        alert(data.message);
      }
    });
}
