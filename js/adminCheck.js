// import { mixin } from "assets/extensions/sweetalert2/sweetalert2.min.js";

const Swal2 = Swal.mixin({
  customClass: {
    input: "form-control",
  },
});

document.addEventListener("DOMContentLoaded", function () {
  fetch("/server/session.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        if (!data.isAdmin) {
          Swal2.fire({
            icon: "error",
            title: "Bạn không có quyền truy cập vào trang này!",
          }).then(() => {
            window.location.href = "/";
          });
          // alert("Bạn không có quyền truy cập vào trang này!");
        }
      } else {
        console.log(data.message);
      }
    });
});
