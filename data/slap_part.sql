-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 05:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
-- --------------------------------------------------------

--
-- Table structure for table `tb_data`
--

CREATE TABLE IF NOT EXISTS `tb_data` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comment` varchar(150) NOT NULL,
  `date` varchar(50) NOT NULL,
  `reply_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ;

--
-- Dumping data for table `tb_data`
--

INSERT INTO `tb_data` (`id`, `name`, `comment`, `date`, `reply_id`) VALUES
(99, 'long', 'CPU là trái tim của laptop, khả năng sẽ khác nhau tùy thuộc vào model. Ví dụ, một số laptop có thể quản lý các tài liệu Word và trình duyệt web đơn gi', '2025-05-02 19:19:41', 95),
(100, 'tú', 'Chọn  phần cứng laptop phù hợp', '2025-05-02 19:19:57', 0),
(101, 'admin', 'CPU là trái tim của laptop, khả năng sẽ khác nhau tùy thuộc vào model', '2025-05-02 19:20:31', 100),
(102, 'blonk', 'hello', '2025-05-02 20:15:55', 0);

-- --------------------------------------------------------
--
-- Indexes for table `tb_data`
--
ALTER TABLE `tb_data`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for table `tb_data`
--
ALTER TABLE `tb_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

COMMIT;

