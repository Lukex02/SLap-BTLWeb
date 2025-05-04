<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bài viết</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/css/article.css" />
  <link rel="stylesheet" href="/css/breadcrumb.css" />
</head>

<body>
  <!-- Navigation -->
  <?php include "navbar.html" ?>

  <!-- Article Content -->
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="/articleList">Bài viết</a></li>
        <li class="breadcrumb-item active" id="article-title"></li>
      </ol>
    </nav>
    <div class="row">
      <article id="article">
        <!-- Bài viết sẽ được hiển thị ở đây -->
      </article>
    </div>
  </div>
  <script>
    // Lấy thông tin bài viết từ URL
    const urlParams = new URLSearchParams(window.location.search);
    const articleSlug = urlParams.get("slug");
    document.getElementById("article-title").innerHTML = articleSlug;

    fetch("/server/getArticle.php?slug=" + articleSlug)
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          displayArticle(data);
        } else {
          document.getElementById("article").innerHTML =
            "<p>Không tìm thấy bài viết.</p>";
        }
      })
      .catch((error) => console.error("Lỗi tải dữ liệu:", error));

    function displayArticle({ article, comments }) {
      const articleDetail = document.getElementById("article");
      const title = document.title = article.title;

      articleDetail.innerHTML = `
          <header class="article-header">
            <h1>${article.title}</h1>
          </header>
          <div class="article-meta">
            <p><strong>Tác giả:</strong> ${article.author_name}</p>
            <p><strong>Ngày đăng:</strong> ${new Date(article.published_at).toLocaleDateString()}</p>
            <p><strong>Chuyên mục:</strong> ${article.category}</p>
            <p><strong>Lượt thích:</strong> ${article.likes}
              <a href="#" id="like"><i class="bi bi-hand-thumbs-up-fill"></i></a>
            </p>
          </div>
          <div class="article-content">
            ${article.content}
          </div>
          <footer class="article-footer">
            <div class="card mb-3">
              <div class="card-header">
                <h3>Bình luận (${article.comments_count})</h3>
              </div>
              <div class="card-body">
                <form class="d-flex mb-3 visually-hidden" id="comment-form">
                  <div class="d-flex flex-column justify-content-start me-2">
                    <img alt="Avatar của bạn" class="rounded-circle comment-avatar" id="userAvatar">
                    <span class="text-center">Bạn</span>
                  </div>
                  <div class="d-flex flex-column w-100 gap-3">
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Leave a comment here" id="comment-content"></textarea>
                      <label for="comment-content">Comments</label>
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary">Đăng</button>
                    </div>
                  </div>
                </form>
                <div class="d-flex justify-content-end" id="signInToCommentBtn">
                  <a role="button" href="/signin" class="btn btn-primary">Đăng nhập để bình luận</a>
                </div>
                <ul class="comment-list list-group list-group-flush">
                  ${comments.map(comment => `
                  <li class="comment list-group-item d-flex py-3">
                    <img src="${comment.commenter_avatar}" alt="${comment.commenter_name}" class="rounded-circle comment-avatar me-2">
                    <div class="comment-body">
                      <p class="mb-1"><strong>${comment.commenter_name}</strong>: ${comment.content}</p>
                      <small>${new Date(comment.created_at).toLocaleString()}</small>
                    </div>
                  </li>
                `).join("")}
                </ul>
              </div>
            </div>
          </footer>
          `;

      document.getElementById("like").addEventListener("click", function () {
        const param = new URLSearchParams()
        param.append("id", article.id)
        fetch("/server/likeArticle.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded' // Quan trọng
          },
          body: param.toString(),
        })
          .then((response) => response.text())
          .then((data) => {
            alert(data)
            window.location.reload()
          })
      })

      fetch("/server/session.php")
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            const commentForm = document.getElementById("comment-form")
            commentForm.classList.remove("visually-hidden");
            const signInToCommentBtn = document.getElementById("signInToCommentBtn")
            signInToCommentBtn.classList.add("visually-hidden");
            document.getElementById("userAvatar").src = data.avatar // Add user avatar

            commentForm.addEventListener("submit", (e) => {
              e.preventDefault();
              const commentContent = document.getElementById("comment-content").value
              if (commentContent.length <= 0) {
                alert("Bạn chưa nhập nội dung bình luận")
                return
              }

              // Lấy dữ liệu từ form
              const commentFormData = {
                content: commentContent,
                article_id: article.id,
              };
              fetch("/server/setComment.php", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
                body: JSON.stringify({
                  content: commentFormData.content,
                  article_id: commentFormData.article_id,
                }),
              })
                .then((response) => response.json())
                .then((data) => {
                  if (data.success) {
                    alert(data.message)
                    window.location.reload();
                  } else {
                    console.log(data.message)
                  }
                })
                .catch((err) => console.error(err))
                .catch((err) => console.error(err))
            })
          }
        })
        .catch((error) => console.error("Lỗi tải dữ liệu:", error));


    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>