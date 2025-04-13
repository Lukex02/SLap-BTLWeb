// Giả lập dữ liệu từ database
const productsFromDB = [
  {
    id: 1,
    name: "Sản phẩm 1",
    price: "500.000đ",
    image: "https://via.placeholder.com/300",
  },
  {
    id: 2,
    name: "Sản phẩm 2",
    price: "750.000đ",
    image: "https://via.placeholder.com/300",
  },
  {
    id: 3,
    name: "Sản phẩm 3",
    price: "1.200.000đ",
    image: "https://via.placeholder.com/300",
  },
  {
    id: 4,
    name: "Sản phẩm 4",
    price: "900.000đ",
    image: "https://via.placeholder.com/300",
  },
  {
    id: 5,
    name: "Sản phẩm 5",
    price: "600.000đ",
    image: "https://via.placeholder.com/300",
  },
  {
    id: 6,
    name: "Sản phẩm 6",
    price: "1.000.000đ",
    image: "https://via.placeholder.com/300",
  },
  {
    id: 7,
    name: "Sản phẩm 7",
    price: "800.000đ",
    image: "https://via.placeholder.com/300",
  },
  {
    id: 8,
    name: "Sản phẩm 8",
    price: "1.500.000đ",
    image: "https://via.placeholder.com/300",
  },
];

const promotionsFromDB = [
  {
    id: 1,
    title: "Khuyến mãi mùa hè",
    description: "Giảm giá 30% cho tất cả sản phẩm",
    image: "https://via.placeholder.com/600x400",
  },
  {
    id: 2,
    title: "Ưu đãi thành viên",
    description: "Tích điểm đổi quà cho khách hàng thân thiết",
    image: "https://via.placeholder.com/600x400",
  },
  {
    id: 3,
    title: "Combo tiết kiệm",
    description: "Mua 2 tặng 1 cho các sản phẩm được chọn",
    image: "https://via.placeholder.com/600x400",
  },
];

// Hàm hiển thị sản phẩm
function displayProducts() {
  const productGrid = document.getElementById("product-list");

  productsFromDB.forEach((product) => {
    const productCard = document.createElement("div");
    productCard.className = "product-card";
    productCard.innerHTML = `
            <div class="product-image" style="background-image: url('${product.image}')"></div>
            <div class="product-info">
                <h3 class="product-title">${product.name}</h3>
                <p class="product-price">${product.price}</p>
                <button class="btn" style="background-color: #007bff; color: white; width: 100%;">Xem chi tiết</button>
            </div>
        `;
    productGrid.appendChild(productCard);
  });
}

// Hàm hiển thị sản phẩm dạng carousel
function displayProducts() {
  const productGrid = document.getElementById("product-list");
  productGrid.innerHTML = ""; // Xóa nội dung cũ

  // Tạo container cho carousel
  const carouselContainer = document.createElement("div");
  carouselContainer.className = "product-carousel-container";

  // Tạo carousel
  const carousel = document.createElement("div");
  carousel.className = "product-carousel";
  carousel.id = "product-carousel";

  // Thêm sản phẩm vào carousel
  productsFromDB.forEach((product) => {
    const productCard = document.createElement("div");
    productCard.className = "product-card";
    productCard.innerHTML = `
      <div class="product-image" style="background-image: url('${product.image}')"></div>
      <div class="product-info">
        <h3 class="product-title">${product.name}</h3>
        <p class="product-price">${product.price}</p>
        <button class="btn" style="background-color: #007bff; color: white; width: 100%;">Xem chi tiết</button>
      </div>
    `;
    carousel.appendChild(productCard);
  });

  // Thêm nút điều khiển
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

  productGrid.appendChild(carouselContainer);

  // Khởi tạo vị trí carousel
  currentSlide = 0;
  updateCarousel();
}

// Biến để theo dõi slide hiện tại
let currentSlide = 0;

// Hàm chuyển slide trước
function slidePrev() {
  const carousel = document.getElementById("product-carousel");
  const productCards = document.querySelectorAll(".product-card");
  const cardWidth = productCards[0].offsetWidth + 20; // width + margin

  currentSlide = Math.max(currentSlide - 1, 0);
  carousel.style.transform = `translateX(-${currentSlide * cardWidth}px)`;
}

// Hàm chuyển slide tiếp theo
function slideNext() {
  const carousel = document.getElementById("product-carousel");
  const productCards = document.querySelectorAll(".product-card");
  const cardWidth = productCards[0].offsetWidth + 20; // width + margin
  const visibleCards = Math.floor(carousel.offsetWidth / cardWidth);

  currentSlide = Math.min(currentSlide + 1, productCards.length - visibleCards);
  carousel.style.transform = `translateX(-${currentSlide * cardWidth}px)`;
}

// Hàm cập nhật carousel
function updateCarousel() {
  const carousel = document.getElementById("product-carousel");
  const productCards = document.querySelectorAll(".product-card");
  if (productCards.length === 0) return;

  const cardWidth = productCards[0].offsetWidth + 20; // width + margin
  carousel.style.transform = `translateX(-${currentSlide * cardWidth}px)`;
}

// Cập nhật khi resize window
window.addEventListener("resize", function () {
  updateCarousel();
});

document.addEventListener("DOMContentLoaded", function () {
  displayProducts();
  displayPromotions();
});
// Hàm hiển thị quảng cáo
function displayPromotions() {
  const promotionGrid = document.getElementById("promotion-list");

  promotionsFromDB.forEach((promo) => {
    const promoCard = document.createElement("div");
    promoCard.className = "promotion-card";
    promoCard.innerHTML = `
            <div class="promotion-image" style="background-image: url('${promo.image}')"></div>
            <div class="promotion-content">
                <h3 class="promotion-title">${promo.title}</h3>
                <p class="promotion-desc">${promo.description}</p>
                <a href="#" class="btn" style="background-color: #28a745; color: white;">Xem ngay</a>
            </div>
        `;
    promotionGrid.appendChild(promoCard);
  });
}

document.addEventListener("DOMContentLoaded", function () {
  displayProducts();
  displayPromotions();
});
