<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Danh sách sản phẩm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../css/ProductList.css" />
  <link rel="stylesheet" href="../css/breadcrumb.css" />

</head>

<body>
  <!-- Navigation -->
  <?php include "navbar.html" ?>

  <div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item active">Sản phẩm</li>
      </ol>
    </nav>
    <div class="row mb-3">
      <div class="col-md-6">
        <input type="text" id="search-input" class="form-control" placeholder="Tìm kiếm sản phẩm..." />
      </div>
      <div class="col-md-2">
        <button id="search-btn" class="btn btn-primary">Tìm kiếm</button>
      </div>
    </div>
    <div class="row" id="product-list">
      <!-- Sản phẩm sẽ được hiển thị ở đây -->
    </div>
  </div>
  <!-- Footer -->
  <?php include "footer.html" ?>

  <script>
    let products = [];

    fetch("/server/getProductList.php")
      .then((response) => response.json())
      .then((data) => {
        products = data;
        displayProducts(products);
      })
      .catch((error) => console.error("Lỗi tải dữ liệu:", error));

    // Hiển thị danh sách sản phẩm
    function displayProducts(products) {
      const productList = document.getElementById("product-list");
      productList.innerHTML = "";
      products.forEach((product) => {
        const productHTML = `
            <div class="col-md-4 mb-4">
              <div class="card" data-name="${product.name}">
                <img src="${product.image}" class="card-img-top" alt="${product.name}">
                <div class="card-body">
                  <h5 class="card-title">${product.name}</h5>
                  <p class="card-text">
                    <strong><i class="bi bi-cpu"> </i>Chip:</strong> ${product.cpu}<br>
                    <strong><i class="bi bi-memory"></i> RAM:</strong> ${product.ram}<br>
                    <strong><i class="bi bi-display"></i> Màn hình:</strong> ${product.screen}<br>
                    <strong><i class="bi bi-gpu-card"></i> Card:</strong> ${product.gpu}<br>
                    <strong><i class="bi bi-tag"></i> Giá: </strong> <span class="price">${product.price} VNĐ</span>
                  </p>
                </div>
              </div>
            </div>`;
        productList.innerHTML += productHTML;
      });

      // Thêm sự kiện click vào từng sản phẩm
      document.querySelectorAll(".card").forEach((card) => {
        card.addEventListener("click", () => {
          const productName = card.getAttribute("data-name");
          window.location.href = `product?name=${encodeURIComponent(
            productName
          )}`;
        });
      });
    }

    // Xử lý tìm kiếm
    document.getElementById("search-btn").addEventListener("click", () => {
      const keyword = document
        .getElementById("search-input")
        .value.toLowerCase();
      const filteredProducts = products.filter(
        (product) =>
          product.name.toLowerCase().includes(keyword) ||
          product.cpu.toLowerCase().includes(keyword) ||
          product.ram.toLowerCase().includes(keyword) ||
          product.screen.toLowerCase().includes(keyword) ||
          product.gpu.toLowerCase().includes(keyword)
      );
      displayProducts(filteredProducts);
    });

    // Tìm kiếm khi nhấn Enter
    document
      .getElementById("search-input")
      .addEventListener("keypress", (event) => {
        if (event.key === "Enter") {
          const keyword = event.target.value.toLowerCase();
          const filteredProducts = products.filter(
            (product) =>
              product.name.toLowerCase().includes(keyword) ||
              product.core_chip.toLowerCase().includes(keyword) ||
              product.ram.toLowerCase().includes(keyword) ||
              product.screen.toLowerCase().includes(keyword) ||
              product.gpu.toLowerCase().includes(keyword)
          );
          displayProducts(filteredProducts);
        }
      });

    // Xử lý sự kiện click trên các liên kết thương hiệu
    document.querySelectorAll(".nav-link").forEach((link) => {
      link.addEventListener("click", (event) => {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        const brand = event.target.getAttribute("data-brand").toLowerCase();
        const filteredProducts = products.filter(
          (product) => product.brand.toLowerCase() === brand
        );
        displayProducts(filteredProducts);
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>