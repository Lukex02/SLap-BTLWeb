<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản Lý Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/css/articleList.css" />
    <link rel="stylesheet" href="./assets/compiled/css/app.css" />
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" crossorigin="" href="./assets/compiled/css/extra-component-sweetalert.css" />
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

    <script src="../js/admin.js"></script>
</body>
</html>