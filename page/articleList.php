<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Danh sách bài viết</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/css/articleList.css" />
  <link rel="stylesheet" href="/css/breadcrumb.css" />
</head>

<body>
  <!-- Navigation -->
  <?php include "navbar.html" ?>

  <!-- Main Content -->
  <div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb" id="breadcrumb-list">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item active">Tin tức chung</li>
      </ol>
    </nav>

    <h1 class="page-title">Tin Tức</h1>

    <!-- Articles List -->
    <div class="row">
      <div class="col-md-9">
        <div class="container p-0" id="articles-container"></div>
        <nav aria-label="Page Navigation" class="d-md-flex justify-content-md-end">
          <ul class="pagination"></ul>
        </nav>
      </div>
      <div class="col-md-3">
        <div class="container pe-0" id="topic-container"></div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include "footer.html" ?>

  <script src="/js/getArticleList.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>