<?php
include '../server/import.php'; // Kết nối cơ sở dữ liệu
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product - SLap Admin Dashboard</title>

    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="./assets/compiled/css/app.css" />
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="./assets/compiled/css/iconly.css" />
    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="/js/adminCheck.js"></script>
</head>

<body style="font-family: Arial, sans-serif;">
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php include "sidebar.html" ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <!-- Nội dung chính -->
            <div class="page-heading">
                <h3>Quản lý Bình luận</h3>
            </div>

            <div class="page-content">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Danh sách bình luận</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="commentTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Bình luận</th>
                                    <th>Ngày</th>
                                    <th>Phản hồi cho</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM tb_data ORDER BY id DESC");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['name']}</td>";
                                    echo "<td>
                                            <form method='POST' action='../server/Q_AEdit.php'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <input type='text' name='comment' value=\"" . htmlspecialchars($row['comment']) . "\">
                                                <input type='submit' value='Sửa' class='btn btn-primary btn-sm mt-1'>
                                            </form>
                                          </td>";
                                    echo "<td>{$row['date']}</td>";
                                    echo "<td>{$row['reply_id']}</td>";
                                    echo "<td><a href='../server/Q_ADelete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Xóa</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Kết thúc nội dung chính -->

        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>
</body>

</html>
