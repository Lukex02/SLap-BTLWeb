<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product - SLap Admin Dashboard</title>

    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png" />

    <link rel="stylesheet" href="./assets/compiled/css/app.css" />
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="/css/articleList.css" />
</head>


<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php include "sidebar.html" ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <!-- Từ đây là code của phần nội dung chính -->
            <section class="section">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Danh sách các bài viết</h2>
                            </div>
                            <div class="m-3" id="articles-container"></div>
                            <button class="btn btn-primary m-3" id="new-article-btn">Thêm bài viết mới</button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section" id="article-editor" style="display: none;">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Editor</h2>
                            </div>
                            <form id="edit-form" class="card-body" method="POST" enctype="multipart/form-data">
                                <input id="article-id" name="article-id" type="hidden" />
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label" for="title">Tiêu đề</label>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                        <input type="text" id="title" class="form-control" name="title"
                                            placeholder="Tiêu đề..." />
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label" for="author">Tác giả</label>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                        <input type="text" id="author" class="form-control" name="author"
                                            placeholder="Nguyễn Văn A" />
                                    </div>
                                </div>
                                <input id="thumbnail-old" name="thumbnail-old" type="hidden" />
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label" for="thumbnail">Thumbnail</label>
                                    </div>
                                    <fieldset class="col-lg-10 col-9">
                                        <div class="input-group">
                                            <div class="input-group">
                                                <label class="input-group-text" for="thumbnail"><i
                                                        class="bi bi-upload"></i></label>
                                                <input type="file" class="form-control" id="thumbnail" name="thumbnail"
                                                    accept=".jpg,.jpeg,.png" />
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label" for="tag-input">Tags</label>
                                        <div id="tag-container" class="mb-2"></div>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                        <input type="text" id="tag-input" class="form-control" name="tags"
                                            placeholder="Nhập tag và Enter (<16 ký tự)" maxlength="15" />
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label" for="category">Chuyên mục</label>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                        <input type="text" id="category" class="form-control" name="category"
                                            placeholder="VD: Laptop, PC,..." />
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label" for="excerpt">Đoạn trích</label>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                        <input type="text" id="excerpt" class="form-control" name="excerpt"
                                            placeholder="Tóm tắt về..." />
                                    </div>
                                </div>
                                <label class="mb-3 fw-bold" for="default">Nội dung</label>
                                <textarea name="edit-content" id="default" cols="30" rows="10"></textarea>
                                <div class="d-flex justify-content-end mt-3 gap-3">
                                    <button class="btn btn-danger" id="cancel-edit-btn">Hủy chỉnh sửa</button>
                                    <button type="submit" class="btn btn-success" id="publish-btn">Đăng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Hết phần phần nội dung chính -->
    </div>

    <!-- Còn lại là template giữ nguyên -->
    </div>
    <script>
        // Load on reload
        document.addEventListener('DOMContentLoaded', function () {
            const cancelBtn = document.getElementById("cancel-edit-btn");
            const newBtn = document.getElementById("new-article-btn");

            cancelBtn.addEventListener('click', function (event) {
                event.preventDefault()
                document.getElementById('article-editor').style.display = 'none';
                tinymce.get('default').setContent("");
            })
            newBtn.addEventListener('click', function (event) {
                event.preventDefault()
                window.location.href = '#article-editor'
                document.getElementById('article-editor').style.display = 'block';
                uploadArticle()
            })
            // Lấy tiêu đề / thông tin chung của mọi bài viết
            fetch("/server/getArticleList.php")
                .then((response) => response.json())
                .then((data) => {
                    const container = document.getElementById("articles-container");
                    container.innerHTML = data
                        .map(
                            (article, index) => `
          <div class="article-item d-flex justify-content-between">
            <img src="${article.thumbnail}" class="img-fluid" alt="${article.title}">
            <div class="article-meta">
              <h3><a href="#">${article.title}</a></h3>
              <p>Đường dẫn: ${article.slug}<p>
              <strong>Đăng vào: </strong> ${new Date(article.published_at).toLocaleString()} |
              <strong>Cập nhật lần cuối:</strong> ${new Date(article.updated_at).toLocaleString()} |
              <strong>Lượt xem:</strong> ${article.views} |
              <strong>Tác giả:</strong> ${article.author_name}
              <p class="article-excerpt mt-3">${article.excerpt}</p>
            </div>
            <div class="d-flex ms-auto my-auto flex-column gap-3">
                <button class="btn btn-warning edit-btn text-nowrap" data-slug="${article.slug}">Chỉnh sửa</button>
                <button class="btn btn-danger delete-btn" data-id="${article.id}">Xóa</button>
            </div>
          </div>
        `,)
                        .join("");
                    const editBtn = document.querySelectorAll('.edit-btn')
                    editBtn.forEach((btn) => {
                        btn.addEventListener('click', function (event) {
                            const slug = this.dataset.slug;
                            editArticle(slug)
                        })
                    });
                    const deleteBtn = document.querySelectorAll('.delete-btn')
                    deleteBtn.forEach((btn) => {
                        btn.addEventListener('click', function (event) {
                            const id = this.dataset.id;
                            deleteArticle(id)
                            window.location.reload()
                        })
                    });
                })
                .catch((error) => console.error("Lỗi khi tải dữ liệu ở trang ArticleAdmin:", error));
        })
        // Process display specific article
        function editArticle(articleSlug) {
            fetch("/server/getArticle.php?slug=" + articleSlug)
                .then((response) => response.json())
                .then((data) => {
                    if (data) {
                        window.location.href = '#article-editor'
                        const { article } = data
                        const idElement = document.getElementById("article-id");
                        idElement.value = article.id

                        const titleElement = document.getElementById("title")
                        titleElement.value = article.title

                        const authorElement = document.getElementById("author")
                        authorElement.value = article.author_name

                        const thumbnailElement = document.getElementById("thumbnail-old")
                        thumbnailElement.value = article.thumbnail

                        tags.splice(0, tags.length);
                        tags.push(...article.tags.split(','))
                        renderTags()

                        const categoryElement = document.getElementById("category")
                        categoryElement.value = article.category

                        const excerptElement = document.getElementById("excerpt")
                        excerptElement.value = article.excerpt

                        const articleDetail = `${article.content}`;
                        document.getElementById('article-editor').style.display = 'block';

                        // Set nội dung mới vào TinyMCE
                        tinymce.get('default').setContent(articleDetail);
                    }
                })
                .catch((error) => console.error("Lỗi tải dữ liệu:", error));
        }
        // Process template for uploading new article
        function uploadArticle() {
            const idElement = document.getElementById("article-id");
            idElement.value = null

            const titleElement = document.getElementById("title")
            titleElement.value = null

            const authorElement = document.getElementById("author")
            authorElement.value = null

            const thumbnailElement = document.getElementById("thumbnail")
            thumbnailElement.value = null

            tags.splice(0, tags.length);
            renderTags()

            const categoryElement = document.getElementById("category")
            categoryElement.value = null

            const excerptElement = document.getElementById("excerpt")
            excerptElement.value = null
            document.getElementById('article-editor').style.display = 'block';
            tinymce.get('default').setContent("");
        }
        // Delete Articles
        function deleteArticle(id) {
            fetch("/server/deleteArticle.php?id=" + id)
                .then((response) => response.text())
                .then((data) => {
                    if (data) {
                        console.log("Xóa thành công", data)
                    }
                })
                .catch((error) => console.error("Lỗi tải dữ liệu:", error));
        }
        // Edit Form process
        document.getElementById('edit-form').addEventListener('submit', function (event) {
            event.preventDefault();
            // Input ẩn cho tags
            const tagElement = document.createElement("input") // For store in form only
            tagElement.setAttribute('type', 'hidden');
            tagElement.setAttribute('name', 'tags')
            tagElement.setAttribute('value', tags.reduce((prev, curr) => prev == "" ? curr : prev + "," + curr, "", tags));

            // Content trong tinymce editor
            const content = tinymce.get('default').getContent();
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'tinymce_content');
            hiddenInput.setAttribute('value', content);

            this.appendChild(hiddenInput);
            this.appendChild(tagElement);
            const formData = new FormData(this);

            fetch("/server/setArticle.php", {
                method: this.method,
                body: formData
            }).then(response => response.text())
                .then(data => {
                    console.log('Phản hồi từ server:', data);
                })
                .catch(error => {
                    console.error('Lỗi khi gửi form:', error);
                })
        })

        // Tags process
        const tagInput = document.getElementById('tag-input');
        const tagContainer = document.getElementById('tag-container');
        const tags = [];

        function renderTags() {
            tagContainer.innerHTML = '';
            tags.forEach((tag, index) => {
                const tagElement = document.createElement('p');
                tagElement.className = 'badge bg-primary rounded-pill me-1 mb-1';
                tagElement.innerHTML = `${tag} <span style="cursor: pointer;" onclick="removeTag(${index})">&times;</span>`;
                tagContainer.appendChild(tagElement);
            });
        }

        function removeTag(index) {
            tags.splice(index, 1);
            renderTags();
        }

        tagInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && this.value.trim() !== '') {
                e.preventDefault();
                const value = this.value.trim();
                if (!tags.includes(value)) {
                    tags.push(value);
                    renderTags();
                }
                this.value = '';
            }
        });
    </script>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="assets/compiled/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/tinymce/tinymce.min.js"></script>
    <script src="assets/static/js/pages/tinymce.js"></script>
</body>

</html>