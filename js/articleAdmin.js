let allArticles = [];
const articleContainer = document.getElementById("articles-container");

const articlesPerPage = 5; // Số bài viết trên mỗi trang
let currentPage = 1;
let totalPages = 0;

document.addEventListener("DOMContentLoaded", function () {
  const cancelBtn = document.getElementById("cancel-edit-btn");
  const newBtn = document.getElementById("new-article-btn");

  cancelBtn.addEventListener("click", function (event) {
    event.preventDefault();
    document.getElementById("article-editor").style.display = "none";
    tinymce.get("default").setContent("");
  });
  newBtn.addEventListener("click", function (event) {
    event.preventDefault();
    window.location.href = "#article-editor";
    document.getElementById("article-editor").style.display = "block";
    uploadArticle();
  });
  // Lấy tiêu đề / thông tin chung của mọi bài viết
  fetch("/server/getArticleList.php")
    .then((response) => response.json())
    .then((data) => {
      allArticles = data;
      totalPages = Math.ceil(allArticles.length / articlesPerPage);
      displayCurrentPage(currentPage);
      updatePaginationButtons();
    })
    .catch((error) => console.error("Lỗi khi tải dữ liệu ở trang ArticleAdmin:", error));
});
// Process display specific article
function editArticle(articleSlug) {
  fetch("/server/getArticle.php?slug=" + articleSlug)
    .then((response) => response.json())
    .then((data) => {
      if (data) {
        window.location.href = "#article-editor";
        const { article } = data;
        const idElement = document.getElementById("article-id");
        idElement.value = article.id;

        const titleElement = document.getElementById("title");
        titleElement.value = article.title;

        const authorElement = document.getElementById("author");
        authorElement.value = article.author_name;

        const thumbnailElement = document.getElementById("thumbnail-old");
        thumbnailElement.value = article.thumbnail;

        tags.splice(0, tags.length);
        tags.push(...article.tags.split(","));
        renderTags();

        const categoryElement = document.getElementById("category");
        categoryElement.value = article.category;

        const excerptElement = document.getElementById("excerpt");
        excerptElement.value = article.excerpt;

        const articleDetail = `${article.content}`;
        document.getElementById("article-editor").style.display = "block";

        // Set nội dung mới vào TinyMCE
        tinymce.get("default").setContent(articleDetail);
      }
    })
    .catch((error) => console.error("Lỗi tải dữ liệu:", error));
}
// Process template for uploading new article
function uploadArticle() {
  const idElement = document.getElementById("article-id");
  idElement.value = null;

  const titleElement = document.getElementById("title");
  titleElement.value = null;

  const authorElement = document.getElementById("author");
  authorElement.value = null;

  const thumbnailElement = document.getElementById("thumbnail");
  thumbnailElement.value = null;

  tags.splice(0, tags.length);
  renderTags();

  const categoryElement = document.getElementById("category");
  categoryElement.value = null;

  const excerptElement = document.getElementById("excerpt");
  excerptElement.value = null;
  document.getElementById("article-editor").style.display = "block";
  tinymce.get("default").setContent("");
}
// Delete Articles
function deleteArticle(id) {
  fetch("/server/deleteArticle.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id: id,
    }),
  })
    .then((response) => response.text())
    .then((data) => {
      if (data) {
        console.log("Xóa thành công", data);
      }
    })
    .catch((error) => console.error("Lỗi tải dữ liệu:", error));
}
// Edit Form process
document.getElementById("edit-form").addEventListener("submit", function (event) {
  // event.preventDefault();
  // Kiểm tra form
  const titleElement = document.getElementById("title");
  if (titleElement.value == "") {
    event.preventDefault();
    alert("Tiêu đề không được để trống");
    return;
  }

  // Input ẩn cho tags
  const tagElement = document.createElement("input"); // For store in form only
  tagElement.setAttribute("type", "hidden");
  tagElement.setAttribute("name", "tags");
  tagElement.setAttribute(
    "value",
    tags.reduce((prev, curr) => (prev == "" ? curr : prev + "," + curr), "", tags),
  );

  // Content trong tinymce editor
  const content = tinymce.get("default").getContent();
  const hiddenInput = document.createElement("input");
  hiddenInput.setAttribute("type", "hidden");
  hiddenInput.setAttribute("name", "tinymce_content");
  hiddenInput.setAttribute("value", content);

  this.appendChild(hiddenInput);
  this.appendChild(tagElement);
  const formData = new FormData(this);
  formData.append("csrf_token", "<?php echo $_SESSION['csrf_token']; ?>");

  fetch("/server/setArticle.php", {
    method: this.method,
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      console.log("Phản hồi từ server:", data);
    })
    .catch((error) => {
      console.error("Lỗi khi gửi form:", error);
    });
});

