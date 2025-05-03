async function fetchProducts() {
  try {
    const response = await fetch("/server/getProductListHome.php", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    if (data.message) {
      console.error(data.message);
      return [];
    }
    return data;
  } catch (error) {
    console.error("Lỗi khi lấy dữ liệu sản phẩm:", error);
    return [];
  }
}

async function fetchPromotions() {
  try {
    const response = await fetch("/server/getArticleListHome.php", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    if (data.message) {
      console.error(data.message);
      return [];
    }
    return data;
  } catch (error) {
    console.error("Lỗi khi lấy dữ liệu khuyến mãi:", error);
    return [];
  }
}

async function displayProducts() {
  console.log("displayProducts called");
  const productList = document.getElementById("product-list");
  productList.innerHTML = ""; // Xóa nội dung cũ

  const products = await fetchProducts();
  if (products.length === 0) {
    productList.innerHTML = "<p>Không có sản phẩm nào để hiển thị.</p>";
    return;
  }

  const carouselContainer = document.createElement("div");
  carouselContainer.className = "product-carousel-container";

  const carousel = document.createElement("div");
  carousel.className = "product-carousel";
  carousel.id = "product-carousel";

  products.forEach((product) => {
    const productCard = document.createElement("div");
    productCard.className = "product-card";
    productCard.innerHTML = `
      <div class="product-image" style="background-image: url('${product.image}')"></div>
      <div class="product-info">
        <h5 class="product-title">${product.name}</h5>
        <p class="product-details">
          <strong><i class="bi bi-tag"></i> Giá:</strong> <span class="product-price">${product.price}</span>
        </p>
        <button class="btn" data-name="${product.name}">Xem chi tiết</button>
      </div>
    `;
    carousel.appendChild(productCard);
  });

  const prevButton = document.createElement("button");
  prevButton.className = "carousel-control prev";
  prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
  prevButton.addEventListener("click", slidePrev);

  const nextButton = document.createElement("button");
  nextButton.className = "carousel-control next";
  nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
  nextButton.addEventListener("click", slideNext);

  carouselContainer.appendChild(prevButton);
  carouselContainer.appendChild(carousel);
  carouselContainer.appendChild(nextButton);

  productList.appendChild(carouselContainer);

  // Thêm sự kiện click cho nút "Xem chi tiết"
  document.querySelectorAll(".product-card .btn").forEach((button) => {
    button.addEventListener("click", () => {
      const productName = button.getAttribute("data-name");
      window.location.href = `/page/Product.php?name=${encodeURIComponent(
        productName
      )}`;
    });
  });

  currentSlide = 0;
  updateCarousel();
}

async function displayPromotions() {
  console.log("displayPromotions called");
  const promotionGrid = document.getElementById("promotion-list");
  promotionGrid.innerHTML = ""; // Xóa nội dung cũ

  const promotions = await fetchPromotions();
  if (promotions.length === 0) {
    promotionGrid.innerHTML = "<p>Không có khuyến mãi nào để hiển thị.</p>";
    return;
  }

  promotions.forEach((promo) => {
    const promoCard = document.createElement("div");
    promoCard.className = "promotion-card";
    promoCard.innerHTML = `
      <div class="promotion-image" style="background-image: url('${
        promo.thumbnail || "https://via.placeholder.com/600x400"
      }')"></div>
      <div class="promotion-content">
        <h3 class="promotion-title">${promo.title}</h3>
        <p class="promotion-desc">${promo.excerpt || "Không có mô tả"}</p>
        <button class="btn" data-slug="${
          promo.slug
        }" style="background-color: #28a745; color: white;">Xem ngay</button>
      </div>
    `;
    promotionGrid.appendChild(promoCard);
  });

  // Thêm sự kiện click cho nút "Xem ngay"
  document.querySelectorAll(".promotion-card .btn").forEach((button) => {
    button.addEventListener("click", () => {
      const promoSlug = button.getAttribute("data-slug");
      window.location.href = `/page/article.php?slug=${encodeURIComponent(
        promoSlug
      )}`;
    });
  });
}

let currentSlide = 0;

function slidePrev() {
  const carousel = document.getElementById("product-carousel");
  const productCards = document.querySelectorAll(".product-card");
  if (productCards.length === 0) return;
  const cardWidth = productCards[0].offsetWidth + 20;

  currentSlide = Math.max(currentSlide - 1, 0);
  carousel.style.transform = `translateX(-${currentSlide * cardWidth}px)`;
}

function slideNext() {
  const carousel = document.getElementById("product-carousel");
  const productCards = document.querySelectorAll(".product-card");
  if (productCards.length === 0) return;
  const cardWidth = productCards[0].offsetWidth + 20;
  const visibleCards = Math.floor(carousel.offsetWidth / cardWidth);

  currentSlide = Math.min(currentSlide + 1, productCards.length - visibleCards);
  carousel.style.transform = `translateX(-${currentSlide * cardWidth}px)`;
}

function updateCarousel() {
  const carousel = document.getElementById("product-carousel");
  const productCards = document.querySelectorAll(".product-card");
  if (productCards.length === 0) return;

  const cardWidth = productCards[0].offsetWidth + 20;
  carousel.style.transform = `translateX(-${currentSlide * cardWidth}px)`;
}

window.addEventListener("resize", function () {
  updateCarousel();
});

document.addEventListener("DOMContentLoaded", function () {
  console.log("DOMContentLoaded triggered");
  displayProducts();
  displayPromotions();
});
