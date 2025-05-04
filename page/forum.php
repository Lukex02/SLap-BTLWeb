
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="/css/forum.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "navbar.html" ?>

<main class="container py-4">
    <h2 class="text-center mb-4">Diễn Đàn Góp Ý</h2>

    <?php
    $conn = new mysqli("localhost", "root", "", "slap");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        $date = date('Y-m-d H:i:s');
        $reply_id = isset($_POST["reply_id"]) ? intval($_POST["reply_id"]) : 0;

        $stmt = $conn->prepare("INSERT INTO tb_data (name, comment, date, reply_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $name, $comment, $date, $reply_id);
        $stmt->execute();
        $stmt->close();
    }

    $result = $conn->query("SELECT * FROM tb_data WHERE reply_id = 0 ORDER BY id DESC");

    function showComment($data, $conn) {
        ?>
        <div class="comment card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($data['name']); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($data['date']); ?></h6>
                <p class="card-text"><?php echo nl2br(htmlspecialchars($data['comment'])); ?></p>
                <button class="btn btn-sm btn-outline-primary" onclick="reply(<?php echo $data['id']; ?>, '<?php echo addslashes($data['name']); ?>')">Trả lời</button>

                <?php
                $reply_id = $data['id'];
                $stmt = $conn->prepare("SELECT * FROM tb_data WHERE reply_id = ? ORDER BY id ASC");
                $stmt->bind_param("i", $reply_id);
                $stmt->execute();
                $replies = $stmt->get_result();

                if ($replies->num_rows > 0) {
                    while ($reply = $replies->fetch_assoc()) {
                        ?>
                        <div class="reply ms-4 mt-3 border-start ps-3">
                            <h6><?php echo htmlspecialchars($reply['name']); ?></h6>
                            <small class="text-muted"><?php echo htmlspecialchars($reply['date']); ?></small>
                            <p><?php echo nl2br(htmlspecialchars($reply['comment'])); ?></p>
                            <button class="btn btn-sm btn-outline-secondary" onclick="reply(<?php echo $reply['id']; ?>, '<?php echo addslashes($reply['name']); ?>')">Trả lời</button>
                        </div>
                        <?php
                    }
                }
                $stmt->close();
                ?>
            </div>
        </div>
        <?php
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            showComment($row, $conn);
        }
    } else {
        echo "<p class='text-muted'>Chưa có bình luận nào.</p>";
    }

    $conn->close();
    ?>

    <form action="" method="POST" class="comment-form mt-4">
        <h4 id="form-title">Để lại bình luận</h4>
        <input type="hidden" name="reply_id" id="reply_id" value="0">
        <div class="mb-3">
            <input type="text" name="name" id="username-input" class="form-control" placeholder="Tên của bạn" required>
        </div>
        
        <div class="mb-3">
            <textarea name="comment" class="form-control" placeholder="Nội dung bình luận" required></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Gửi</button>
    </form>
</main>

<?php include "footer.html" ?>

<script>
    function reply(id, name) {
        document.getElementById('form-title').innerText = "Trả lời " + name;
        document.getElementById('reply_id').value = id;
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    }

    // Fetch session info and autofill username
    fetch("/server/session.php")
        .then((response) => response.json())
        .then((data) => {      
            if (data.success) {
                const usernameInput = document.getElementById("username-input");
                if (usernameInput && data.username) {
                    usernameInput.value = data.username;
                    usernameInput.readOnly = true; // Optional
                }
            } else {
                console.log(data.message);
            }
        })
        .catch((error) => console.error("Lỗi tải dữ liệu:", error));
</script>
</body>
</html>
