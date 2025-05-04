<?php
$conn = new mysqli('localhost', 'root', '', 'slap');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM intro_content WHERE id = 1");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Giới Thiệu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/css/breadcrumb.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="/css/gioithieu.css" />
</head>

<body>
  <?php include "navbar.html"; ?>

  <main class="intro-main">
    <div class="container-lg py-5">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
        </ol>
      </nav>

      <section class="intro-section shadow-lg rounded-4 overflow-hidden">
        <div class="row g-0">
          <div class="col-md-6 order-md-2 intro-image-wrapper">
            <img src="/pic/<?php echo htmlspecialchars($data['image']); ?>" 
                 alt="Ảnh giới thiệu" 
                 class="intro-image img-fluid h-100">
          </div>
          
          <div class="col-md-6 order-md-1 intro-content-wrapper">
            <div class="p-5">
              <h1 class="display-5 fw-bold mb-4"><?php echo htmlspecialchars($data['title']); ?></h1>
              <div class="intro-text lead">
                <?php echo nl2br(htmlspecialchars($data['content'])); ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <?php include "footer.html"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>