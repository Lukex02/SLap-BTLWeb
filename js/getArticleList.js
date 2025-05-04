function fetchArticles() {
  const articles = fetch("/server/getArticleList.php")
    .then((response) => response.json())
    .then((data) => {
      allArticles = articles = data;
      if (category) {
        articles = filterArticles(category);
      }
      totalPages = Math.ceil(articles.length / articlesPerPage);
      displayCurrentPage(currentPage);
      updatePaginationButtons();
      const topicContainer = document.getElementById("topic-container");
      let topicList = [];
      let topicContent = `<div class="card border border-0 article-meta">
      <div class="card-header">Chủ đề</div>
      <ul class="list-group list-group-flush">`;
      data.forEach((article) => {
        const topic = article.category;
        if (!topicList.includes(topic) && topic != "") {
          const topicHTML = `
          <li class="list-group-item"><a class="category-item" href="/articleList?category=${topic}" data-category="${topic}">${topic}</a></li> 
          `;
          topicContent += topicHTML;
          topicList.push(topic);
        }
      });
      topicContent += `</ul></div>`;
      topicContainer.innerHTML = topicContent;
    })
    .catch((error) => console.error("Lỗi khi tải dữ liệu:", error));
}

function displayArticle(data) {
  let content = "";
  data.forEach((article, index) => {
    if (index == 0 && data.length > 3) {
      content += `<div class="row">`;
    }
    if (index < 3 && data.length > 3) {
      content += `<div class="col-4">`;
    }
    content += `
        <div class="row article-item py-3">
          <div class="${index < 3 && data.length > 3 ? "row-3" : "col-3"}"> 
            <img src="${article.thumbnail}" class="img-fluid w-100" alt="${article.title}">              
          </div>
          <div class="col">
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
