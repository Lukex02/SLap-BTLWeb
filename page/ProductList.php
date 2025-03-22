<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danh sách sản phẩm</title>
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
    />
    <link rel="stylesheet" href="/css/ProductList.css" />
    <link rel="stylesheet" href="/css/breadcrumb.css" />
  </head>
  <body>
    <?php include "navbar.html"; ?>
    <div class="container">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/index.php">Trang chủ</a></li>
          <li class="breadcrumb-item active">Sản phẩm</li>
        </ol>
      </nav>
      <div class="row" id="product-list">
        <!-- Sản phẩm sẽ được hiển thị ở đây -->
      </div>
    </div>
    <script>
      let products = [];
      const urlParams = new URLSearchParams(window.location.search);
      const selectedBrand = urlParams.get("brand"); // Lấy brand từ URL

      fetch("../data/data.json")
        .then((response) => response.json())
        .then((data) => {
          products = data;
          if (selectedBrand) {
            const filtered = products.filter((product) =>
              product.brand.toUpperCase().includes(selectedBrand.toUpperCase())
            );
            displayProducts(filtered);
          } else {
            displayProducts(products);
          }
        })
        .catch((error) => console.error("Lỗi tải dữ liệu:", error));

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

        document.querySelectorAll(".card").forEach((card) => {
          card.addEventListener("click", () => {
            const productName = card.getAttribute("data-name");
            window.location.href = `/product?name=${encodeURIComponent(
              productName
            )}`;
          });
        });
      }

      // document.querySelectorAll(".nav-link").forEach((link) => {
      //   console.log(link.innerHTML)
      //   link.addEventListener("click", (event) => {
      //     event.preventDefault();
      //     const brand = event.target.getAttribute("data-brand");
      //     const filteredProducts = products.filter(
      //       (product) => product.brand.toUpperCase() === brand.toUpperCase()
      //     );
      //     displayProducts(filteredProducts);
      //   });
      // });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
