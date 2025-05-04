document.addEventListener("DOMContentLoaded", () => {
  // Kiểm tra xem các nút toggle-product-visibility có được tìm thấy không
  const productButtons = document.querySelectorAll(".toggle-product-visibility");
  productButtons.forEach((button, index) => {
    button.addEventListener("click", async () => {
      const id = button.getAttribute("data-id");
      const isVisible = button.getAttribute("data-visible") === "1";
      const actionText = isVisible ? "ẩn" : "hiển thị";

      Swal.fire({
        title: "Bạn có chắc?",
        text: `Bạn muốn ${actionText} sản phẩm này?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Hủy",
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            const response = await fetch("../server/manage_products.php", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify({ action: "toggle_visibility", id }),
            });
            const data = await response.json();
            if (data.success) {
              Swal.fire("Thành công!", `Sản phẩm đã được ${actionText}.`, "success").then(() => {
                location.reload();
              });
            } else {
              Swal.fire("Lỗi!", data.message || `Không thể ${actionText} sản phẩm.`, "error");
            }
          } catch (error) {
            console.error("Lỗi khi gửi yêu cầu:", error);
            Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
          }
        }
      });
    });
  });

  // Kiểm tra xem các nút toggle-article-visibility có được tìm thấy không
  const articleButtons = document.querySelectorAll(".toggle-article-visibility");
  articleButtons.forEach((button, index) => {
    button.addEventListener("click", async () => {
      const id = button.getAttribute("data-id");
      const isVisible = button.getAttribute("data-visible") === "1";
      const actionText = isVisible ? "ẩn" : "hiển thị";

      Swal.fire({
        title: "Bạn có chắc?",
        text: `Bạn muốn ${actionText} tin tức này?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Hủy",
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            const response = await fetch("../server/manage_articles.php", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify({ action: "toggle_visibility", id }),
            });
            const data = await response.json();
            if (data.success) {
              Swal.fire("Thành công!", `Tin tức đã được ${actionText}.`, "success").then(() => {
                location.reload();
              });
            } else {
              Swal.fire("Lỗi!", data.message || `Không thể ${actionText} tin tức.`, "error");
            }
          } catch (error) {
            console.error("Lỗi khi gửi yêu cầu:", error);
            Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
          }
        }
      });
    });
  });

  // Handle Add Product
  const addProductForm = document.getElementById("add-product-form");
  if (addProductForm) {
    addProductForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const name = document.getElementById("product-name").value;
      const price = document.getElementById("product-price").value;
      const image = document.getElementById("product-image").value;

      try {
        const response = await fetch("../server/manage_products.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ action: "add", name, price, image }),
        });
        const data = await response.json();
        if (data.success) {
          Swal.fire("Thành công!", "Sản phẩm đã được thêm.", "success").then(() => {
            document.getElementById("add-product-form").reset();
            document.querySelector("#addProductModal .btn-close").click();
            location.reload();
          });
        } else {
          Swal.fire("Lỗi!", data.message || "Không thể thêm sản phẩm.", "error");
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  } else {
    console.error("Không tìm thấy add-product-form");
  }

  // Handle Edit Product
  const editProductButtons = document.querySelectorAll(".edit-product");
  editProductButtons.forEach((button) => {
    button.addEventListener("click", async () => {
      const id = button.getAttribute("data-id");
      try {
        const response = await fetch("../server/getProductList.php");
        const products = await response.json();
        const product = products.find((p) => p.id == id);
        if (product) {
          document.getElementById("edit-product-id").value = product.id;
          document.getElementById("edit-product-name").value = product.name;
          document.getElementById("edit-product-price").value = product.price;
          document.getElementById("edit-product-image").value = product.image;
          const modal = new bootstrap.Modal(document.getElementById("editProductModal"));
          modal.show();
        } else {
          Swal.fire("Lỗi!", "Sản phẩm không tồn tại.", "error");
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  });

  const editProductForm = document.getElementById("edit-product-form");
  if (editProductForm) {
    editProductForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const id = document.getElementById("edit-product-id").value;
      const name = document.getElementById("edit-product-name").value;
      const price = document.getElementById("edit-product-price").value;
      const image = document.getElementById("edit-product-image").value;

      try {
        const response = await fetch("../server/manage_products.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ action: "update", id, name, price, image }),
        });
        const data = await response.json();
        if (data.success) {
          Swal.fire("Thành công!", "Sản phẩm đã được cập nhật.", "success").then(() => {
            document.querySelector("#editProductModal .btn-close").click();
            location.reload();
          });
        } else {
          Swal.fire("Lỗi!", data.message || "Không thể cập nhật sản phẩm.", "error");
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  } else {
    console.error("Không tìm thấy edit-product-form");
  }

  // Handle Add Article
  const addArticleForm = document.getElementById("add-article-form");
  if (addArticleForm) {
    addArticleForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const title = document.getElementById("article-title").value;
      const excerpt = document.getElementById("article-excerpt").value;
      const thumbnail = document.getElementById("article-thumbnail").value;
      const slug = document.getElementById("article-slug").value;

      try {
        const response = await fetch("../server/manage_articles.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            action: "add",
            title,
            excerpt,
            thumbnail,
            slug,
          }),
        });
        const data = await response.json();
        if (data.success) {
          Swal.fire("Thành công!", "Tin tức đã được thêm.", "success").then(() => {
            document.getElementById("add-article-form").reset();
            document.querySelector("#addArticleModal .btn-close").click();
            location.reload();
          });
        } else {
          Swal.fire("Lỗi!", data.message || "Không thể thêm tin tức.", "error");
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  } else {
    console.error("Không tìm thấy add-article-form");
  }

  // Handle Edit Article
  const editArticleButtons = document.querySelectorAll(".edit-article");
  editArticleButtons.forEach((button) => {
    button.addEventListener("click", async () => {
      const id = button.getAttribute("data-id");
      try {
        const response = await fetch("../server/getArticleList.php");
        const articles = await response.json();
        const article = articles.find((a) => a.id == id);
        if (article) {
          document.getElementById("edit-article-id").value = article.id;
          document.getElementById("edit-article-title").value = article.title;
          document.getElementById("edit-article-excerpt").value = article.excerpt;
          document.getElementById("edit-article-thumbnail").value = article.thumbnail;
          document.getElementById("edit-article-slug").value = article.slug;
          const modal = new bootstrap.Modal(document.getElementById("editArticleModal"));
          modal.show();
        } else {
          Swal.fire("Lỗi!", "Tin tức không tồn tại.", "error");
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  });

  const editArticleForm = document.getElementById("edit-article-form");
  if (editArticleForm) {
    editArticleForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const id = document.getElementById("edit-article-id").value;
      const title = document.getElementById("edit-article-title").value;
      const excerpt = document.getElementById("edit-article-excerpt").value;
      const thumbnail = document.getElementById("edit-article-thumbnail").value;
      const slug = document.getElementById("edit-article-slug").value;

      try {
        const response = await fetch("../server/manage_articles.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            action: "update",
            id,
            title,
            excerpt,
            thumbnail,
            slug,
          }),
        });
        const data = await response.json();
        if (data.success) {
          Swal.fire("Thành công!", "Tin tức đã được cập nhật.", "success").then(() => {
            document.querySelector("#editArticleModal .btn-close").click();
            location.reload();
          });
        } else {
          Swal.fire("Lỗi!", data.message || "Không thể cập nhật tin tức.", "error");
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  } else {
    console.error("Không tìm thấy edit-article-form");
  }
});
