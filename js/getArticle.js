function fetchPosts() {
  const posts = fetch("/data/example_article.json")
    .then((response) => response.json())
    .then((data) => {
      const container = document.getElementById("posts-container");
      container.innerHTML = data
        .map(
          (post) => `
            <div class="post">
                <img src="${post.thumbnail}" alt="${post.title}">
                <h2><a href="/article?slug=${post.slug}">${post.title}</a></h2>
            <p class="post-meta">
                <strong>Tác giả:</strong> ${post.author.name} |
                <strong>Danh mục:</strong> ${post.category.name} |
                <strong>Ngày đăng:</strong> ${new Date(
                  post.published_at,
                ).toLocaleDateString()} |
                <strong>Lượt xem:</strong> ${post.views}
            </p>
            <p>${post.excerpt}</p>
            <a href="/article?slug=${post.slug}">Đọc tiếp</a>
        </div>
    `,
        )
        .join("");
    })
    .catch((error) => console.error("Lỗi khi tải dữ liệu:", error));
}

window.onload = fetchPosts;
