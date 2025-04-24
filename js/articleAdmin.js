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
      const container = document.getElementById("articles-container");
      container.innerHTML = data
        .map(
          (article, index) => `
          <div class="article-item d-flex justify-content-between">
            <img src="${article.thumbnail}" class="img-fluid" alt="${article.title}">
            <div class="article-meta">
              <h3><a href="#">${article.title}</a></h3>
              <p>Đường dẫn: ${article.slug}<p>
              <strong>Đăng vào: </strong> ${new Date(article.published_at).toLocaleString()} |
              <strong>Cập nhật lần cuối:</strong> ${new Date(article.updated_at).toLocaleString()} |
              <strong>Lượt xem:</strong> ${article.views} |
              <strong>Tác giả:</strong> ${article.author_name}
              <p class="article-excerpt mt-3">${article.excerpt}</p>
            </div>
            <div class="d-flex ms-auto my-auto flex-column gap-3">
                <button class="btn btn-warning edit-btn text-nowrap" data-slug="${
                  article.slug
                }">Chỉnh sửa</button>
                <button class="btn btn-danger delete-btn" data-id="${article.id}">Xóa</button>
            </div>
          </div>
        `,
        )
        .join("");
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
  fetch("/server/deleteArticle.php?id=" + id)
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
