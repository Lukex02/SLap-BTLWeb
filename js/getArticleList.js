let articles = [];
const urlParams = new URLSearchParams(window.location.search);
const category = urlParams.get("category");

window.onload = fetchAllArticles;

function fetchAllArticles() {
  fetch("/server/getArticleList.php")
    .then((response) => response.json())
    .then((data) => {
      articles = data;
      displayArticle(data);
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
      if (category) {
        fetchFilterArticles(category);
      }
    })
    .catch((error) => console.error("Lỗi khi tải dữ liệu:", error));
}

function displayArticle(data) {
  const articleContainer = document.getElementById("articles-container");
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
          <div class="${index < 3 && data.length > 3 ? "col-xxl-3" : "col-3"}"> 
            <img src="${article.thumbnail}" class="img-fluid w-100" alt="${article.title}">              
          </div>
          <div class="col">
            <div class="article-meta"> 
              <h3><a href="/article?slug=${article.slug}">${article.title}</a></h3>
              ${new Date(article.published_at).toLocaleDateString()} |
              <strong>Lượt thích:</strong> ${article.likes} |
              <strong>Tác giả:</strong> ${article.author_name}
              <h5 class="article-excerpt mt-3">${article.excerpt}</h5>
            </div>
          </div>
        </div>
        `;
    if (index < 3 && data.length > 3) {
      content += `</div>`;
    }
    if (index == 2 && data.length > 3) {
      content += "</div>";
    }
  });
  articleContainer.innerHTML = content;
}

function fetchFilterArticles(keyword) {
  document.getElementById(
    "breadcrumb-list",
  ).innerHTML = `<li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
    <li class="breadcrumb-item"><a href="/articleList">Tin tức chung</a></li>
    <li class="breadcrumb-item active">${category}</li>
    `;
  const filterArticles = articles.filter((article) => article.category.includes(keyword));
  displayArticle(filterArticles);
}
