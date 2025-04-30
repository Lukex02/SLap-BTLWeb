let products = [];

fetch("/server/getProductList.php")
  .then((response) => response.json())
  .then((data) => {
    products = data;
    displayProducts();
  })
  .catch((error) => console.error("Lỗi tải dữ liệu:", error));

// Hiển thị danh sách sản phẩm
function displayProducts() {
  const productTable = document.getElementById("product-table");
  productTable.innerHTML = "";
  products.forEach((product, index) => {
    const row = `
      <tr>
        <td>${index + 1}</td>
        <td>
          <img src="${product.image}" alt="${
      product.name
    }" class="product-thumbnail" width="60">
        </td>
        <td>${product.name}</td>
        <td>${product.brand}</td>
        <td>${formatCurrency(product.price)}đ</td>
        <td>
          <button class="btn btn-info btn-sm view-btn" onclick="viewProduct(${
            product.id
          })">Xem</button>
          <button class="btn btn-warning btn-sm" onclick="editProduct(${
            product.id
          })">Sửa</button>
          <button class="btn btn-danger btn-sm" onclick="deleteProduct(${
            product.id
          })">Xóa</button>
        </td>
      </tr>`;
    productTable.innerHTML += row;
  });
}

// Format currency
function formatCurrency(price) {
  return new Intl.NumberFormat("vi-VN").format(price);
}

// Thêm sản phẩm mới
document.getElementById("add-product-btn").addEventListener("click", () => {
  showProductModal();
});

// Hiển thị modal thêm/sửa sản phẩm
function showProductModal(product = null) {
  const modalTitle = document.getElementById("product-modal-title");
  const modalForm = document.getElementById("product-form");
  const submitBtn = document.getElementById("product-submit");

  // Reset form
  modalForm.reset();

  if (product) {
    modalTitle.textContent = "Sửa sản phẩm";
    submitBtn.textContent = "Cập nhật";

    // Fill form with product data
    document.getElementById("product-id").value = product.id;
    document.getElementById("product-name").value = product.name;
    document.getElementById("product-brand").value = product.brand;
    document.getElementById("product-price").value = product.price;
    document.getElementById("product-cpu").value = product.cpu;
    document.getElementById("product-ram").value = product.ram;
    document.getElementById("product-screen").value = product.screen;
    document.getElementById("product-gpu").value = product.gpu;
    document.getElementById("product-image").value = product.image;

    // Show preview of current image
    document.getElementById("image-preview").src = product.image;
    document.getElementById("image-preview").style.display = "block";
  } else {
    modalTitle.textContent = "Thêm sản phẩm mới";
    submitBtn.textContent = "Thêm sản phẩm";
    document.getElementById("product-id").value = "";
    document.getElementById("image-preview").style.display = "none";
  }

  // Show modal
  const productModal = new bootstrap.Modal(
    document.getElementById("product-modal")
  );
  productModal.show();
}

// Xem sản phẩm
function viewProduct(id) {
  const product = products.find((p) => p.id == id);

  if (!product) {
    showAlert("Không tìm thấy sản phẩm!", "error");
    return;
  }

  const viewModal = document.getElementById("view-product-modal");

  // Fill product details
  document.getElementById("view-product-name").textContent = product.name;
  document.getElementById("view-product-brand").textContent = product.brand;
  document.getElementById("view-product-price").textContent =
    formatCurrency(product.price) + "đ";
  document.getElementById("view-product-cpu").textContent = product.cpu;
  document.getElementById("view-product-ram").textContent = product.ram;
  document.getElementById("view-product-screen").textContent = product.screen;
  document.getElementById("view-product-gpu").textContent = product.gpu;
  document.getElementById("view-product-image").src = product.image;

  // Show modal
  const viewProductModal = new bootstrap.Modal(viewModal);
  viewProductModal.show();
}

// Sửa sản phẩm
function editProduct(id) {
  const product = products.find((p) => p.id == id);

  if (!product) {
    showAlert("Không tìm thấy sản phẩm!", "error");
    return;
  }

  showProductModal(product);
}

// Xử lý submit form
document
  .getElementById("product-form")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const productId = document.getElementById("product-id").value;
    const formData = new FormData(this);

    // API endpoint based on whether we're adding or updating
    const url = productId
      ? "/server/updateProduct.php"
      : "/server/addProduct.php";

    fetch(url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          // Close modal
          bootstrap.Modal.getInstance(
            document.getElementById("product-modal")
          ).hide();

          // Show success message
          showAlert(
            productId
              ? "Cập nhật sản phẩm thành công!"
              : "Thêm sản phẩm thành công!",
            "success"
          );

          // Refresh product list
          fetchProducts();
        } else {
          showAlert(data.message || "Có lỗi xảy ra!", "error");
        }
      })
      .catch((error) => {
        console.error("Lỗi:", error);
        showAlert("Có lỗi xảy ra khi xử lý yêu cầu!", "error");
      });
  });

// Xóa sản phẩm
function deleteProduct(id) {
  Swal.fire({
    title: "Xác nhận xóa?",
    text: "Bạn có chắc chắn muốn xóa sản phẩm này?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Xóa",
    cancelButtonText: "Hủy",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`/server/deleteProduct.php?id=${id}`)
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            showAlert("Xóa sản phẩm thành công!", "success");
            fetchProducts();
          } else {
            showAlert(
              data.message || "Có lỗi xảy ra khi xóa sản phẩm!",
              "error"
            );
          }
        })
        .catch((error) => {
          console.error("Lỗi:", error);
          showAlert("Có lỗi xảy ra khi xử lý yêu cầu!", "error");
        });
    }
  });
}

// Fetch lại danh sách sản phẩm
function fetchProducts() {
  fetch("/server/getProductList.php")
    .then((response) => response.json())
    .then((data) => {
      products = data;
      displayProducts();
    })
    .catch((error) => console.error("Lỗi tải dữ liệu:", error));
}

// Hiển thị thông báo alert
function showAlert(message, type) {
  const icon = type === "success" ? "success" : "error";
  Swal.fire({
    icon: icon,
    title: message,
    showConfirmButton: false,
    timer: 1500,
  });
}

// Preview image when URL is entered
document.getElementById("product-image").addEventListener("input", function () {
  const imageUrl = this.value;
  const imagePreview = document.getElementById("image-preview");

  if (imageUrl) {
    imagePreview.src = imageUrl;
    imagePreview.style.display = "block";
  } else {
    imagePreview.style.display = "none";
  }
});
