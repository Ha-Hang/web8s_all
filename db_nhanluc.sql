-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 05:18 AM
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
-- Database: `db_nhanluc`
--

-- --------------------------------------------------------

--
-- Table structure for table `content_pages`
--

CREATE TABLE `content_pages` (
  `id` int(11) NOT NULL,
  `section_key` varchar(100) NOT NULL COMMENT 'Khoá nội dung: hero_title, about_text',
  `content_value` text DEFAULT NULL COMMENT 'Giá trị nội dung, văn bản, hoặc URL',
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ghi_chu` varchar(255) DEFAULT NULL,
  `trang_thai` varchar(50) NOT NULL DEFAULT 'Mới',
  `ID` int(11) UNSIGNED NOT NULL COMMENT 'mã định danh(tự động tăng)',
  `ngay_nhan` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ho_ten` varchar(255) NOT NULL COMMENT 'họ tên user',
  `nam_sinh` int(4) NOT NULL COMMENT 'năm sinh ',
  `dia_chi` varchar(255) NOT NULL COMMENT 'nơi ở user',
  `chuong_trinh` varchar(255) NOT NULL COMMENT 'chương trình đã lựa chọn',
  `quoc_gia` varchar(255) NOT NULL COMMENT 'chương trình ở nước nào',
  `sdt` varchar(20) NOT NULL COMMENT 'số điện thoại có zalo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='bảng lưu trữ thông tin khách hàng đăng ký';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ghi_chu`, `trang_thai`, `ID`, `ngay_nhan`, `ho_ten`, `nam_sinh`, `dia_chi`, `chuong_trinh`, `quoc_gia`, `sdt`) VALUES
(NULL, 'Mới', 13, '2025-12-16 09:31:41', 'trần thị ngọc trâm', 1234, 'thái nguyên', 'Xuất khẩu lao động', 'Đài Loan', '908879797'),
(NULL, 'Mới', 14, '2025-12-16 09:31:57', 'a', 4569, 'hà nội', 'Xuất khẩu lao động', 'Hàn Quốc', '0928454744');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content_pages`
--
ALTER TABLE `content_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_key` (`section_key`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content_pages`
--
ALTER TABLE `content_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'mã định danh(tự động tăng)', AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
