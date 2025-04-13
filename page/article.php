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
    // Lấy thông tin sản phẩm từ URL
    const urlParams = new URLSearchParams(window.location.search);
    const articleSlug = urlParams.get("slug");
    document.getElementById("article-title").innerHTML = articleSlug;

    fetch("/admin/getArticle.php?slug=" + articleSlug)
      .then((response) => response.json())
      .then((data) => {
        if (data) {
          console.log(data);
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
            <p><strong>Lượt xem:</strong> ${article.views} - <strong>Thích:</strong> ${article.likes}</p>
          </div>
          <div class="article-content">
            ${article.content}
          </div>
          <footer class="article-footer">
            <h3>Bình luận (${article.comments_count})</h3>
            <ul class="comment-list">
              ${comments.map(comment => `
                <li class="comment d-flex mt-4">
                  <img src="/pic/user.png" alt="${comment.commenter_name}" class="comment-avatar">
                  <div class="comment-body">
                    <p class="mb-1"><strong>${comment.commenter_name}</strong>: ${comment.content}</p>
                    <small>${new Date(comment.created_at).toLocaleString()}</small>
                  </div>
                </li>
              `).join("")}
            </ul>
          </footer>
          `;
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>