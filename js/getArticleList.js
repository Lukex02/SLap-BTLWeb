function fetchArticles() {
  const articles = fetch("/server/getArticleList.php")
    .then((response) => response.json())
    .then((data) => {
      const container = document.getElementById("articles-container");
      container.innerHTML = data
        .map(
          (article) => `
          <div class="article-item d-flex">
            <img src="${article.thumbnail}" class="img-fluid" alt="${article.title}">
            <div class="article-meta">
              <h3><a href="/article?slug=${article.slug}">${article.title}</a></h3>
              ${new Date(article.published_at).toLocaleDateString()} |
              <strong>Lượt xem:</strong> ${article.views} |
              <strong>Tác giả:</strong> ${article.author_name}
              <h5 class="article-excerpt mt-3">${article.excerpt}</h5>
            </div>
          </div>
        `,
        )
        .join("");
    })
    .catch((error) => console.error("Lỗi khi tải dữ liệu:", error));
}

window.onload = fetchArticles;
