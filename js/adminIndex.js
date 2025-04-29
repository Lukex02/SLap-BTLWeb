var optionsComments = {
  series: [
    {
      name: "Số lượng tài khoản được thành lập",
      data: [310, 800, 600, 430, 540, 340, 605, 805, 430, 540, 340, 605],
    },
  ],
  chart: {
    height: 80,
    type: "area",
    toolbar: {
      show: false,
    },
  },
  colors: ["#5350e9"],
  stroke: {
    width: 2,
  },
  grid: {
    show: false,
  },
  dataLabels: {
    enabled: false,
  },
  xaxis: {
    type: "datetime",
    categories: [
      "2018-09-19T00:00:00.000Z",
      "2018-09-19T01:30:00.000Z",
      "2018-09-19T02:30:00.000Z",
      "2018-09-19T03:30:00.000Z",
      "2018-09-19T04:30:00.000Z",
      "2018-09-19T05:30:00.000Z",
      "2018-09-19T06:30:00.000Z",
      "2018-09-19T07:30:00.000Z",
      "2018-09-19T08:30:00.000Z",
      "2018-09-19T09:30:00.000Z",
      "2018-09-19T10:30:00.000Z",
      "2018-09-19T11:30:00.000Z",
    ],
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    labels: {
      show: false,
    },
  },
  show: false,
  yaxis: {
    labels: {
      show: false,
    },
  },
  tooltip: {
    x: {
      format: "dd/MM/yy HH:mm",
    },
  },
};

// const optionsProducts = {
// series: [70, 30],
// labels: ["Male", "Female"],
// colors: ["#435ebe", "#55c6e8"],
// chart: {
//   type: "donut",
//   width: "100%",
//   height: "350px",
// },
// legend: {
//   position: "bottom",
// },
// plotOptions: {
//   pie: {
//     donut: {
//       size: "30%",
//     },
//   },
// },
// };

document.addEventListener("DOMContentLoaded", function () {
  fetch("/server/session.php")
    .then((response) => response.json())
    .then((data) => {
      const userInfoContainer = document.getElementById("user-info");
      userInfoContainer.querySelector(".avatar img").src = data.avatar;
      userInfoContainer.querySelector("#username").innerHTML = data.username;
      userInfoContainer.querySelector("#usertag").innerHTML = "@" + data.username.toLowerCase();
    });
  fetch("/server/dashboardFetch.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        // Hiển thị thông tin số liệu thống kê cơ bản
        const commentSection = document.getElementById("comment-section");
        commentSection.innerHTML = "";
        data.comments.forEach((comment) => {
          const commentItem = document.createElement("tr");
          commentItem.innerHTML = `
            <td class="col-3">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-md">
                  <img src="${comment.commenter_avatar}" />
                </div>
                <p class="font-bold ms-3 mb-0">${comment.commenter_name}</p>
              </div>
            </td>
            <td class="col-auto">
              <p class="mb-0">${comment.content}</p>
            </td>
            <td class="col-auto">
              <p class="mb-0">${comment.article_title}</p>
            </td>            
          `;
          commentSection.appendChild(commentItem);
        });
        document.getElementById("comment-num").innerHTML = data.comments_count;
        document.getElementById("article-num").innerHTML = data.articles_count;
        document.getElementById("account-num").innerHTML = data.users_count;
        document.getElementById("product-num").innerHTML = data.products_count;
        drawChartProducts();
        drawChartComments();
        drawChartArticles();
      }
    });
});

// Vẽ biểu đồ phân bố hãng sản phẩm
function drawChartProducts() {
  fetch("/server/getProductList.php")
    .then((response) => response.json())
    .then((productData) => {
      const brandCounts = {};
      productData.forEach((product) => {
        const brand = product.brand; // Giả sử mỗi sản phẩm có trường 'brand'
        if (brandCounts[brand]) {
          brandCounts[brand]++;
        } else {
          brandCounts[brand] = 1;
        }
      });
      const brands = Object.keys(brandCounts);
      const counts = Object.values(brandCounts);

      const optionsProducts = {
        series: counts, // Số lượng sản phẩm của mỗi hãng
        chart: {
          width: "100%",
          type: "donut",
          height: 500,
        },
        labels: brands, // Tên các hãng
        legend: {
          position: "bottom",
        },
        colors: ["#180161", "#4F1787", "#EB3678", "FB773C", "#F9C74F", "#A5E06E", "#4D8C6F"],
        plotOptions: {
          pie: {
            donut: {
              size: "30%",
            },
          },
        },
        responsive: [
          {
            breakpoint: 480,
            options: {
              chart: {
                width: 200,
              },
            },
          },
        ],
      };

      var chart = new ApexCharts(document.querySelector("#chart-products"), optionsProducts);
      chart.render();
    });
}

