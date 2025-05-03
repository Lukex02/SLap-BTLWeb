-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 01:57 PM
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

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(35) DEFAULT NULL,
  `slug` varchar(32) NOT NULL,
  `author_name` varchar(12) DEFAULT NULL,
  `author_avatar` varchar(23) DEFAULT NULL,
  `category` varchar(6) DEFAULT NULL,
  `tags` mediumtext DEFAULT NULL,
  `published_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `excerpt` varchar(47) DEFAULT NULL,
  `thumbnail` varchar(60) DEFAULT NULL,
  `likes` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2050 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `author_name`, `author_avatar`, `category`, `tags`, `published_at`, `updated_at`, `content`, `excerpt`, `thumbnail`, `likes`) VALUES
(2000, 'Hướng dẫn chọn Laptop', 'huong-dan-chon-laptop', 'Mã Thiên Lý', '/pic/def_author_ava.jpg', 'Laptop', 'laptop,giá rẻ,sinh viên', '2025-04-18 15:59:59', '2025-04-18 16:04:03', '<p>Đừng mua</p>', 'Chọn mua laptop cho sinh viên...', '/pic/prop_laptop.jpg', 0),
(2001, 'abc', 'abc', 'Ẩn danh', '/pic/def_author_ava.jpg', '', '', '2025-04-24 04:16:47', '2025-04-24 04:16:47', '', '', '/pic/prop_laptop.jpg', 0),
(2002, 'Build PC 2025', 'build-pc-2025', 'A Liet', '/pic/def_author_ava.jpg', 'PC', 'pc,build', '2025-04-24 05:28:27', '2025-04-24 05:28:27', '<h1>Wait till 2028 for DDR6</h1>\r\n<h4>Intel might be good</h4>\r\n<p>Maybe atleast <em>32GB</em> <strong>RAM</strong></p>', 'How to build pc in 2025', '/pic/prop_laptop.jpg', 0),
(2003, 'Mẹo chọn máy tính', 'meo-chon-may-tinh', 'A Liet', '/pic/def_author_ava.jpg', 'PC', 'pc,build', '2025-04-24 05:28:27', '2025-04-24 05:28:27', '<h1>Wait till 2028 for DDR6</h1>\r\n<h4>Intel might be good</h4>\r\n<p>Maybe atleast <em>32GB</em> <strong>RAM</strong></p>', 'How to build pc in 2025', '/pic/prop_laptop.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) DEFAULT NULL,
  `article_id` int(4) DEFAULT NULL,
  `content` varchar(54) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9900 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `article_id`, `content`, `created_at`) VALUES
(9876, 100001, 2000, 'Bài viết rất hay, cảm ơn tác giả!', '2025-03-17T13:00:00Z'),
(9877, 100002, 2001, 'Thông tin hữu ích, mong nhận thêm nhiều bài viết khác.', '2025-03-17T13:01:00Z'),
(9878, 100003, 2002, 'Rất bổ ích, mình đã học được nhiều điều.', '2025-03-17T13:02:00Z'),
(9879, 100004, 2000, 'Bài viết chi tiết và dễ hiểu, cảm ơn nhiều!', '2025-03-17T13:03:00Z'),
(9882, 100002, 2000, 'Tuyệt vời! Cảm ơn vì bài viết bổ ích.', '2025-03-17T13:06:00Z'),
(9886, 100001, 2001, 'Mình đã áp dụng và thấy rất hiệu quả, cảm ơn!', '2025-03-17T13:10:00Z'),
(9887, 100002, 2002, 'Chủ đề này rất quan trọng, cảm ơn đã chia sẻ.', '2025-03-17T13:11:00Z'),
(9889, 100004, 2001, 'Bài viết giúp mình hiểu rõ hơn, tuyệt vời!', '2025-03-17T13:13:00Z'),
(9890, 100005, 2002, 'Không thể bỏ qua bài viết này, quá hay!', '2025-03-17T13:14:00Z');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `brand` varchar(6) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `price` int(8) DEFAULT NULL,
  `cpu` varchar(21) DEFAULT NULL,
  `ram` varchar(12) DEFAULT NULL,
  `screen` varchar(5) DEFAULT NULL,
  `gpu` varchar(23) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand`, `name`, `price`, `cpu`, `ram`, `screen`, `gpu`, `image`) VALUES
