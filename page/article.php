<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NIKE ADAPT BB - ĐÔI GIÀY CÔNG NGHỆ ĐẾN TỪ TƯƠNG LAI</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/css/articlePage.css" />
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
          <li class="breadcrumb-item"><a href="/index.php">Trang chủ</a></li>
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
      
      fetch("/data/example_article.json")
      .then((response) => response.json())
      .then((data) => {
        const article = data.find((p) => p.slug === articleSlug);
        if (article) {
            displayArticle(article);
          } else {
            document.getElementById("article").innerHTML =
              "<p>Không tìm thấy bài viết.</p>";
          }
        })
        .catch((error) => console.error("Lỗi tải dữ liệu:", error));

      function displayArticle(article) {
        const articleDetail = document.getElementById("article");
        articleDetail.innerHTML = `
          <header class="article-header">
            <h1>${article.title}</h1>
          </header>
          <div class="article-meta">
            <p><strong>Tác giả:</strong> ${article.author.name}</p>
            <p><strong>Ngày đăng:</strong> ${new Date(article.published_at).toLocaleDateString()}</p>
            <p><strong>Chuyên mục:</strong> ${article.category.name}</p>
            <p><strong>Lượt xem:</strong> ${article.views} - <strong>Thích:</strong> ${article.likes}</p>
          </div>
          <div class="article-content">
            ${article.content}
          </div>
          <footer class="article-footer">
            <h3>Bình luận (${article.comments_count})</h3>
            <ul class="comment-list">
              ${article.comments.map(comment => `
                <li class="comment">
                  <img src="${comment.user.avatar}" alt="${comment.user.name}" class="comment-avatar">
                  <div class="comment-body">
                    <p><strong>${comment.user.name}</strong>: ${comment.content}</p>
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