// Tags process
const tagInput = document.getElementById("tag-input");
const tagContainer = document.getElementById("tag-container");
const tags = [];

function renderTags() {
  tagContainer.innerHTML = "";
  tags.forEach((tag, index) => {
    const tagElement = document.createElement("p");
    tagElement.className = "badge bg-primary rounded-pill me-1 mb-1";
    tagElement.innerHTML = `${tag} <span style="cursor: pointer;" onclick="removeTag(${index})">&times;</span>`;
    tagContainer.appendChild(tagElement);
  });
}

function removeTag(index) {
  tags.splice(index, 1);
  renderTags();
}

tagInput.addEventListener("keydown", function (e) {
  if (e.key === "Enter" && this.value.trim() !== "") {
    e.preventDefault();
    const value = this.value.trim();
    if (!tags.includes(value)) {
      tags.push(value);
      renderTags();
    }
    this.value = "";
  }
});

function displayArticle(data) {
  let content = "";
  data.forEach((article, index) => {
    content += `
        <div class="row article-item py-3 mx-2">
            <div class="col">
              <img src="${article.thumbnail}" class="img-fluid w-100" alt="${article.title}">              
            </div>
            <div class="col-9">
              <div class="article-meta">
                <h3><a href="#">${article.title}</a></h3>
                <p>Đường dẫn: ${article.slug}<p>
                <strong>Đăng vào: </strong> ${new Date(article.published_at).toLocaleString()} |
                <strong>Cập nhật lần cuối:</strong> ${new Date(article.updated_at).toLocaleString()} |
                <strong>Lượt thích:</strong> ${article.likes} |
                <strong>Tác giả:</strong> ${article.author_name}
                <p class="article-excerpt mt-3">${article.excerpt}</p>
              </div>
            </div>
            <div class="col">
              <div class="d-flex ms-auto my-auto flex-column gap-3">
                  <button class="btn btn-warning edit-btn text-nowrap" data-slug="${
                    article.slug
                  }">Chỉnh sửa</button>
                  <button class="btn btn-danger delete-btn" data-id="${article.id}">Xóa</button>
              </div>
            </div>
          </div>
        `;
  });
  articleContainer.innerHTML = content;
  const editBtn = document.querySelectorAll(".edit-btn");
  editBtn.forEach((btn) => {
    btn.addEventListener("click", function (event) {
      const slug = this.dataset.slug;
      editArticle(slug);
    });
  });
  const deleteBtn = document.querySelectorAll(".delete-btn");
  deleteBtn.forEach((btn) => {
    btn.addEventListener("click", function (event) {
      const id = this.dataset.id;
      deleteArticle(id);
      window.location.reload();
    });
  });
}

function filterArticles(keyword) {
  const filterArticles = allArticles.filter(
    (article) =>
      article.category.includes(keyword) ||
      article.title.includes(keyword) ||
      article.excerpt.includes(keyword) ||
      article.author_name.includes(keyword) ||
      article.tags.includes(keyword) ||
      article.content.includes(keyword),
  );
  return filterArticles;
}

function displayCurrentPage(page) {
  const startIndex = (page - 1) * articlesPerPage;
  const endIndex = startIndex + articlesPerPage;
  const currentArticles = allArticles.slice(startIndex, endIndex);
  displayArticle(currentArticles);
  currentPage = page;
  updatePaginationButtons();
}

function updatePaginationButtons() {
  const paginationContainer = document.querySelector(".pagination");
  paginationContainer.innerHTML = ""; // Xóa nút cũ

  // Nút "Trước"
  if (currentPage > 1) {
    const prevButton = document.createElement("li");
    prevButton.classList.add("page-item");
    prevButton.innerHTML = `<a class="page-link" href="#" aria-label="Previous">
    <span aria-hidden="true">&laquo;</span>
  </a>`;
    prevButton.querySelector("a").addEventListener("click", () => {
      if (currentPage > 1) {
        displayCurrentPage(currentPage - 1);
      }
    });
    paginationContainer.appendChild(prevButton);
  }
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
  if (currentPage < totalPages) {
    const nextButton = document.createElement("li");
    nextButton.classList.add("page-item");
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
}
