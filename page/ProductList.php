<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Danh sách sản phẩm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/ProductList.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="logo.png" alt="Logo" class="logo" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-brand="MSI">MSI</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-brand="LENOVO">LENOVO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-brand="DELL">DELL</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-brand="HP">HP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-brand="ASUS">ASUS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-brand="TIN TỨC CHUNG">TIN TỨC CHUNG</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-brand="LIÊN HỆ">LIÊN HỆ</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
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

  <script>
    let products = [];

    // Lấy dữ liệu từ file JSON
    fetch("../data/data.json")
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
                    <strong>Chip:</strong> ${product.core_chip}<br>
                    <strong>RAM:</strong> ${product.ram}<br>
                    <strong>Màn hình:</strong> ${product.screen}<br>
                    <strong>Card:</strong> ${product.gpu}<br>
                    <strong>Giá:</strong> ${product.price}
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
          window.location.href = `Product.html?name=${encodeURIComponent(
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
          product.core_chip.toLowerCase().includes(keyword) ||
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