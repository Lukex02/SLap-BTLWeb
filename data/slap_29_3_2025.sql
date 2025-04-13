-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 04:23 PM
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

CREATE TABLE `articles` (
  `id` int(4) NOT NULL,
  `title` varchar(35) DEFAULT NULL,
  `slug` varchar(32) DEFAULT NULL,
  `author_name` varchar(12) DEFAULT NULL,
  `author_avatar` varchar(23) DEFAULT NULL,
  `category` varchar(6) DEFAULT NULL,
  `tags` varchar(24) DEFAULT NULL,
  `published_at` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  `content` varchar(57) DEFAULT NULL,
  `excerpt` varchar(47) DEFAULT NULL,
  `thumbnail` varchar(20) DEFAULT NULL,
  `views` int(5) DEFAULT NULL,
  `likes` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `author_name`, `author_avatar`, `category`, `tags`, `published_at`, `updated_at`, `content`, `excerpt`, `thumbnail`, `views`, `likes`) VALUES
(2001, 'Mẹo sử dụng laptop số 1', 'meo-su-dung-laptop-1', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về mẹo sử dụng laptop số 1...</p>', 'Tóm tắt về mẹo sử dụng laptop số 1.', '/pic/prop_laptop.jpg', 8591, 104),
(2002, 'Đánh giá laptop số 2', 'danh-gia-laptop-2', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về đánh giá laptop số 2...</p>', 'Tóm tắt về đánh giá laptop số 2.', '/pic/prop_laptop.jpg', 7603, 120),
(2003, 'Phần mềm hữu ích cho laptop số 3', 'phan-mem-huu-ich-cho-laptop-3', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về phần mềm hữu ích cho laptop số 3...</p>', 'Tóm tắt về phần mềm hữu ích cho laptop số 3.', '/pic/prop_laptop.jpg', 9184, 313),
(2004, 'Laptop dành cho lập trình viên số 4', 'laptop-danh-cho-lap-trinh-vien-4', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về laptop dành cho lập trình viên số 4...</p>', 'Tóm tắt về laptop dành cho lập trình viên số 4.', '/pic/prop_laptop.jpg', 15982, 422),
(2005, 'Phần mềm hữu ích cho laptop số 5', 'phan-mem-huu-ich-cho-laptop-5', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về phần mềm hữu ích cho laptop số 5...</p>', 'Tóm tắt về phần mềm hữu ích cho laptop số 5.', '/pic/prop_laptop.jpg', 5699, 486),
(2006, 'Đánh giá laptop số 6', 'danh-gia-laptop-6', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về đánh giá laptop số 6...</p>', 'Tóm tắt về đánh giá laptop số 6.', '/pic/prop_laptop.jpg', 10290, 370),
(2007, 'Mẹo sử dụng laptop số 7', 'meo-su-dung-laptop-7', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về mẹo sử dụng laptop số 7...</p>', 'Tóm tắt về mẹo sử dụng laptop số 7.', '/pic/prop_laptop.jpg', 12254, 296),
(2008, 'Mẹo sử dụng laptop số 8', 'meo-su-dung-laptop-8', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về mẹo sử dụng laptop số 8...</p>', 'Tóm tắt về mẹo sử dụng laptop số 8.', '/pic/prop_laptop.jpg', 5558, 454),
(2009, 'Đánh giá laptop số 9', 'danh-gia-laptop-9', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về đánh giá laptop số 9...</p>', 'Tóm tắt về đánh giá laptop số 9.', '/pic/prop_laptop.jpg', 10692, 214),
(2010, 'Laptop gaming tốt nhất số 10', 'laptop-gaming-tot-nhat-10', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về laptop gaming tốt nhất số 10...</p>', 'Tóm tắt về laptop gaming tốt nhất số 10.', '/pic/prop_laptop.jpg', 15928, 223),
(2011, 'Laptop gaming tốt nhất số 11', 'laptop-gaming-tot-nhat-11', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về laptop gaming tốt nhất số 11...</p>', 'Tóm tắt về laptop gaming tốt nhất số 11.', '/pic/prop_laptop.jpg', 15931, 458),
(2012, 'Laptop mới ra mắt số 12', 'laptop-moi-ra-mat-12', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về laptop mới ra mắt số 12...</p>', 'Tóm tắt về laptop mới ra mắt số 12.', '/pic/prop_laptop.jpg', 9912, 379),
(2013, 'Hướng dẫn chọn mua laptop số 13', 'huong-dan-chon-mua-laptop-13', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về hướng dẫn chọn mua laptop số 13...</p>', 'Tóm tắt về hướng dẫn chọn mua laptop số 13.', '/pic/prop_laptop.jpg', 12117, 302),
(2014, 'Mẹo sử dụng laptop số 14', 'meo-su-dung-laptop-14', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về mẹo sử dụng laptop số 14...</p>', 'Tóm tắt về mẹo sử dụng laptop số 14.', '/pic/prop_laptop.jpg', 19048, 307),
(2015, 'So sánh laptop số 15', 'so-sanh-laptop-15', 'Nguyễn Văn A', '/pic/def_author_ava.jpg', 'Laptop', 'Laptop,Cong nghe,Tin tuc', '2025-03-17T10:00:00Z', '2025-03-17T12:00:00Z', '<p>Chi tiết về so sánh laptop số 15...</p>', 'Tóm tắt về so sánh laptop số 15.', '/pic/prop_laptop.jpg', 8294, 231);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(4) DEFAULT NULL,
  `user_id` int(6) DEFAULT NULL,
  `article_id` int(4) DEFAULT NULL,
  `content` varchar(54) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `article_id`, `content`, `created_at`) VALUES
(9876, 100001, 2000, 'Bài viết rất hay, cảm ơn tác giả!', '2025-03-17T13:00:00Z'),
(9877, 100002, 2001, 'Thông tin hữu ích, mong nhận thêm nhiều bài viết khác.', '2025-03-17T13:01:00Z'),
(9878, 100003, 2002, 'Rất bổ ích, mình đã học được nhiều điều.', '2025-03-17T13:02:00Z'),
(9879, 100004, 2000, 'Bài viết chi tiết và dễ hiểu, cảm ơn nhiều!', '2025-03-17T13:03:00Z'),
(9880, 100005, 2001, 'Nội dung rất thú vị, mong tác giả viết thêm.', '2025-03-17T13:04:00Z'),
(9881, 100001, 2002, 'Cách trình bày rõ ràng, rất đáng đọc.', '2025-03-17T13:05:00Z'),
(9882, 100002, 2000, 'Tuyệt vời! Cảm ơn vì bài viết bổ ích.', '2025-03-17T13:06:00Z'),
(9883, 100003, 2001, 'Bài viết hay quá, mình sẽ chia sẻ với bạn bè.', '2025-03-17T13:07:00Z'),
(9884, 100004, 2002, 'Giải thích rất dễ hiểu, cám ơn tác giả.', '2025-03-17T13:08:00Z'),
(9885, 100005, 2000, 'Mình rất thích phong cách viết của bạn!', '2025-03-17T13:09:00Z'),
(9886, 100001, 2001, 'Mình đã áp dụng và thấy rất hiệu quả, cảm ơn!', '2025-03-17T13:10:00Z'),
(9887, 100002, 2002, 'Chủ đề này rất quan trọng, cảm ơn đã chia sẻ.', '2025-03-17T13:11:00Z'),
(9888, 100003, 2000, 'Rất hữu ích, mong tác giả tiếp tục viết.', '2025-03-17T13:12:00Z'),
(9889, 100004, 2001, 'Bài viết giúp mình hiểu rõ hơn, tuyệt vời!', '2025-03-17T13:13:00Z'),
(9890, 100005, 2002, 'Không thể bỏ qua bài viết này, quá hay!', '2025-03-17T13:14:00Z');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(2) NOT NULL,
  `brand` varchar(6) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `price` int(8) DEFAULT NULL,
  `cpu` varchar(21) DEFAULT NULL,
  `ram` varchar(12) DEFAULT NULL,
  `screen` varchar(5) DEFAULT NULL,
  `gpu` varchar(23) DEFAULT NULL,
  `image` varchar(107) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand`, `name`, `price`, `cpu`, `ram`, `screen`, `gpu`, `image`) VALUES
(1, 'LENOVO', 'Laptop Lenovo Legion 5', 25990000, 'Intel Core i7-12700H', '16GB DDR5', '165Hz', 'NVIDIA RTX 3060 6GB', 'https://www.czone.com.pk/images/products/2-czone.com.pk-1540-15972-130524091332.jpg'),
(2, 'LENOVO', 'Laptop Lenovo IdeaPad Gaming 3', 19990000, 'AMD Ryzen 5 5600H', '8GB DDR4', '120Hz', 'NVIDIA GTX 1650 4GB', 'https://i5.walmartimages.com/asr/34d78811-9da7-40fe-bafb-0a7aa8b502b1.b3d84a8004ebf89d1e054d167e285e40.jpeg'),
(3, 'LENOVO', 'Laptop Lenovo ThinkPad X1 Gen 10', 42990000, 'Intel Core i7-1260P', '16GB LPDDR5', '60Hz', 'Intel Iris Xe Graphics', 'https://www.notebookcheck.it/fileadmin/Notebooks/News/_nc3/Legion_Slim_5_Misty_Grey_RGB_03.jpg'),
(4, 'MSI', 'Laptop MSI Katana GF66', 23490000, 'Intel Core i7-12650H', '16GB DDR4', '144Hz', 'NVIDIA RTX 3050 Ti 4GB', '/pic/msi_katana.jpg'),
(5, 'MSI', 'Laptop MSI Stealth 15M', 37990000, 'Intel Core i7-12700H', '16GB DDR5', '240Hz', 'NVIDIA RTX 3070 Ti 8GB', '/pic/msi_stealth.jpg'),
(6, 'MSI', 'Laptop MSI Modern 14', 14990000, 'Intel Core i5-1155G7', '8GB DDR4', '60Hz', 'Intel Iris Xe Graphics', '/pic/msi_modern14.jpg'),
(7, 'DELL', 'Laptop Dell XPS 15', 39990000, 'Intel Core i9-12900HK', '32GB DDR5', '120Hz', 'NVIDIA RTX 3050 Ti 4GB', '/pic/dell_xps.jpg'),
(8, 'DELL', 'Laptop Dell Inspiron 16', 17990000, 'Intel Core i5-1240P', '8GB DDR4', '60Hz', 'Intel Iris Xe Graphics', '/pic/dell_inspiron16.jpg'),
(9, 'DELL', 'Laptop Dell Alienware m15 R6', 45990000, 'Intel Core i9-12900H', '32GB DDR5', '240Hz', 'NVIDIA RTX 3080 Ti 12GB', '/pic/dell_alienware.jpg'),
(10, 'HP', 'Laptop HP Omen 16', 27490000, 'AMD Ryzen 7 6800H', '16GB DDR5', '165Hz', 'NVIDIA RTX 3070 Ti 8GB', '/pic/hp_omen16.jpg'),
(11, 'HP', 'Laptop HP Victus 15', 18990000, 'Intel Core i5-12500H', '8GB DDR4', '144Hz', 'NVIDIA GTX 1650 4GB', '/pic/hp_victus15.jpg'),
(12, 'HP', 'Laptop HP Envy 13', 21490000, 'Intel Core i7-1165G7', '16GB LPDDR4X', '60Hz', 'Intel Iris Xe Graphics', '/pic/hp_envy13.jpg'),
(13, 'ASUS', 'Laptop ASUS ROG Strix G15', 29990000, 'AMD Ryzen 9 6900HX', '32GB DDR5', '300Hz', 'NVIDIA RTX 3080 10GB', '/pic/asus_rog_strix_g15.jpg'),
(14, 'ASUS', 'Laptop ASUS TUF Gaming F15', 19990000, 'Intel Core i5-12500H', '8GB DDR4', '144Hz', 'NVIDIA RTX 3050 4GB', '/pic/asus_tuf_gaming_f15.jpg'),
(15, 'ASUS', 'Laptop ASUS ZenBook 14', 23490000, 'Intel Core i7-1260P', '16GB LPDDR5', '60Hz', 'Intel Iris Xe Graphics', '/pic/asus_zenbook14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(100001, 'NoobMaster96', 'noob.master96@jmail.com', 'noobmaster'),
(100002, 'Master96', 'master96@jmail.com', 'master96'),
(100003, 'Pro100', 'proo100@jmail.com', 'abcdef'),
(100004, 'MaxVer', 'max.ver@jmail.com', '130'),
(100005, 'Jem Bon', 'jem.bon@jmail.com', 'doubleO7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2017;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
