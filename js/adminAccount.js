document.addEventListener("DOMContentLoaded", function () {
  fetch("/server/getAccount.php")
    .then((response) => response.json())
    .then((data) => {
      const accountTable = document.getElementById("table1").getElementsByTagName("tbody")[0];
      accountTable.innerHTML = data.accounts
        .map(
          (account) => `
          <tr>
            <td>${account.username}</td>
            <td>${account.email}</td>
            <td id="isAdmin-${account.id}">${account.isAdmin == 1 ? "Admin" : "User"}</td>
            <td>
              <button class="btn btn-danger delete-btn" id="delete-btn-${account.id}">
                <i class="bi bi-trash"></i>
                Xóa
              </button>
            </td>
            <td>
              <button class="btn btn-warning text-nowrap admin-btn" id="admin-btn-${account.id}">
                <i class="bi bi-person-fill-lock"></i>
                ${account.isAdmin == 0 ? "Cấp quyền Admin" : "Hủy quyền Admin"}
              </button>
            </td>
          </tr>
        `,
        )
        .join("");

      document.querySelectorAll(".delete-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
          const accountId = this.id.split("-")[2];
          Swal.fire({
            title: "Bạn có chắc chắn muốn xóa tài khoản này không?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Không",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Có",
          }).then((result) => {
            if (result.isConfirmed) {
              fetch("/server/deleteAccount.php", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
                body: JSON.stringify({
                  account_id: accountId,
                }),
              })
                .then((response) => response.json())
                .then((data) => {
                  if (data.success) {
                    Swal.fire({
                      title: "Xóa tài khoản thành công!",
                      icon: "success",
                      showCancelButton: false,
                      confirmButtonColor: "#3085d6",
                      confirmButtonText: "Đồng ý",
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.reload();
                      }
                    });
                  } else {
                    Swal.fire({
                      title: "Xóa tài khoản thất bại!",
                      icon: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#3085d6",
                      confirmButtonText: "Đồng ý",
                    });
                  }
                })
                .catch((error) => console.error("Lỗi xóa tài khoản:", error));
            }
          });
        });
      });

      const adminBtns = document.querySelectorAll(".admin-btn");
      adminBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
          const accountId = this.id.split("-")[2];
          const isAdmin = document.getElementById(`isAdmin-${accountId}`).innerHTML;
          fetch("/server/updateAccount.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              account_id: accountId,
              isAdmin: isAdmin == "User" ? 1 : 0,
            }),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                Swal.fire({
                  title: `${isAdmin == "User" ? "Cấp quyền" : "Hủy quyền"} Admin thành công!`,
                  icon: "success",
                  showCancelButton: false,
                  confirmButtonColor: "#3085d6",
                  confirmButtonText: "Đồng ý",
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.reload();
                  }
                });
              } else {
                Swal.fire({
                  title: `${isAdmin == "User" ? "Cấp quyền" : "Hủy quyền"} Admin thất bại!`,
                  icon: "error",
                  showCancelButton: false,
                  confirmButtonColor: "#3085d6",
                  confirmButtonText: "Đồng ý",
                });
              }
            })
            .catch((error) => console.error("Lỗi cấp quyền Admin:", error));
        });
      });
    });
});