(1, 'LENOVO', 'Laptop Lenovo Legion 5', 25990000, 'Intel Core i7-12700H', '16GB DDR5', '165Hz', 'NVIDIA RTX 3060 6GB', 'https://www.czone.com.pk/images/products/2-czone.com.pk-1540-15972-130524091332.jpg'),
(2, 'LENOVO', 'Laptop Lenovo IdeaPad Gaming 3', 19990000, 'AMD Ryzen 5 5600H', '8GB DDR4', '120Hz', 'NVIDIA GTX 1650 4GB', 'https://i5.walmartimages.com/asr/34d78811-9da7-40fe-bafb-0a7aa8b502b1.b3d84a8004ebf89d1e054d167e285e40.jpeg'),
(3, 'LENOVO', 'Laptop Lenovo ThinkPad X1 Gen 10', 42990000, 'Intel Core i7-1260P', '16GB LPDDR5', '60Hz', 'Intel Iris Xe Graphics', 'https://www.notebookcheck.it/fileadmin/Notebooks/News/_nc3/Legion_Slim_5_Misty_Grey_RGB_03.jpg'),
(4, 'MSI', 'Laptop MSI Katana GF66', 23490000, 'Intel Core i7-12650H', '16GB DDR4', '144Hz', 'NVIDIA RTX 3050 Ti 4GB', 'https://nguyencongpc.vn/media/lib/29-10-2022/laptopmsigamingkatanagf6612uck-804vn5.jpeg'),
(5, 'MSI', 'Laptop MSI Stealth 15M', 37990000, 'Intel Core i7-12700H', '16GB DDR5', '240Hz', 'NVIDIA RTX 3070 Ti 8GB', 'https://www.tncstore.vn/media/product/4907-laptop-msi-gaming-stealth-a11sdk-061vn-1.jpg'),
(6, 'MSI', 'Laptop MSI Modern 14', 14990000, 'Intel Core i5-1155G7', '8GB DDR4', '60Hz', 'Intel Iris Xe Graphics', 'https://cdn.tgdd.vn/Products/Images/44/304539/msi-modern-14-c11m-i3-011vn-040523-124356-600x600.jpg'),
(7, 'DELL', 'Laptop Dell XPS 15', 39990000, 'Intel Core i9-12900HK', '32GB DDR5', '120Hz', 'NVIDIA RTX 3050 Ti 4GB', 'https://tramanh.vn/wp-content/uploads/2023/09/dell-xps-15-9530-2023-2.jpg'),
(8, 'DELL', 'Laptop Dell Inspiron 16', 17990000, 'Intel Core i5-1240P', '8GB DDR4', '60Hz', 'Intel Iris Xe Graphics', 'https://cdn.tgdd.vn/Products/Images/44/303834/dell-inspiron-16 prostitu5620-i5-p1wkn-thumb-600x600.jpg'),
(9, 'DELL', 'Laptop Dell Alienware m15 R6', 45990000, 'Intel Core i9-12900H', '32GB DDR5', '240Hz', 'NVIDIA RTX 3080 Ti 12GB', 'https://ttcenter.com.vn/uploads/product/8zceq6pa-1277-dell-alienware-m15-r6-p109f001cbl-core-i7-11800h-rtx-3060-6gb-ram-32gb-ssd-1tb-15-6-240hz-qhd-new.jpeg'),
(10, 'HP', 'Laptop HP Omen 16', 27490000, 'AMD Ryzen 7 6800H', '16GB DDR5', '165Hz', 'NVIDIA RTX 3070 Ti 8GB', 'https://ttcenter.com.vn/uploads/photos/1712223903_2760_576e5550635fd8081c3d041e2b977bb8.jpg'),
(11, 'HP', 'Laptop HP Victus 15', 18990000, 'Intel Core i5-12500H', '8GB DDR4', '144Hz', 'NVIDIA GTX 1650 4GB', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtryeE9tb0O3BnyBxCC6kpnNkT8qQRqnje2g&s'),
(12, 'HP', 'Laptop HP Envy 13', 21490000, 'Intel Core i7-1165G7', '16GB LPDDR4X', '60Hz', 'Intel Iris Xe Graphics', 'https://cdn.tgdd.vn/Products/Images/44/232172/hp-envy-13-ba1028tu-i5-2k0b2pa-080921-085147-600x600.jpg'),
(13, 'ASUS', 'Laptop ASUS ROG Strix G15', 29990000, 'AMD Ryzen 9 6900HX', '32GB DDR5', '300Hz', 'NVIDIA RTX 3080 10GB', 'https://gamalaptop.vn/wp-content/uploads/2021/10/ASUS-ROG-Strix-G15-G513QC-Ryzen-7-5800H-RTX-3050-01.jpg'),
(14, 'ASUS', 'Laptop ASUS TUF Gaming F15', 19990000, 'Intel Core i5-12500H', '8GB DDR4', '144Hz', 'NVIDIA RTX 3050 4GB', 'https://cdn.tgdd.vn/Products/Images/44/304867/asus-tuf-gaming-f15-fx506hf-i5-hn014w-thumb-600x600.jpg'),
(15, 'ASUS', 'Laptop ASUS ZenBook 14', 23490000, 'Intel Core i7-1260P', '16GB LPDDR5', '60Hz', 'Intel Iris Xe Graphics', 'https://cdn2.cellphones.com.vn/x/media/catalog/product/a/s/asus-zenbook-14-oled-ux3405ma-ultra-5-pp151w-3_1_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT '/pic/def_author_avatar.png',
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=100008 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `isAdmin`) VALUES
(100000, 'ABC', 'abc@gmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0),
(100001, 'NoobMaster96', 'noob.master96@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0),
(100002, 'Master96', 'master96@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0),
(100003, 'Pro100', 'proo100@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0),
(100004, 'MaxVer', 'max.ver@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0),
(100005, 'Jem Bon', 'jem.bon@jmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0),
(100006, 'Oscar', 'oscar@gmail.com', '$2y$10$/m4grDcPA1MWGwcLn.PGkOPzjz0mLqq/TpZb1Q3pM0X/YpLGnguFe', '/pic/def_author_avatar.png', 0),
(100007, 'Bond', 'bond@gmail.com', '$2y$10$IQyx6FwkAf5fEC6ynpsPvu67gaFUEJ6Ioj/qvuhr9gotYcpwdpIIy', '/pic/def_author_avatar.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `full_name`, `email`, `phone`, `address`, `message`, `created_at`, `is_read`) VALUES
(1, 'Nguyễn Văn An', 'nguyenvanan@gmail.com', '0905123456', '123 Đường Láng, Đống Đa, Hà Nội', 'Tôi muốn hỏi về dịch vụ của bạn.', '2025-04-01 10:00:00', 0),
(2, 'Trần Thị Bình', 'tranbinh123@yahoo.com', '0987654321', '45 Nguyễn Huệ, TP Huế', 'Vui lòng liên hệ tôi để tư vấn.', '2025-04-02 14:30:00', 0),
(3, 'Lê Minh Châu', 'leminhchau@outlook.com', '0912345678', '78 Trần Phú, Nha Trang, Khánh Hòa', 'Tôi cần hỗ trợ kỹ thuật gấp!', '2025-04-03 09:15:00', 0),
(4, 'Phạm Quốc Đạt', 'phamquocdat@gmail.com', '0935123456', '12 Lê Lợi, Quận 1, TP.HCM', 'Dịch vụ rất tốt, tôi muốn hợp tác lâu dài.', '2025-04-04 16:20:00', 0),
(5, 'Hoàng Thị E', 'hoangthie@hotmail.com', '0978123456', '56 Phạm Văn Đồng, Đà Nẵng', 'Tôi có thắc mắc về giá cả sản phẩm.', '2025-04-05 11:45:00', 0),
(6, 'Đỗ Văn Phong', 'dovanphong@gmail.com', '0923456789', '89 Nguyễn Trãi, Thanh Hóa', 'Làm thế nào để đăng ký dịch vụ?', '2025-04-06 13:00:00', 0),
(7, 'Nguyễn Thị Hồng', 'nguyenhong99@gmail.com', '0965432109', '34 Hùng Vương, Hải Phòng', 'Tôi cần thêm thông tin chi tiết.', '2025-04-07 08:30:00', 0),
(8, 'Trần Quốc Khánh', 'tranquockhanh@outlook.com', '0941234567', '67 Điện Biên Phủ, Bình Thạnh, TP.HCM', 'Dịch vụ của bạn có giao hàng không?', '2025-04-08 15:10:00', 0),
(9, 'Lê Thị Mai', 'lethimai@yahoo.com', '0956789012', '23 Nguyễn Văn Cừ, Cần Thơ', 'Tôi muốn hủy đơn hàng đã đặt.', '2025-04-09 17:00:00', 0),
(10, 'Vũ Văn Nam', 'vuvannam@gmail.com', '0919876543', '90 Lý Thường Kiệt, Đà Lạt', 'Cảm ơn đội ngũ hỗ trợ rất nhiệt tình!', '2025-04-10 12:25:00', 0);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;