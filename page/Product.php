<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chi tiết sản phẩm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="/css/Product.css" />
  <link rel="stylesheet" href="/css/breadcrumb.css" />
</head>

<body>
  <?php include "navbar.html" ?>
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item active" id="product"></li>
      </ol>
    </nav>
    <div id="product-detail">
      <!-- Chi tiết sản phẩm sẽ được hiển thị ở đây -->
    </div>
  </div>

  <script>
    // Lấy thông tin sản phẩm từ URL
    const urlParams = new URLSearchParams(window.location.search);
    const productName = urlParams.get("name");
    document.getElementById("product").innerHTML = productName;

    fetch(`/server/getProduct.php?name=${productName}`)
      .then((response) => response.json())
      .then((data) => {
        // Data ở đây là sản phẩm đã query từ database
        if (data) {
          displayProductDetail(data);
        } else {
          document.getElementById("product-detail").innerHTML =
            "<p>Không tìm thấy sản phẩm.</p>";
        }
      })
      .catch((error) => console.error("Lỗi tải dữ liệu:", error));

    function displayProductDetail(product) {
      const productDetail = document.getElementById("product-detail");
      productDetail.innerHTML = `
      <div class="row">
        <div class="col-md-6">
          <img src="${product.image}" class="img-fluid" alt="${product.name}">
        </div>
        <div class="col-md-6">
          <h1>${product.name}</h1>
          <p><strong><i class="bi bi-cpu"></i> Chip:</strong> ${product.cpu}</p>
          <p><strong><i class="bi bi-memory"></i> RAM:</strong> ${product.ram}</p>
          <p><strong><i class="bi bi-display"></i> Màn hình:</strong> ${product.screen}</p>
          <p><strong><i class="bi bi-gpu-card"></i> Card:</strong> ${product.gpu}</p>
          <p><strong><i class="bi bi-tag"></i> Giá:</strong> ${product.price}</p>
          <div class="d-flex">
            <button style="background-color:rgb(47, 125, 65); color: white; border-radius: 5px;border: none;padding: 10px 20px; margin-right: 10px;" onclick="addToCart('${product.name}', '${product.image}', '${product.price}')">Thêm vào giỏ hàng</button>
            <button class="btn btn-primary">Mua ngay</button>
          </div>
        </div>
      </div>
    `;
    }

    function addToCart(name, image, price) {
      const cart = JSON.parse(localStorage.getItem("cart")) || [];
      const product = { name, image, price };
      cart.push(product);
      localStorage.setItem("cart", JSON.stringify(cart));
      alert("Sản phẩm đã được thêm vào giỏ hàng!");
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>