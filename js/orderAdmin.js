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
