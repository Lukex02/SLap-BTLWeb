let allArticles = [];
let articles = [];
const urlParams = new URLSearchParams(window.location.search);
const category = urlParams.get("category");
const articleContainer = document.getElementById("articles-container");

const articlesPerPage = 10; // Số bài viết trên mỗi trang
let currentPage = 1;
let totalPages = 0;
window.onload = fetchAllArticles;

function fetchAllArticles() {
  fetch("/server/getArticleList.php")
    .then((response) => response.json())
    .then((data) => {
      allArticles = articles = data;
      if (category) {
        articles = filterArticles(category);
      }
      totalPages = Math.ceil(articles.length / articlesPerPage);
      displayCurrentPage(currentPage);
      updatePaginationButtons();
      const topicContainer = document.getElementById("topic-container");
      let topicList = [];
      let topicContent = `<div class="card border border-0 article-meta">
      <div class="card-header">Chủ đề</div>
      <ul class="list-group list-group-flush">`;
      data.forEach((article) => {
        const topic = article.category;
        if (!topicList.includes(topic) && topic != "") {
          const topicHTML = `
          <li class="list-group-item"><a class="category-item" href="/articleList?category=${topic}" data-category="${topic}">${topic}</a></li> 
          `;
          topicContent += topicHTML;
          topicList.push(topic);
        }
      });
      topicContent += `</ul></div>`;
      topicContainer.innerHTML = topicContent;
    })
    .catch((error) => console.error("Lỗi khi tải dữ liệu:", error));
}

function displayArticle(data) {
  let content = "";
  data.forEach((article, index) => {
    if (index == 0 && data.length > 3) {
      content += `<div class="row">`;
    }
    if (index < 3 && data.length > 3) {
      content += `<div class="col-4">`;
    }
    content += `
        <div class="row article-item py-3">
          <div class="${index < 3 && data.length > 3 ? "col-xxl-3" : "col-3"}"> 
            <img src="${article.thumbnail}" class="img-fluid w-100" alt="${article.title}">              
          </div>
          <div class="col">
            <div class="article-meta"> 
              <h3><a href="/article?slug=${article.slug}">${article.title}</a></h3>
              ${new Date(article.published_at).toLocaleDateString()} |
              <strong>Lượt thích:</strong> ${article.likes} |
              <strong>Tác giả:</strong> ${article.author_name}
              <h5 class="article-excerpt mt-3">${article.excerpt}</h5>
            </div>
          </div>
        </div>
        `;
    if (index < 3 && data.length > 3) {
      content += `</div>`;
    }
    if (index == 2 && data.length > 3) {
      content += "</div>";
    }
  });
  articleContainer.innerHTML = content;
}

function filterArticles(keyword) {
  document.getElementById(
    "breadcrumb-list",
  ).innerHTML = `<li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="/articleList">Tin tức chung</a></li>
    <li class="breadcrumb-item active">${category}</li>
    `;
  const filterArticles = allArticles.filter((article) => article.category.includes(keyword));
  return filterArticles;
}

function displayCurrentPage(page) {
  const startIndex = (page - 1) * articlesPerPage;
  const endIndex = startIndex + articlesPerPage;
  const currentArticles = articles.slice(startIndex, endIndex);
  displayArticle(currentArticles);
  currentPage = page;
  updatePaginationButtons();
}

function updatePaginationButtons() {
  const paginationContainer = document.querySelector(".pagination");
  paginationContainer.innerHTML = ""; // Xóa nút cũ

  // Nút "Trước"
  const prevButton = document.createElement("li");
  prevButton.classList.add("page-item");
  if (currentPage === 1) prevButton.classList.add("disabled");
  prevButton.innerHTML = `<a class="page-link" href="#" aria-label="Previous">
    <span aria-hidden="true">&laquo;</span>
  </a>`;
  prevButton.querySelector("a").addEventListener("click", () => {
    if (currentPage > 1) {
      displayCurrentPage(currentPage - 1);
    }
  });
  paginationContainer.appendChild(prevButton);

  // Các nút số trang (ví dụ: hiển thị một vài trang lân cận)
  const maxVisiblePages = 5;
  let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
  let endPage = Math.min(totalPages, currentPage + Math.floor(maxVisiblePages / 2));

  if (totalPages <= maxVisiblePages) {
    startPage = 1;
    endPage = totalPages;
  } else if (startPage === 1) {
    endPage = maxVisiblePages;
  } else if (endPage === totalPages) {
    startPage = totalPages - maxVisiblePages + 1;
  }

  for (let i = startPage; i <= endPage; i++) {
    const pageButton = document.createElement("li");
    pageButton.textContent = i;
    pageButton.classList.add("page-item");
    pageButton.innerHTML = `<a class="page-link" href="#">${i}</a>`;
    if (i === currentPage) {
      pageButton.classList.add("active");
    }
    pageButton.querySelector("a").addEventListener("click", () => {
      displayCurrentPage(i);
    });
    paginationContainer.appendChild(pageButton);
  }

  // Nút "Sau"
  const nextButton = document.createElement("li");
  nextButton.classList.add("page-item");
  if (currentPage === totalPages) nextButton.classList.add("disabled");
  nextButton.innerHTML = `<a class="page-link" href="#" aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
  </a>`;
  nextButton.querySelector("a").addEventListener("click", () => {
    if (currentPage < totalPages) {
      displayCurrentPage(currentPage + 1);
    }
  });
  paginationContainer.appendChild(nextButton);
}
