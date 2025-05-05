-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 02:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slap`
--
CREATE DATABASE IF NOT EXISTS `slap` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `slap`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `author_name` varchar(30) DEFAULT NULL,
  `author_avatar` varchar(23) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `tags` mediumtext DEFAULT NULL,
  `published_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `excerpt` longtext DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `likes` int(5) DEFAULT NULL,
  `is_visible` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2050 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `author_name`, `author_avatar`, `category`, `tags`, `published_at`, `updated_at`, `content`, `excerpt`, `thumbnail`, `likes`, `is_visible`) VALUES
(2000, 'Hướng dẫn chọn Laptop', 'huong-dan-chon-laptop', 'Mã Thiên Lý', '/pic/def_author_ava.jpg', 'Laptop', 'laptop,giá rẻ,sinh viên', '2025-04-18 15:59:59', '2025-04-18 16:04:03', '<p>Đừng mua</p>', 'Chọn mua laptop cho sinh viên...', '/pic/prop_laptop.jpg', 1, 1),
(2001, 'abc', 'abc', 'Ẩn danh', '/pic/def_author_ava.jpg', '', '', '2025-04-24 04:16:47', '2025-04-24 04:16:47', '', '', '/pic/prop_laptop.jpg', 0, 1),
(2002, 'Build PC 2025', 'build-pc-2025', 'A Liet', '/pic/def_author_ava.jpg', 'PC', 'pc,build', '2025-04-24 05:28:27', '2025-04-24 05:28:27', '<h1>Wait till 2028 for DDR6</h1>\r\n<h4>Intel might be good</h4>\r\n<p>Maybe atleast <em>32GB</em> <strong>RAM</strong></p>', 'How to build pc in 2025', '/pic/prop_laptop.jpg', 0, 1),
(2004, 'Review chi tiết Laptop Dell XPS 15 2025', 'review-dell-xps-15-2025', 'Hoàng Minh Đức', '/pic/def_author_ava.jpg', 'Laptop', 'laptop,dell,xps', '2025-05-05 10:00:00', '2025-05-05 10:15:30', '<p>Đánh giá toàn diện về Dell XPS 15 phiên bản mới nhất.</p>', 'Laptop cao cấp cho người dùng chuyên nghiệp...', '/pic/prop_laptop.jpg', 0, 1),
(2005, 'So sánh hiệu năng RTX 4080 vs RTX 4090', 'so-sanh-rtx-4080-4090', 'Lê Phương Anh', '/pic/def_author_ava.jpg', 'PC', 'vga,nvidia,so sánh', '2025-05-06 14:30:00', '2025-05-06 14:48:15', '<p>Liệu RTX 4090 có đáng để nâng cấp từ 4080?</p>', 'Phân tích chi tiết hiệu năng card đồ họa...', '/pic/prop_laptop.jpg', 0, 1),
(2006, 'Top 5 bàn phím cơ dưới 2 triệu đồng', 'top-ban-phim-co-duoi-2-trieu', 'Trần Thanh Sơn', '/pic/def_author_ava.jpg', 'Phụ kiện', 'bàn phím cơ,giá rẻ,gaming', '2025-05-07 09:45:00', '2025-05-07 10:02:20', '<p>Những lựa chọn bàn phím cơ ngon bổ rẻ.</p>', 'Bảng xếp hạng các bàn phím cơ đáng mua...', '/pic/prop_laptop.jpg', 0, 1),
(2007, 'Hướng dẫn build PC gaming tầm trung 2025', 'build-pc-gaming-tam-trung', 'Nguyễn Thị Hà', '/pic/def_author_ava.jpg', 'PC', 'pc gaming,build pc,tầm trung', '2025-05-08 16:10:00', '2025-05-08 16:25:45', '<p>Linh kiện và hướng dẫn chi tiết để có bộ PC mạnh mẽ.</p>', 'Xây dựng cấu hình PC gaming tối ưu...', '/pic/prop_laptop.jpg', 0, 1),
(2008, 'Màn hình gaming 240Hz có thực sự cần thiết?', 'man-hinh-gaming-240hz', 'Phạm Văn Hùng', '/pic/def_author_ava.jpg', 'PC', 'màn hình,gaming,240hz', '2025-05-09 08:20:00', '2025-05-09 08:35:50', '<p>Phân tích ưu nhược điểm của màn hình tần số quét cao.</p>', 'Đánh giá màn hình 240Hz cho game thủ...', '/pic/prop_laptop.jpg', 0, 1),
(2009, 'Tản nhiệt khí nào tốt cho CPU Core i7?', 'tan-nhiet-khi-cho-i7', 'Đỗ Ngọc Mai', '/pic/def_author_ava.jpg', 'Linh kiện', 'tản nhiệt khí,cpu,intel', '2025-05-10 11:40:00', '2025-05-10 11:55:15', '<p>Các lựa chọn tản nhiệt hiệu quả cho CPU Intel Core i7.</p>', 'Tư vấn chọn tản nhiệt khí phù hợp...', '/pic/prop_laptop.jpg', 0, 1),
(2010, 'SSD PCIe 5.0: Tốc độ có đáng kinh ngạc?', 'ssd-pcie-5-0-danh-gia', 'Bùi Anh Tuấn', '/pic/def_author_ava.jpg', 'Linh kiện', 'ssd,pcie 5.0,tốc độ cao', '2025-05-04 15:00:00', '2025-05-04 15:12:30', '<p>Đánh giá hiệu năng của ổ cứng SSD chuẩn PCIe 5.0 mới nhất.</p>', 'Khám phá tốc độ truyền dữ liệu siêu nhanh...', '/pic/prop_laptop.jpg', 0, 1),
(2011, 'Case máy tính mini-ITX đẹp và hiệu năng', 'case-mini-itx-dep-hieu-nang', 'Vũ Thu Thủy', '/pic/def_author_ava.jpg', 'PC', 'case,mini-itx,nhỏ gọn', '2025-05-05 09:15:00', '2025-05-05 09:28:05', '<p>Những mẫu case nhỏ gọn nhưng vẫn đảm bảo hiệu suất.</p>', 'Tuyển chọn case mini-ITX ấn tượng...', '/pic/prop_laptop.jpg', 0, 1),
(2012, 'RAM DDR4 vẫn đủ cho gaming 2025?', 'ram-ddr4-cho-gaming-2025', 'Lâm Hoàng Nam', '/pic/def_author_ava.jpg', 'Linh kiện', 'ram,ddr4,gaming', '2025-05-06 13:30:00', '2025-05-06 13:45:40', '<p>Đánh giá vai trò của RAM DDR4 trong hệ thống gaming hiện tại.</p>', 'Phân tích liệu DDR4 còn phù hợp cho game...', '/pic/prop_laptop.jpg', 0, 1),
(2013, 'Mainboard chipset B760: Lựa chọn tốt cho Intel Gen 13?', 'mainboard-b760-intel-gen13', 'Phan Thị Trang', '/pic/def_author_ava.jpg', 'Linh kiện', 'mainboard,intel,b760', '2025-05-07 18:40:00', '2025-05-07 18:52:30', '<p>Tìm hiểu về các tính năng và hiệu năng của mainboard B760.</p>', 'Đánh giá mainboard B760 cho CPU Intel thế hệ 13', '/pic/prop_laptop.jpg', 0, 1),
(2014, 'Khắc phục lỗi màn hình xanh trên Windows 11', 'khac-phuc-loi-man-hinh-xanh-win11', 'Trịnh Xuân Trường', '/pic/def_author_ava.jpg', 'Hệ điều hành', 'windows 11,lỗi,màn hình xanh', '2025-05-08 10:55:00', '2025-05-08 11:10:45', '<p>Các bước chi tiết để sửa lỗi BSOD trên Windows 11.</p>', 'Hướng dẫn từng bước fix lỗi màn hình xanh...', '/pic/prop_laptop.jpg', 0, 1),
(2015, 'Vệ sinh laptop đúng cách tại nhà', 've-sinh-laptop-dung-cach', 'Cao Thị Quỳnh', '/pic/def_author_ava.jpg', 'Laptop', 'vệ sinh,laptop,tự làm', '2025-05-09 15:20:00', '2025-05-09 15:35:00', '<p>Giữ cho laptop luôn sạch sẽ và hoạt động ổn định.</p>', 'Bí quyết vệ sinh laptop an toàn và hiệu quả...', '/pic/prop_laptop.jpg', 0, 1),
(2016, 'So sánh chip Ryzen 7 và Core i7: Ai mạnh hơn?', 'so-sanh-ryzen7-corei7', 'Đặng Văn Mạnh', '/pic/def_author_ava.jpg', 'Linh kiện', 'cpu,ryzen 7,core i7', '2025-05-10 07:30:00', '2025-05-10 07:45:15', '<p>Đánh giá sức mạnh của hai dòng CPU tầm trung cao cấp.</p>', 'Ryzen 7 vs Core i7: Lựa chọn nào tối ưu hơn?...', '/pic/prop_laptop.jpg', 0, 1),
(2017, 'Tối ưu hóa hiệu năng PC để chơi game mượt hơn', 'toi-uu-hoa-pc-cho-gaming', 'Lưu Bích Phương', '/pic/def_author_ava.jpg', 'PC', 'tối ưu hóa,gaming,hiệu năng', '2025-05-04 12:00:00', '2025-05-04 12:15:25', '<p>Các tinh chỉnh giúp PC chơi game không bị lag.</p>', 'Mẹo và thủ thuật tăng FPS trong game...', '/pic/prop_laptop.jpg', 0, 1),
(2018, 'Top phần mềm bảo mật miễn phí tốt nhất 2025', 'phan-mem-bao-mat-mien-phi-2025', 'Hồ Sỹ Cường', '/pic/def_author_ava.jpg', 'Phần mềm', 'bảo mật,miễn phí,antivirus', '2025-05-05 17:45:00', '2025-05-05 18:00:50', '<p>Những ứng dụng giúp bảo vệ máy tính an toàn nhất.</p>', 'Danh sách các phần mềm diệt virus miễn phí hàng', '/pic/prop_laptop.jpg', 0, 1),
(2019, 'Chọn webcam nào cho hội họp trực tuyến?', 'chon-webcam-hoi-hop-truc-tuyen', 'Mai Kiều Anh', '/pic/def_author_ava.jpg', 'Phụ kiện', 'webcam,hội họp,trực tuyến', '2025-05-06 10:10:00', '2025-05-06 10:25:05', '<p>Webcam chất lượng cho các cuộc họp online.</p>', 'Tư vấn chọn webcam cho video conference...', '/pic/prop_laptop.jpg', 0, 1),
(2020, 'Đánh giá tai nghe Bluetooth gaming giá rẻ', 'tai-nghe-bluetooth-gaming-gia-re', 'Ngô Quang Huy', '/pic/def_author_ava.jpg', 'Phụ kiện', 'tai nghe,bluetooth,gaming', '2025-05-07 15:30:00', '2025-05-07 15:45:15', '<p>Những lựa chọn tai nghe không dây cho game thủ với ngân sách eo hẹp.</p>', 'Review các mẫu tai nghe Bluetooth gaming...', '/pic/prop_laptop.jpg', 0, 1),
(2021, 'Ghế công thái học cho game thủ: Đầu tư xứng đáng?', 'ghe-cong-thai-hoc-cho-game-thu', 'Đinh Thùy Linh', '/pic/def_author_ava.jpg', 'Phụ kiện', 'ghế,công thái học,gaming', '2025-05-08 12:40:00', '2025-05-08 12:55:25', '<p>Phân tích lợi ích của ghế ergonomic đối với game thủ.</p>', 'Có nên mua ghế công thái học cho gaming?...', '/pic/prop_laptop.jpg', 0, 1),
(2022, 'Sử dụng hiệu quả bàn phím ảo trên tablet', 'su-dung-ban-phim-ao-tren-tablet', 'Bạch Công Tùng', '/pic/def_author_ava.jpg', 'Tablet', 'bàn phím ảo,tablet,mẹo', '2025-05-09 18:00:00', '2025-05-09 18:12:45', '<p>Các thủ thuật giúp gõ phím ảo nhanh và chính xác.</p>', 'Hướng dẫn tận dụng bàn phím ảo trên tablet...', '/pic/prop_laptop.jpg', 0, 1),
(2023, 'Các dịch vụ lưu trữ đám mây tốt nhất 2025', 'dich-vu-luu-tru-dam-may-2025', 'Trần Thị Diệu', '/pic/def_author_ava.jpg', 'Hướng dẫn', 'lưu trữ đám mây,backup,online', '2025-05-10 09:00:00', '2025-05-10 09:15:55', '<p>So sánh các nền tảng lưu trữ đám mây phổ biến.</p>', 'Top các dịch vụ cloud storage nên dùng...', '/pic/prop_laptop.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) DEFAULT NULL,
  `article_id` int(4) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9931 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `article_id`, `content`, `created_at`) VALUES
