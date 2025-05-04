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
            <td>${account.isAdmin == 1 ? "Admin" : "User"}</td>
            <td>
              <button class="btn btn-warning text-nowrap admin-btn w-100" id="admin-btn-${account.id}">
                <i class="bi bi-person-fill-lock"></i>
                ${account.isAdmin == 0 ? "Cấp quyền Admin" : "Hủy quyền Admin"}
              </button>
            </td>
            <td>
              <button class="btn btn-primary text-nowrap reset-btn w-100" id="reset-btn-${account.id}">
                <i class="bi bi-key-fill"></i>
                Reset password
              </button>
            </td>
            <td>
              <button class="btn btn-info text-nowrap lock-btn w-100" id="lock-btn-${account.id}">
                <i class="bi bi-${account.isLock == 0 ? "" : "un"}lock-fill"></i>
                ${account.isLock == 0 ? "Khóa " : "Mở"}
              </button>
            </td>
            <td>
              <button class="btn btn-danger text-nowrap delete-btn w-100" id="delete-btn-${account.id}">
                <i class="bi bi-trash"></i>
                Xóa
              </button>
            </td>
          </tr>
        `,
        )
        .join("");

      let dataTable = new simpleDatatables.DataTable(document.getElementById("table1"));
      // Patch "per page dropdown" and pagination after table rendered

      function adaptPageDropdown() {
        const selector = dataTable.wrapper.querySelector(".dataTable-selector");
        selector.parentNode.parentNode.insertBefore(selector, selector.parentNode);
        selector.classList.add("form-select");
      }

      // Add bs5 classes to pagination elements
      function adaptPagination() {
        const paginations = dataTable.wrapper.querySelectorAll("ul.dataTable-pagination-list");

        for (const pagination of paginations) {
          pagination.classList.add(...["pagination", "pagination-primary"]);
        }

        const paginationLis = dataTable.wrapper.querySelectorAll("ul.dataTable-pagination-list li");

        for (const paginationLi of paginationLis) {
          paginationLi.classList.add("page-item");
        }

        const paginationLinks = dataTable.wrapper.querySelectorAll("ul.dataTable-pagination-list li a");

        for (const paginationLink of paginationLinks) {
          paginationLink.classList.add("page-link");
        }
      }

      const refreshPagination = () => {
        adaptPagination();
      };

      dataTable.on("datatable.init", () => {
        adaptPageDropdown();
        refreshPagination();
      });
      dataTable.on("datatable.update", refreshPagination);
      dataTable.on("datatable.sort", refreshPagination);

      // Re-patch pagination after the page was changed
      dataTable.on("datatable.page", adaptPagination);

      // Delete button
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

      // Admin button
      const adminBtns = document.querySelectorAll(".admin-btn");
      adminBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
          const accountId = this.id.split("-")[2];
          fetch("/server/updateAccount.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              account_id: accountId,
              isAdmin: 1, // Thiết lập 1 và so với database
              isLock: 0,
            }),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                Swal.fire({
                  title: `Thay đổi quyền Admin thành công!`,
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
                  title: `Thay đổi quyền Admin thất bại!`,
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

      // Lock button
      const lockBtns = document.querySelectorAll(".lock-btn");
      lockBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
          const accountId = this.id.split("-")[2];
          fetch("/server/updateAccount.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              account_id: accountId,
              isLock: 1, // Thiết lập 1 và so với database
              isAdmin: 0,
            }),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                Swal.fire({
                  title: `Thay đổi trạng thái khóa tài khoản thành công!`,
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
                  title: `Thay đổi trạng thái khóa tài khoản thất bại!`,
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

      // Reset button
      const resetBtns = document.querySelectorAll(".reset-btn");
      resetBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
          const accountId = this.id.split("-")[2];
          fetch("/server/updateAccount.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              account_id: accountId,
              isLock: 0, // Thiết lập 0
              isAdmin: 0, // Thiết lập 0, và căn cứ vào 2 số 0 là reset password đối với api updateAccount.php
            }),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                Swal.fire({
                  title: `Reset mật khẩu thành công!`,
                  text: "Mật khẩu đã được đặt lại thành 123456!",
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
                  title: `Reset mật khẩu thất bại!`,
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
