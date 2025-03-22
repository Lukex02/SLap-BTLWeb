<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danh sách bài viết</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/css/articles.css" />
    <script src="/js/getArticle.js"></script>
  </head>
  <body>
    <!-- Navigation -->
    <?php include "navbar.html" ?>

    <!-- Main Content -->
    <div class="container">
      <h1 class="page-title">Tin Tức</h1>

      <!-- Articles List -->
      <div class="container" id="posts-container"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