(9876, 100001, 2000, 'Bài viết rất hay, cảm ơn tác giả!', '2025-03-17T13:00:00Z'),
(9878, 100003, 2002, 'Rất bổ ích, mình đã học được nhiều điều.', '2025-03-17T13:02:00Z'),
(9879, 100004, 2000, 'Bài viết chi tiết và dễ hiểu, cảm ơn nhiều!', '2025-03-17T13:03:00Z'),
(9882, 100002, 2000, 'Tuyệt vời! Cảm ơn vì bài viết bổ ích.', '2025-03-17T13:06:00Z'),
(9887, 100002, 2002, 'Chủ đề này rất quan trọng, cảm ơn đã chia sẻ.', '2025-03-17T13:11:00Z'),
(9889, 100004, 2001, 'Bài viết giúp mình hiểu rõ hơn, tuyệt vời!', '2025-03-17T13:13:00Z'),
(9890, 100005, 2002, 'Không thể bỏ qua bài viết này, quá hay!', '2025-03-17T13:14:00Z'),
(9908, 100008, 2000, 'wow nice one', '2025-04-28 13:35:53'),
(9909, 100008, 2000, 'thiệt luôn', '2025-04-29 04:31:31'),
(9910, 100008, 2002, 'ok', '2025-05-04 06:16:12'),
(9911, 100003, 2011, 'Bài viết này rất bổ ích, cảm ơn bạn nhiều!', '2025-05-04 21:00:15'),
(9912, 100007, 2005, 'Mình đã tìm hiểu về chủ đề này từ lâu, bài viết rất hay.', '2025-05-04 21:05:30'),
(9913, 100001, 2019, 'Cách giải thích của tác giả rất dễ hiểu.', '2025-05-04 21:10:45'),
(9914, 100005, 2008, 'Mình thấy bài viết này thực sự cần thiết cho mọi người.', '2025-05-04 21:15:00'),
(9915, 100008, 2015, 'Cảm ơn bạn đã chia sẻ những kiến thức giá trị.', '2025-05-04 21:20:15'),
(9916, 100002, 2004, 'Mình đã thử áp dụng theo và có kết quả tốt.', '2025-05-04 21:25:30'),
(9917, 100006, 2022, 'Bài viết rất chi tiết, mình đã hiểu rõ hơn.', '2025-05-04 21:30:45'),
(9918, 100000, 2010, 'Mình rất thích phong cách viết của tác giả.', '2025-05-04 21:35:00'),
(9919, 100004, 2017, 'Đây là một bài viết mà mình sẽ lưu lại để đọc lại.', '2025-05-04 21:40:15'),
(9920, 100007, 2006, 'Mình đã chia sẻ bài viết này trên mạng xã hội.', '2025-05-04 21:45:30'),
(9921, 100001, 2021, 'Nội dung bài viết rất sâu sắc.', '2025-05-04 21:50:45'),
(9922, 100005, 2009, 'Mình hoàn toàn đồng ý với quan điểm của tác giả.', '2025-05-04 21:55:00'),
(9923, 100008, 2013, 'Bài viết này đã mở ra cho mình nhiều ý tưởng mới.', '2025-05-04 22:00:15'),
(9924, 100002, 2018, 'Mình rất mong chờ những bài viết tiếp theo của bạn.', '2025-05-04 22:05:30'),
(9925, 100006, 2007, 'Đây là một bài viết rất đáng để đọc và suy ngẫm.', '2025-05-04 22:10:45'),
(9926, 100000, 2020, 'Mình đã học được rất nhiều điều hay từ bài viết này.', '2025-05-04 22:15:00'),
(9927, 100004, 2004, 'Bài viết này thực sự rất hữu ích cho công việc của mình.', '2025-05-04 22:20:15'),
(9928, 100007, 2016, 'Mình cảm thấy rất vui khi đọc được bài viết này.', '2025-05-04 22:25:30'),
(9929, 100001, 2023, 'Đây là một bài viết mà mình sẽ giới thiệu cho bạn bè.', '2025-05-04 22:30:45'),
(9930, 100005, 2012, 'Mình rất cảm ơn tác giả vì bài viết tâm huyết này.', '2025-05-04 22:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `full_name`, `email`, `phone`, `address`, `message`, `created_at`, `is_read`) VALUES
(1, 'Nguyễn Văn An', 'nguyenvanan@gmail.com', '0905123456', '123 Đường Láng, Đống Đa, Hà Nội', 'Tôi muốn hỏi về dịch vụ của bạn.', '2025-04-01 03:00:00', 0),
(2, 'Trần Thị Bình', 'tranbinh123@yahoo.com', '0987654321', '45 Nguyễn Huệ, TP Huế', 'Vui lòng liên hệ tôi để tư vấn.', '2025-04-02 07:30:00', 0),
(3, 'Lê Minh Châu', 'leminhchau@outlook.com', '0912345678', '78 Trần Phú, Nha Trang, Khánh Hòa', 'Tôi cần hỗ trợ kỹ thuật gấp!', '2025-04-03 02:15:00', 0),
(4, 'Phạm Quốc Đạt', 'phamquocdat@gmail.com', '0935123456', '12 Lê Lợi, Quận 1, TP.HCM', 'Dịch vụ rất tốt, tôi muốn hợp tác lâu dài.', '2025-04-04 09:20:00', 0),
(5, 'Hoàng Thị E', 'hoangthie@hotmail.com', '0978123456', '56 Phạm Văn Đồng, Đà Nẵng', 'Tôi có thắc mắc về giá cả sản phẩm.', '2025-04-05 04:45:00', 0),
(6, 'Đỗ Văn Phong', 'dovanphong@gmail.com', '0923456789', '89 Nguyễn Trãi, Thanh Hóa', 'Làm thế nào để đăng ký dịch vụ?', '2025-04-06 06:00:00', 0),
(7, 'Nguyễn Thị Hồng', 'nguyenhong99@gmail.com', '0965432109', '34 Hùng Vương, Hải Phòng', 'Tôi cần thêm thông tin chi tiết.', '2025-04-07 01:30:00', 0),
(8, 'Trần Quốc Khánh', 'tranquockhanh@outlook.com', '0941234567', '67 Điện Biên Phủ, Bình Thạnh, TP.HCM', 'Dịch vụ của bạn có giao hàng không?', '2025-04-08 08:10:00', 0),
(9, 'Lê Thị Mai', 'lethimai@yahoo.com', '0956789012', '23 Nguyễn Văn Cừ, Cần Thơ', 'Tôi muốn hủy đơn hàng đã đặt.', '2025-04-09 10:00:00', 0),
(10, 'Vũ Văn Nam', 'vuvannam@gmail.com', '0919876543', '90 Lý Thường Kiệt, Đà Lạt', 'Cảm ơn đội ngũ hỗ trợ rất nhiệt tình!', '2025-04-10 05:25:00', 0),
(11, 'abc', 'abc@gmail.com', '123', '102', 'sadfsadf', '2025-05-04 06:05:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `intro_content`
--

DROP TABLE IF EXISTS `intro_content`;
CREATE TABLE IF NOT EXISTS `intro_content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `intro_content`
--

INSERT INTO `intro_content` (`id`, `title`, `content`, `image`) VALUES
(1, 'Chào mừng đến với Slap', 'Đây là trang web bán laptop', 'blockchain.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `brand` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `cpu` varchar(21) DEFAULT NULL,
  `ram` varchar(12) DEFAULT NULL,
  `screen` varchar(5) DEFAULT NULL,
  `gpu` varchar(23) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_visible` tinyint(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand`, `name`, `price`, `cpu`, `ram`, `screen`, `gpu`, `image`, `is_visible`) VALUES
(1, 'LENOVO', 'Laptop Lenovo Legion 5', 25990000, 'Intel Core i7-12700H', '16GB DDR5', '165Hz', 'NVIDIA RTX 3060 6GB', '/pic/product_1.jpg', 1),
(2, 'LENOVO', 'Laptop Lenovo IdeaPad Gaming 3', 19990000, 'AMD Ryzen 5 5600H', '8GB DDR4', '120Hz', 'NVIDIA GTX 1650 4GB', '/pic/product_2.jpeg', 1),
(3, 'LENOVO', 'Laptop Lenovo ThinkPad X1 Gen 10', 42990000, 'Intel Core i7-1260P', '16GB LPDDR5', '60Hz', 'Intel Iris Xe Graphics', '/pic/product_3.jpg', 1),
(4, 'MSI', 'Laptop MSI Katana GF66', 23490000, 'Intel Core i7-12650H', '16GB DDR4', '144Hz', 'NVIDIA RTX 3050 Ti 4GB', '/pic/product_4.jpeg', 1),
(5, 'MSI', 'Laptop MSI Stealth 15M', 37990000, 'Intel Core i7-12700H', '16GB DDR5', '240Hz', 'NVIDIA RTX 3070 Ti 8GB', '/pic/product_5.jpg', 1),
(6, 'MSI', 'Laptop MSI Modern 14', 14990000, 'Intel Core i5-1155G7', '8GB DDR4', '60Hz', 'Intel Iris Xe Graphics', '/pic/product_6.jpg', 1),
(7, 'DELL', 'Laptop Dell XPS 15', 39990000, 'Intel Core i9-12900HK', '32GB DDR5', '120Hz', 'NVIDIA RTX 3050 Ti 4GB', '/pic/product_7.jpg', 1),
(8, 'DELL', 'Laptop Dell Inspiron 16', 17990000, 'Intel Core i5-1240P', '8GB DDR4', '60Hz', 'Intel Iris Xe Graphics', '/pic/product_8.jpg', 1),
(9, 'DELL', 'Laptop Dell Alienware m15 R6', 45990000, 'Intel Core i9-12900H', '32GB DDR5', '240Hz', 'NVIDIA RTX 3080 Ti 12GB', '/pic/product_9.jpeg', 1),
(10, 'HP', 'Laptop HP Omen 16', 27490000, 'AMD Ryzen 7 6800H', '16GB DDR5', '165Hz', 'NVIDIA RTX 3070 Ti 8GB', '/pic/product_10.jpg', 1),
(11, 'HP', 'Laptop HP Victus 15', 18990000, 'Intel Core i5-12500H', '8GB DDR4', '144Hz', 'NVIDIA GTX 1650 4GB', '/pic/product_11.jpg', 1),
(12, 'HP', 'Laptop HP Envy 13', 21490000, 'Intel Core i7-1165G7', '16GB LPDDR4X', '60Hz', 'Intel Iris Xe Graphics', '/pic/product_12.jpg', 1),
(13, 'ASUS', 'Laptop ASUS ROG Strix G15', 29990000, 'AMD Ryzen 9 6900HX', '32GB DDR5', '300Hz', 'NVIDIA RTX 3080 10GB', '/pic/product_13.jpg', 1),
(14, 'ASUS', 'Laptop ASUS TUF Gaming F15', 19990000, 'Intel Core i5-12500H', '8GB DDR4', '144Hz', 'NVIDIA RTX 3050 4GB', '/pic/product_14.jpg', 1),
(15, 'RAZER', 'Laptop Razer Blade 15', 42000000, 'Intel Core i9-13900H', '32GB DDR5', '240Hz', 'NVIDIA GeForce RTX 4070', '/pic/product_68180a16f40527.08887160.jpg', 1),
(16, 'ALIENWARE', 'Alienware m18', 48000000, 'Intel Core i9-13950HX', '32GB DDR5', '165Hz', 'NVIDIA GeForce RTX 4080', '/pic/product_68180a47c8fdd8.04170974.jpg', 1),
(17, 'GIGABYTE', 'Gigabyte AORUS 17X', 45500000, 'Intel Core i9-13900HX', '32GB DDR5', '240Hz', 'NVIDIA GeForce RTX 4070', '/pic/product_68180a690d5439.72452974.jpg', 1),
(18, 'LENOVO', 'Laptop Lenovo Legion Pro 7i', 41000000, 'Intel Core i9-13900HX', '32GB DDR5', '240Hz', 'NVIDIA GeForce RTX 4070', '/pic/product_68180a8cd9b392.26377064.jpg', 1),
(19, 'ASUS', 'Laptop Asus ROG Strix Scar 18', 46500000, 'Intel Core i9-13980HX', '32GB DDR5', '240Hz', 'NVIDIA GeForce RTX 4080', '/pic/product_68180aa088eca7.02952378.jpg', 1),
(20, 'HP', 'Laptop HP Omen 17', 40000000, 'Intel Core i7-13700HX', '16GB DDR5', '144Hz', 'NVIDIA GeForce RTX 4060', '/pic/product_68180abdb2df83.01429363.jpg', 1),
(21, 'MSI', 'Laptop MSI Titan GT77 HX', 65000000, 'Intel Core i9-13980HX', '64GB DDR5', '144Hz', 'NVIDIA GeForce RTX 4090', '/pic/product_68180b0946a674.77594337.jpg', 1),
(22, 'ACER', 'Laptop Acer Predator Helios 18', 47000000, 'Intel Core i9-13900HX', '32GB DDR5', '250Hz', 'NVIDIA GeForce RTX 4080', '/pic/product_68180b21e0d122.94086578.jpg', 1),
(23, 'DELL', 'Laptop Dell Alienware m16', 43500000, 'Intel Core i7-13700HX', '16GB DDR5', '165Hz', 'NVIDIA GeForce RTX 4070', '/pic/product_68180b3a555fa5.14946640.jpeg', 1),
(24, 'SAMSUNG', 'Laptop Samsung Galaxy Book3 Ultra', 38000000, 'Intel Core i7-1360P', '16GB LPDDR5', '120Hz', 'NVIDIA GeForce RTX 4050', '/pic/product_68180b579c0d59.13589309.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_data`
--

DROP TABLE IF EXISTS `tb_data`;
CREATE TABLE IF NOT EXISTS `tb_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `comment` varchar(150) NOT NULL,
  `date` varchar(50) NOT NULL,
  `reply_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_data`
--

INSERT INTO `tb_data` (`id`, `name`, `comment`, `date`, `reply_id`) VALUES
(99, 'long', 'CPU là trái tim của laptop, khả năng sẽ khác nhau tùy thuộc vào model. Ví dụ, một số laptop có thể quản lý các tài liệu Word và trình duyệt web đơn gi', '2025-05-02 19:19:41', 95),
(100, 'tú', 'Chọn  phần cứng laptop phù hợp', '2025-05-02 19:19:57', 0),
(101, 'admin', 'CPU là trái tim của laptop, khả năng sẽ khác nhau tùy thuộc vào model', '2025-05-02 19:20:31', 100),
(102, 'blonk', 'hello', '2025-05-02 20:15:55', 0),
(103, 'Admin', 'chào', '2025-05-04 08:07:13', 0),
(104, 'Admin', 'sup', '2025-05-04 08:07:18', 103),
(105, 'Admin', 'wow', '2025-05-04 08:07:26', 104),
(107, 'Admin', 'gege', '2025-05-04 08:08:11', 102);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT '/pic/def_author_avatar.png',
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `isLock` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=100009 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `isAdmin`, `isLock`) VALUES
(100000, 'ABC', 'abc@gmail.com', '$2y$10$FHQ2QzDj9lA9Uqn9eo.yhuQl9gs27T85DSD.hfvJDqmWklgN.0roq', '/pic/def_author_avatar.png', 0, 0),
(100001, 'NoobMaster96', 'noob.master96@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0, 0),
(100002, 'Master96', 'master96@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0, 0),
(100003, 'Pro100', 'proo100@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0, 0),
(100004, 'MaxVer', 'max.ver@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0, 0),
(100005, 'Jem Bon', 'jem.bon@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0, 0),
(100006, 'Oscar', 'oscar@gmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0, 0),
(100007, 'Bond', 'bond@gmail.com', '$2y$10$IQyx6FwkAf5fEC6ynpsPvu67gaFUEJ6Ioj/qvuhr9gotYcpwdpIIy', '/pic/def_author_avatar.png', 0, 0),
(100008, 'Admin', 'admin@admin.com', '$2y$10$.c4iBSyNv9iVAZQ7ATXL3uQRHX6HBZaUjfQP2RHlOnyHDVuoNw2yi', '/pic/100008_ava_6815f800e7c8a7.30269384.jpg', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