// Vẽ biểu đồ thống kê bình luận
function drawChartComments() {
  fetch("/server/getCommentList.php")
    .then((response) => response.json())
    .then((commentData) => {
      const comments = Object.keys(commentData)
        .map((article_id) => commentData[article_id].comments)
        .flat()
        .reverse();
      const commentCountsByTime = {};
      comments.forEach((comment) => {
        const commentTime = new Date(comment.created_at).toLocaleDateString();

        if (commentCountsByTime[commentTime]) {
          commentCountsByTime[commentTime]++;
        } else {
          commentCountsByTime[commentTime] = 1;
        }
      });

      // Chuyển đổi dữ liệu thành định dạng phù hợp cho ApexCharts
      const chartData = Object.entries(commentCountsByTime).map(([time, count]) => ({
        x: time,
        y: count,
      }));

      // line hoặc bar
      const chartType = "bar";

      // Cấu hình biểu đồ
      const options = {
        series: [
          {
            name: "Số lượng bình luận",
            data: chartData,
          },
        ],
        colors: ["#A0C878"],
        chart: {
          type: chartType,
          height: 300,
          zoom: {
            enabled: true,
          },
        },
        dataLabels: {
          enabled: false, // Tắt hiển thị số liệu trên biểu đồ
        },
        xaxis: {
          type: "category",
          title: {
            text: "Thời gian",
          },
        },
        yaxis: {
          title: {
            text: "Số lượng bình luận",
          },
        },
        tooltip: {
          x: {
            format: "dd/MM/yyyy", // Định dạng hiển thị ngày tháng
          },
        },
      };

      // Tạo và hiển thị biểu đồ
      const chart = new ApexCharts(
        document.querySelector("#chart-comments"), // Đặt ID cho phần tử chứa biểu đồ
        options,
      );
      chart.render();
    });
}

// Vẽ biểu đồ thống kê bài viết
function drawChartArticles() {
  fetch("/server/getArticleList.php")
    .then((response) => response.json())
    .then((articleData) => {
      console.log(articleData);
      const articleCountsByTime = {};
      articleData.forEach((article) => {
        const articleTime = new Date(article.updated_at).toLocaleDateString();

        if (articleCountsByTime[articleTime]) {
          articleCountsByTime[articleTime]++;
        } else {
          articleCountsByTime[articleTime] = 1;
        }
      });

      // Chuyển đổi dữ liệu thành định dạng phù hợp cho ApexCharts
      const chartData = Object.entries(articleCountsByTime).map(([time, count]) => ({
        x: time,
        y: count,
      }));
      // line hoặc bar
      const chartType = "bar";

      // Cấu hình biểu đồ
      const options = {
        series: [
          {
            name: "Số lượng bài viết",
            data: chartData,
          },
        ],
        colors: ["#FB773C"],
        chart: {
          type: chartType,
          height: 300,
          zoom: {
            enabled: true,
          },
        },
        dataLabels: {
          enabled: false, // Tắt hiển thị số liệu trên biểu đồ
        },
        xaxis: {
          type: "category",
          title: {
            text: "Thời gian",
          },
        },
        yaxis: {
          title: {
            text: "Số lượng bài viết",
          },
          labels: {
            formatter: function (value) {
              return Math.round(value); // Làm tròn giá trị về số nguyên
            },
          },
        },
        tooltip: {
          x: {
            format: "dd/MM/yyyy", // Định dạng hiển thị ngày tháng
          },
        },
        legend: {
          position: "bottom",
        },
      };

      // Tạo và hiển thị biểu đồ
      const chart = new ApexCharts(
        document.querySelector("#chart-articles"), // Đặt ID cho phần tử chứa biểu đồ
        options,
      );
      chart.render();
    });
}
