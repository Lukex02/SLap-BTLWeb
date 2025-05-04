<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Giỏ hàng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/css/cart.css" />
</head>
<body>
  <?php include "navbar.html"; ?>
  <div class="container">
    <h1 class="mt-4">GIỎ HÀNG</h1>
    <div id="cart-items">
      <!-- Danh sách sản phẩm trong giỏ hàng sẽ được hiển thị ở đây -->
    </div>
    <div class="mt-4 text-end">
      <button class="btn btn-success" id="checkout-button">Thanh toán</button>
    </div>
  </div>
  <!-- Footer -->
  <?php include "footer.html" ?>

  <script>
    // Lấy danh sách sản phẩm từ localStorage
    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    function displayCartItems() {
      const cartItems = document.getElementById("cart-items");
      if (cart.length === 0) {
        cartItems.innerHTML = "<p>Giỏ hàng của bạn đang trống.</p>";
        return;
      }

      cartItems.innerHTML = cart
        .map(
          (item) => `
          <div class="row mb-3">
            <div class="col-md-2">
              <img src="${item.image}" class="img-fluid" alt="${item.name}">
            </div>
            <div class="col-md-6">
              <h5>${item.name}</h5>
              <p><strong>Giá:</strong> ${item.price}</p>
            </div>
            <div class="col-md-4 text-end">
              <button class="btn btn-danger btn-sm" onclick="removeFromCart('${item.name}')">Xóa</button>
            </div>
          </div>
        `
        )
        .join("");
    }

    function removeFromCart(name) {
      const index = cart.findIndex((item) => item.name === name);
      if (index !== -1) {
        cart.splice(index, 1);
        localStorage.setItem("cart", JSON.stringify(cart));
        displayCartItems();
      }
    }

    document.getElementById("checkout-button").addEventListener("click", () => {
      alert("Chức năng thanh toán đang được phát triển!");
    });

    displayCartItems();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>