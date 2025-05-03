console.log("admin.js đã được tải");

document.addEventListener("DOMContentLoaded", () => {
  console.log("DOMContentLoaded kích hoạt");

  // Kiểm tra xem các nút toggle-product-visibility có được tìm thấy không
  const productButtons = document.querySelectorAll(".toggle-product-visibility");
  console.log("Số nút toggle-product-visibility tìm thấy:", productButtons.length);
  productButtons.forEach((button, index) => {
    console.log(`Nút toggle-product-visibility[${index}] - ID: ${button.getAttribute("data-id")}`);
    button.addEventListener("click", async () => {
      const id = button.getAttribute("data-id");
      const isVisible = button.getAttribute("data-visible") === "1";
      const actionText = isVisible ? "ẩn" : "hiển thị";
      console.log(`Nút toggle-product-visibility được nhấn, ID: ${id}, Trạng thái: ${isVisible ? "Hiển thị" : "Ẩn"}`);

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
            console.log("Gửi yêu cầu toggle_visibility, ID:", id);
            const response = await fetch("../server/manage_products.php", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify({ action: "toggle_visibility", id }),
            });
            const data = await response.json();
            console.log("Phản hồi từ server:", data);
            if (data.success) {
              Swal.fire("Thành công!", `Sản phẩm đã được ${actionText}.`, "success");
              location.reload();
            } else {
              Swal.fire(
                "Lỗi!",
                data.message || `Không thể ${actionText} sản phẩm.`,
                "error"
              );
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
  console.log("Số nút toggle-article-visibility tìm thấy:", articleButtons.length);
  articleButtons.forEach((button, index) => {
    console.log(`Nút toggle-article-visibility[${index}] - ID: ${button.getAttribute("data-id")}`);
    button.addEventListener("click", async () => {
      const id = button.getAttribute("data-id");
      const isVisible = button.getAttribute("data-visible") === "1";
      const actionText = isVisible ? "ẩn" : "hiển thị";
      console.log(`Nút toggle-article-visibility được nhấn, ID: ${id}, Trạng thái: ${isVisible ? "Hiển thị" : "Ẩn"}`);

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
            console.log("Gửi yêu cầu toggle_visibility, ID:", id);
            const response = await fetch("../server/manage_articles.php", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify({ action: "toggle_visibility", id }),
            });
            const data = await response.json();
            console.log("Phản hồi từ server:", data);
            if (data.success) {
              Swal.fire("Thành công!", `Tin tức đã được ${actionText}.`, "success");
              location.reload();
            } else {
              Swal.fire(
                "Lỗi!",
                data.message || `Không thể ${actionText} tin tức.`,
                "error"
              );
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
  console.log("Gắn sự kiện cho add-product-form");
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
          Swal.fire("Thành công!", "Sản phẩm đã được thêm.", "success");
          document.getElementById("add-product-form").reset();
          document.querySelector("#addProductModal .btn-close").click();
          location.reload();
        } else {
          Swal.fire(
            "Lỗi!",
            data.message || "Không thể thêm sản phẩm.",
            "error"
          );
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  } else {
    console.error("Không tìm thấy add-product-form");
  }

  // Handle Edit Product
  console.log("Gắn sự kiện cho các nút edit-product");
  const editProductButtons = document.querySelectorAll(".edit-product");
  console.log("Số nút edit-product tìm thấy:", editProductButtons.length);
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
          const modal = new bootstrap.Modal(
            document.getElementById("editProductModal")
          );
          modal.show();
        } else {
          Swal.fire("Lỗi!", "Sản phẩm không tồn tại.", "error");
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  });

  console.log("Gắn sự kiện cho edit-product-form");
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
          Swal.fire("Thành công!", "Sản phẩm đã được cập nhật.", "success");
          document.querySelector("#editProductModal .btn-close").click();
          location.reload();
        } else {
          Swal.fire(
            "Lỗi!",
            data.message || "Không thể cập nhật sản phẩm.",
            "error"
          );
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  } else {
    console.error("Không tìm thấy edit-product-form");
  }

  // Handle Add Article
  console.log("Gắn sự kiện cho add-article-form");
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
          Swal.fire("Thành công!", "Tin tức đã được thêm.", "success");
          document.getElementById("add-article-form").reset();
          document.querySelector("#addArticleModal .btn-close").click();
          location.reload();
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
  console.log("Gắn sự kiện cho các nút edit-article");
  const editArticleButtons = document.querySelectorAll(".edit-article");
  console.log("Số nút edit-article tìm thấy:", editArticleButtons.length);
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
          const modal = new bootstrap.Modal(
            document.getElementById("editArticleModal")
          );
          modal.show();
        } else {
          Swal.fire("Lỗi!", "Tin tức không tồn tại.", "error");
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  });

  console.log("Gắn sự kiện cho edit-article-form");
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
          Swal.fire("Thành công!", "Tin tức đã được cập nhật.", "success");
          document.querySelector("#editArticleModal .btn-close").click();
          location.reload();
        } else {
          Swal.fire(
            "Lỗi!",
            data.message || "Không thể cập nhật tin tức.",
            "error"
          );
        }
      } catch (error) {
        Swal.fire("Lỗi!", "Đã xảy ra lỗi: " + error.message, "error");
      }
    });
  } else {
    console.error("Không tìm thấy edit-article-form");
  }
});