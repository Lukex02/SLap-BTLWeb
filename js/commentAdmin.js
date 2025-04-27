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

document.addEventListener("DOMContentLoaded", function () {
  // Lấy tiêu đề và những comment của bài viết đó
  fetch("/server/getCommentList.php")
    .then((response) => response.json())
    .then((data) => {
      const commentContainer = document.getElementById("comment-container");
      commentContainer.innerHTML = Object.keys(data)
        .map((articleId) => {
          const { article_title, comments } = data[articleId];

          // return comments
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
                                class="list-group-item-text text-truncate">${comment.commenter_name}</span>
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

          return `
            <div class="accordion accordion-flush" id="accordion${articleId}">
              <div class="accordion-item">
                <h2 class="accordion-header bg-body-tertiary">
                  <button class="accordion-button collapsed bg-body" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse${articleId}" aria-expanded="false" aria-controls="flush-collapse${articleId}">
                    <span class="fst-italic text-body">${article_title}</span>
                  </button>
                </h2>
                <div id="flush-collapse${articleId}" class="accordion-collapse collapse show" data-bs-parent="#accordion${articleId}">
                ${commentsInArticle}
                </div>
              </div>
            </div>
            `;
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
