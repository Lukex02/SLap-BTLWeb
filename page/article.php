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
            <p><strong>Lượt thích:</strong> ${article.likes}</p>
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
                <div class="d-flex mb-4">
                  <div class="d-flex flex-column justify-content-start me-2">
                    <img src="/pic/def_author_avatar.png" alt="Avatar của bạn" class="rounded-circle comment-avatar">
                    <span class="text-center">Bạn</span>
                  </div>
                  <textarea class="form-control"  id="exampleFormControlTextarea1" rows="3"></textarea>
                  <button type="button" class="btn btn-primary">Primary</button>
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
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>