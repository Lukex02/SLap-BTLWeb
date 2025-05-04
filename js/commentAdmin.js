const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 2500,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});
let articles = {};
const commentContainer = document.getElementById("comment-container");
const sidebarArticle = document.getElementById("list-article");

document.addEventListener("DOMContentLoaded", function () {
  // Lấy tiêu đề và những comment của bài viết đó
  document.getElementById("menu-all").onmouseover = function () {
    this.style.color = "#007bff";
  };
  document.getElementById("menu-all").onmouseout = function () {
    const propertyName = this.style[0];
    this.style.removeProperty(propertyName);
  };
  fetch("/server/getCommentList.php")
    .then((response) => response.json())
    .then((data) => {
      articles = data;
      commentContainer.innerHTML = Object.keys(data)
        .map((articleId) => {
          const { article_title, comments } = data[articleId];

          const article = document.createElement("a");
          article.href = `#article-${articleId}`;
          article.classList.add("list-group-item");
          article.onmouseover = function () {
            this.style.color = "#007bff";
          };
          article.onmouseout = function () {
            const propertyName = this.style[0];
            this.style.removeProperty(propertyName);
          };
          article.id = `article-${articleId}`;
          article.innerHTML = `
            <span class="d-inline-block text-truncate" style="max-width: 200px;"><i class="bi bi-arrow-return-right"></i> ${article_title}</span>
          `;
          sidebarArticle.appendChild(article);
          // return comments
          return displayComment(articleId);
        })
        .join("");
      addCheckBoxFunc();
    })
    .catch((error) => console.error("Lỗi khi tải dữ liệu ở trang CommentAdmin:", error));

  const commentDeleteBtn = document.getElementById("comment-delete-btn");
  commentDeleteBtn.addEventListener("click", () => deleteComment());
});

function addCheckBoxFunc() {
  const checkAll = document.getElementById("checkAll");
  const itemCheckboxes = document.querySelectorAll(".itemCheckBox");

  checkAll.addEventListener("change", function () {
    itemCheckboxes.forEach((checkbox) => {
      checkbox.checked = this.checked;
    });
  });

  itemCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      const allChecked = Array.from(itemCheckboxes).every((cb) => cb.checked);
      checkAll.checked = allChecked;
    });
  });
}

function deleteComment() {
  const itemCheckboxes = document.querySelectorAll(".itemCheckBox");

  const idList = Array.from(itemCheckboxes)
    .map((checkbox) => {
      if (checkbox.checked) {
        const checkBoxPre = "checkboxsmall";
        return checkbox.id.slice(checkBoxPre.length);
      }
    })
    .filter((id) => id !== undefined);

  if (idList.length > 0) {
    fetch("/server/deleteComment.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ comment_ids: idList }),
    })
      .then((response) => response.text())
      .then((data) => {
        Toast.fire({
          icon: "success",
          title: data,
        }).then(() => {
          window.location.reload();
        });
      })
      .catch((error) => console.error("Lỗi khi xóa comment:", error));
  } else {
    Toast.fire({
      icon: "error",
      title: "Chưa chọn comment nào!",
    });
  }
}

function displayComment(article_id) {
  const article = articles[article_id];
  const comments = article.comments;
  const commentsInArticle = comments
    .map(
      (comment) => `
              <li class="media">
                <div class="user-action">
                    <div class="checkbox-con me-3">
                        <div class="checkbox checkbox-shadow checkbox-sm">
                            <input type="checkbox" id="checkboxsmall${comment.id}"
                                class="form-check-input itemCheckBox" />
                            <label for="checkboxsmall${comment.id}"></label>
                        </div>
                    </div>
                </div>
                <div class="pr-50">
                    <div class="avatar">
                        <img src=${comment.commenter_avatar}
                            alt="avtar img holder" />
                    </div>
                </div>
                <div class="media-body">
                    <div class="user-details">
                        <div class="mail-items">
                            <span
                                class="list-group-item-text text-truncate text-secondary">${
                                  comment.commenter_name
                                }</span>
                        </div>
                        <div class="mail-meta-item">
                            <span class="float-right">
                                <span class="mail-date">${new Date(
                                  comment.created_at,
                                ).toLocaleString()}</span>
                            </span>
                        </div>
                    </div>
                    <div class="mail-message">
                        <p class="list-group-item-text truncate mb-0">
                            ${comment.content}
                        </p>
                        <div class="mail-meta-item">
                            <span class="float-right">
                                <span
                                    class="bullet bullet-success bullet-sm"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </li>
          `,
    )
    .join("");

  return commentsInArticle;
}

function filterComments(article_id) {
  sidebarArticle.querySelector(".active").classList.remove("active");
  sidebarArticle.querySelector(`#article-${article_id}`).classList.add("active");
  const articleTitle = document.getElementById("article-title-display");
  articleTitle.innerHTML = articles[article_id].article_title;
  commentContainer.innerHTML = displayComment(article_id);
  addCheckBoxFunc();
}

window.addEventListener("hashchange", function (e) {
  const hash = window.location.hash;
  const prefix = "#article-";

  if (hash.startsWith(prefix)) {
    const articleIdString = hash.substring(prefix.length);
    const articleIdNumber = parseInt(articleIdString, 10);
    filterComments(articleIdNumber);
  } else {
    // Nếu không có hash, có thể hiển thị tất cả item hoặc trạng thái mặc định
    sidebarArticle.querySelector(".active").classList.remove("active");
    sidebarArticle.querySelector("#menu-all").classList.add("active");

    commentContainer.innerHTML = Object.keys(articles)
      .map((articleId) => {
        return displayComment(articleId);
      })
      .join("");
    addCheckBoxFunc();
  }
});
