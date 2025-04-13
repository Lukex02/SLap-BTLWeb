let products = [];

// Lấy danh sách sản phẩm từ file JSON
fetch("/admin/getProductList.php")
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
        <td>${product.name}</td>
        <td>${product.brand}</td>
        <td>${product.price}</td>
        <td>
          <button class="btn btn-warning btn-sm" onclick="editProduct(${index})">Sửa</button>
          <button class="btn btn-danger btn-sm" onclick="deleteProduct(${index})">Xóa</button>
        </td>
      </tr>`;
    productTable.innerHTML += row;
  });
}

// Thêm sản phẩm mới
document.getElementById("add-product-btn").addEventListener("click", () => {
  const name = prompt("Nhập tên sản phẩm:");
  const brand = prompt("Nhập thương hiệu:");
  const price = prompt("Nhập giá:");
  const core_chip = prompt("Nhập chip:");
  const ram = prompt("Nhập RAM:");
  const screen = prompt("Nhập màn hình:");
  const gpu = prompt("Nhập card đồ họa:");
  const image = prompt("Nhập đường dẫn hình ảnh:");

  if (name && brand && price) {
    products.push({ name, brand, price, core_chip, ram, screen, gpu, image });
    displayProducts();
  }
});

// Sửa sản phẩm
function editProduct(index) {
  const product = products[index];
  const name = prompt("Nhập tên sản phẩm:", product.name);
  const brand = prompt("Nhập thương hiệu:", product.brand);
  const price = prompt("Nhập giá:", product.price);

  if (name && brand && price) {
    products[index] = { ...product, name, brand, price };
    displayProducts();
  }
}

// Xóa sản phẩm
function deleteProduct(index) {
  if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
    products.splice(index, 1);
    displayProducts();
  }
}

let orders = [
  {
    id: 1,
    customer: "Nguyễn Văn A",
    product: "Laptop MSI Katana GF66",
    status: "Đang xử lý",
  },
  {
    id: 2,
    customer: "Trần Thị B",
    product: "Laptop Lenovo Legion 5",
    status: "Hoàn thành",
  },
];

// Hiển thị danh sách đơn hàng
function displayOrders() {
  const orderTable = document.getElementById("order-table");
  orderTable.innerHTML = "";
  orders.forEach((order, index) => {
    const row = `
        <tr>
          <td>${index + 1}</td>
          <td>${order.customer}</td>
          <td>${order.product}</td>
          <td>${order.status}</td>
          <td>
            <button class="btn btn-success btn-sm" onclick="updateOrderStatus(${index}, 'Hoàn thành')">Hoàn thành</button>
            <button class="btn btn-secondary btn-sm" onclick="updateOrderStatus(${index}, 'Đang xử lý')">Đang xử lý</button>
          </td>
        </tr>`;
    orderTable.innerHTML += row;
  });
}

// Cập nhật trạng thái đơn hàng
function updateOrderStatus(index, status) {
  orders[index].status = status;
  displayOrders();
}

// Hiển thị danh sách đơn hàng khi tải trang
displayOrders();

// Lưu sản phẩm vào LocalStorage
function saveProducts() {
  localStorage.setItem("products", JSON.stringify(products));
}

// Lấy sản phẩm từ LocalStorage
function loadProducts() {
  const storedProducts = localStorage.getItem("products");
  if (storedProducts) {
    products = JSON.parse(storedProducts);
    displayProducts();
  }
}

// Gọi hàm loadProducts khi tải trang
loadProducts();
