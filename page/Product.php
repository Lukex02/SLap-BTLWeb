<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chi tiết sản phẩm</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/Product.css" />
  </head>
  <body>
    <?php include "navbar.html" ?>
    <div class="container mt-4">
      <div id="product-detail">
        <!-- Chi tiết sản phẩm sẽ được hiển thị ở đây -->
      </div>
    </div>

    <script>
      // Lấy thông tin sản phẩm từ URL
      const urlParams = new URLSearchParams(window.location.search);
      const productName = urlParams.get("name");

      fetch("../data/data.json")
        .then((response) => response.json())
        .then((data) => {
          const product = data.find((p) => p.name === productName);
          if (product) {
            displayProductDetail(product);
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
              <p><strong>Chip:</strong> ${product.core_chip}</p>
              <p><strong>RAM:</strong> ${product.ram}</p>
              <p><strong>Màn hình:</strong> ${product.screen}</p>
              <p><strong>Card:</strong> ${product.gpu}</p>
              <p><strong>Giá:</strong> ${product.price}</p>
              <button class="btn btn-primary">Mua ngay</button>
            </div>
          </div>
        `;
      }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
