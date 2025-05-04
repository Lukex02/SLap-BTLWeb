<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - SLap Admin Dashboard</title>

    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmCvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmCvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRib249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2kldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/css/articleList.css" />
    <link rel="stylesheet" href="./assets/compiled/css/app.css" />
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css" />
</head>

<body style="font-family: Arial, sans-serif;">
    <script src="assets/static/js/initTheme.js"></script>

    <div id="app">
        <aside class="sidebar">
            <?php include "sidebar.html"; ?>
        </aside>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Quản Lý Sản Phẩm & Tin Tức</h3>
            </div>

            <!-- Products Section -->
            <div class="mt-4">
                <h4>Danh Sách Sản Phẩm</h4>
                <!-- <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Thêm Sản
                    Phẩm</button> -->
                <table class="table table-bordered" id="product-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Hình Ảnh</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../server/import.php';

                        $records_per_page = 10;
                        $page = isset($_GET['product_page']) ? (int) $_GET['product_page'] : 1;
                        $page = max(1, $page);
                        $offset = ($page - 1) * $records_per_page;

                        $count_sql = "SELECT COUNT(*) as total FROM products";
                        $count_result = $conn->query($count_sql);
                        $total_records = $count_result->fetch_assoc()['total'];
                        $total_pages = ceil($total_records / $records_per_page);

                        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT ? OFFSET ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ii", $records_per_page, $offset);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $index = $offset + 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $index++ . "</td>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                                echo "<td><img src='" . htmlspecialchars($row['image']) . "' alt='Product' width='50' /></td>";
                                echo "<td>" . ($row['is_visible'] ? "Hiển thị" : "Ẩn") . "</td>";
                                echo "<td>";
                                // echo "<button class='btn btn-warning btn-sm edit-product' data-id='" . $row['id'] . "'>Sửa</button> ";
                                echo "<button class='btn " . ($row['is_visible'] ? "btn-secondary" : "btn-primary") . " btn-sm toggle-product-visibility' data-id='" . $row['id'] . "' data-visible='" . $row['is_visible'] . "'>" . ($row['is_visible'] ? "Ẩn" : "Hiển thị") . "</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Không có sản phẩm nào.</td></tr>";
                        }

                        $stmt->close();
                        ?>
                    </tbody>
                </table>

                <nav aria-label="Product page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($page <= 1)
                            echo 'disabled'; ?>">
                            <a class="page-link" href="?product_page=<?php echo $page - 1; ?>">Trước</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if ($i == $page)
                                echo 'active'; ?>">
                                <a class="page-link" href="?product_page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?php if ($page >= $total_pages)
                            echo 'disabled'; ?>">
                            <a class="page-link" href="?product_page=<?php echo $page + 1; ?>">Sau</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Articles Section -->
            <div class="mt-4">
                <h4>Danh Sách Tin Tức</h4>
                <!-- <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addArticleModal">Thêm Tin
                    Tức</button> -->
                <table class="table table-bordered" id="article-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tiêu Đề</th>
                            <th>Mô Tả Ngắn</th>
                            <th>Hình Ảnh</th>
                            <th>Slug</th>
                            <th>Trạng Thái</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $page = isset($_GET['article_page']) ? (int) $_GET['article_page'] : 1;
                        $page = max(1, $page);
                        $offset = ($page - 1) * $records_per_page;

                        $count_sql = "SELECT COUNT(*) as total FROM articles WHERE is_visible = 1";
                        $count_result = $conn->query($count_sql);
                        $total_records = $count_result->fetch_assoc()['total'];
                        $total_pages = ceil($total_records / $records_per_page);

                        $sql = "SELECT * FROM articles ORDER BY id DESC LIMIT ? OFFSET ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ii", $records_per_page, $offset);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $index = $offset + 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $index++ . "</td>";
                                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['excerpt']) . "</td>";
                                echo "<td><img src='" . htmlspecialchars($row['thumbnail']) . "' alt='Article' width='50' /></td>";
                                echo "<td>" . htmlspecialchars($row['slug']) . "</td>";
                                echo "<td>" . ($row['is_visible'] ? "Hiển thị" : "Ẩn") . "</td>";
                                echo "<td>";
                                // echo "<button class='btn btn-warning btn-sm edit-article' data-id='" . $row['id'] . "'>Sửa</button> ";
                                echo "<button class='btn " . ($row['is_visible'] ? "btn-secondary" : "btn-primary") . " btn-sm toggle-article-visibility' data-id='" . $row['id'] . "' data-visible='" . $row['is_visible'] . "'>" . ($row['is_visible'] ? "Ẩn" : "Hiển thị") . "</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Không có tin tức nào.</td></tr>";
                        }

                        $stmt->close();
                        $conn->close();
                        ?>
                    </tbody>
                </table>

                <nav aria-label="Article page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if ($page <= 1)
                            echo 'disabled'; ?>">
                            <a class="page-link" href="?article_page=<?php echo $page - 1; ?>">Trước</a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php if ($i == $page)
                                echo 'active'; ?>">
                                <a class="page-link" href="?article_page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?php if ($page >= $total_pages)
                            echo 'disabled'; ?>">
                            <a class="page-link" href="?article_page=<?php echo $page + 1; ?>">Sau</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Add Product Modal -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Thêm Sản Phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="add-product-form">
                                <div class="mb-3">
                                    <label for="product-name" class="form-label">Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" id="product-name" required />
                                </div>
                                <div class="mb-3">
                                    <label for="product-price" class="form-label">Giá</label>
                                    <input type="number" class="form-control" id="product-price" required />
                                </div>
                                <div class="mb-3">
                                    <label for="product-image" class="form-label">URL Hình Ảnh</label>
                                    <input type="text" class="form-control" id="product-image" required />
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Product Modal -->
            <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Sửa Sản Phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-product-form">
                                <input type="hidden" id="edit-product-id" />
                                <div class="mb-3">
                                    <label for="edit-product-name" class="form-label">Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" id="edit-product-name" required />
                                </div>
                                <div class="mb-3">
                                    <label for="edit-product-price" class="form-label">Giá</label>
                                    <input type="number" class="form-control" id="edit-product-price" required />
                                </div>
                                <div class="mb-3">
                                    <label for="edit-product-image" class="form-label">URL Hình Ảnh</label>
                                    <input type="text" class="form-control" id="edit-product-image" required />
                                </div>
                                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Article Modal -->
            <div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addArticleModalLabel">Thêm Tin Tức</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="add-article-form">
                                <div class="mb-3">
                                    <label for="article-title" class="form-label">Tiêu Đề</label>
                                    <input type="text" class="form-control" id="article-title" required />
                                </div>
                                <div class="mb-3">
                                    <label for="article-excerpt" class="form-label">Mô Tả Ngắn</label>
                                    <textarea class="form-control" id="article-excerpt" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="article-thumbnail" class="form-label">URL Hình Ảnh</label>
                                    <input type="text" class="form-control" id="article-thumbnail" required />
                                </div>
                                <div class="mb-3">
                                    <label for="article-slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="article-slug" required />
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Article Modal -->
            <div class="modal fade" id="editArticleModal" tabindex="-1" aria-labelledby="editArticleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editArticleModalLabel">Sửa Tin Tức</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-article-form">
                                <input type="hidden" id="edit-article-id" />
                                <div class="mb-3">
                                    <label for="edit-article-title" class="form-label">Tiêu Đề</label>
                                    <input type="text" class="form-control" id="edit-article-title" required />
                                </div>
                                <div class="mb-3">
                                    <label for="edit-article-excerpt" class="form-label">Mô Tả Ngắn</label>
                                    <textarea class="form-control" id="edit-article-excerpt" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-article-thumbnail" class="form-label">URL Hình Ảnh</label>
                                    <input type="text" class="form-control" id="edit-article-thumbnail" required />
                                </div>
                                <div class="mb-3">
                                    <label for="edit-article-slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="edit-article-slug" required />
                                </div>
                                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts từ template Mazer Dashboard -->
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script>
        // Simple sidebar toggle for mobile
        document.addEventListener('DOMContentLoaded', () => {
            const burgerBtn = document.querySelector('.burger-btn');
            const sidebar = document.querySelector('.sidebar');
            if (burgerBtn && sidebar) {
                burgerBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
                });
            }

            // Thêm logic mở/đóng submenu nếu app.js không hoạt động
            const sidebarItems = document.querySelectorAll('.sidebar-item.has-sub');
            sidebarItems.forEach(item => {
                item.querySelector('.sidebar-link').addEventListener('click', (e) => {
                    e.preventDefault();
                    const isActive = item.classList.contains('active');
                    document.querySelectorAll('.sidebar-item.has-sub').forEach(el => el.classList.remove('active'));
                    if (!isActive) item.classList.add('active');
                });
            });
        });
    </script>
    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="/js/adminCheck.js"></script>

    <script src="../js/admin.js"></script>
</body>
</html>