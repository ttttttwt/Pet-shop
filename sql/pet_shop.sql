-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 04:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `id` int(11) NOT NULL,
  `IDhanghoa` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `IDdonhang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`id`, `IDhanghoa`, `soluong`, `IDdonhang`) VALUES
(1, 1, 2, 4),
(2, 2, 5, 4),
(3, 1, 1, 5),
(4, 6, 2, 5),
(5, 1, 7, 6),
(6, 8, 1, 13),
(7, 6, 1, 14),
(8, 1, 2, 14),
(9, 2, 1, 14),
(10, 2, 1, 15),
(11, 2, 1, 16),
(12, 2, 1, 17),
(13, 11, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `IDdanhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`IDdanhmuc`, `tendanhmuc`) VALUES
(1, 'Đồ ăn cho chó'),
(2, 'Đồ ăn cho mèo'),
(4, 'Đồ ăn cho chó và mèo'),
(6, 'Bình nước, Bát ăn cho chó'),
(7, 'Cát vệ sinh cho mèo'),
(8, 'Quần áo cho thú cưng'),
(9, 'Đồ chơi cho chó'),
(10, 'Đồ chơi cho mèo'),
(11, 'Nhà cho chó'),
(12, 'Sữa tắm & Xịt dưỡng'),
(13, 'Lược chải lông');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `IDdonhang` int(11) NOT NULL,
  `tongtien` int(11) NOT NULL,
  `trangthai` varchar(1) NOT NULL,
  `ngaydat` date NOT NULL,
  `ngaynhan` date DEFAULT NULL,
  `IDuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`IDdonhang`, `tongtien`, `trangthai`, `ngaydat`, `ngaynhan`, `IDuser`) VALUES
(4, 2, '1', '2022-12-01', '2022-12-02', 1),
(5, 220, '2', '2022-12-04', '0000-00-00', 1),
(6, 700, '2', '2022-12-09', '0000-00-00', 1),
(13, 321, '1', '2022-12-09', '0000-00-00', 1),
(14, 212, '0', '2022-12-19', '0000-00-00', 1),
(17, 2, '0', '2022-12-19', '0000-00-00', 1),
(18, 10, '0', '2022-12-19', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `IDgiohang` int(11) NOT NULL,
  `IDhanghoa` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `IDuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `giohang`
--

INSERT INTO `giohang` (`IDgiohang`, `IDhanghoa`, `soluong`, `IDuser`) VALUES
(27, 7, 1, 7),
(37, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hanghoa`
--

CREATE TABLE `hanghoa` (
  `IDhanghoa` int(11) NOT NULL,
  `tenhanghoa` varchar(200) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` varchar(200) NOT NULL,
  `mota` text NOT NULL,
  `hinhanh` text NOT NULL,
  `IDdanhmuc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hanghoa`
--

INSERT INTO `hanghoa` (`IDhanghoa`, `tenhanghoa`, `soluong`, `dongia`, `mota`, `hinhanh`, `IDdanhmuc`) VALUES
(1, 'test', 7, '100', 'test1', 'img/uploads/products/6391b454f1bfe-product-1.png', 1),
(2, 'đồ ăn cho chó loại 4', 2, '2', '<p>112124</p>', 'img/uploads/products/63a1223ab2c3d-tải xuống.png', 1),
(3, 'demo-twwt', 1, '1', '<p><strong>123</strong></p>', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(6, 'đồ ăn cho mèo', 97, '10', 'đồ ăn cho mèo', 'img/uploads/products/6391b46705919-product-2.png', 2),
(7, 'demo-twwt', 11, '111', 'do an ngon', 'img/uploads/products/6391b47d0776b-product-4.png', 4),
(8, 'demo-twwt', 122, '321', '1234', 'img/uploads/products/6391b473b2221-product-3.png', 4),
(10, 'đồ ăn cho mèo 1', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'img/uploads/products/63957e2bda30b-product-2.png', 4),
(11, 'đồ ăn cho mèo 2', 99, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'img/uploads/products/63957e86002cb-product-3.png', 2),
(12, 'đồ ăn cho mèo 4', 100, '10', 'Bánh thưởng cho chó vị sữa JERHIGH Milky Sticks phù hợp với tất cả các giống chó.', 'img/uploads/products/6395864b2f26b-product-4.png', 2),
(13, 'Đồ ăn cho mèo 5', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(14, 'Đồ ăn cho mèo 6', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(15, 'Đồ ăn cho mèo 7', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(16, 'Đồ ăn cho mèo 8', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(17, 'Đồ ăn cho mèo 9', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(18, 'Đồ ăn cho mèo 10', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(19, 'Đồ ăn cho mèo 11', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(20, 'Đồ ăn cho mèo 12', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(21, 'Đồ ăn cho mèo 13', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(22, 'Đồ ăn cho mèo 14', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(23, 'Đồ ăn cho mèo 15', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(24, 'Đồ ăn cho mèo 16', 100, '100', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(25, 'Đồ ăn cho mèo 17', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(26, 'Đồ ăn cho mèo 18', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(27, 'Đồ ăn cho mèo 19', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(28, 'Đồ ăn cho mèo 20', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(29, 'Đồ ăn cho mèo 21', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(30, 'Đồ ăn cho mèo 22', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(31, 'Đồ ăn cho mèo 23', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(32, 'Đồ ăn cho mèo 24', 100, '10', 'Bánh thưởng cho chó vị sữa phù hợp với tất cả các giống chó.', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(33, 'demo-twwt 4', 123, '123', '123', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1),
(34, 'demo-twwt 3', 123, '123', '<p>1234</p>', 'https://dummyimage.com/400x500/dee2e6/6c757d.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `IDuser` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(400) NOT NULL,
  `phone` int(12) NOT NULL,
  `adress` text NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`IDuser`, `username`, `password`, `email`, `phone`, `adress`, `role`) VALUES
(3, 'hello', '1234', 'lenamtrung321123@gmail.com', 1234, '1236', 0),
(1, 'hello1', '1234', 'lenamtrung321123@gmail.com', 12345678, '1234', 1),
(4, 'hello2', '1234', 'lenamtrung321123@gmail.com', 1234, '123', 0),
(7, 'hello3', '1234', 'lenamtrung321123@gmail.com', 1234, '123', 0),
(6, 'twtwtw', '1234', 'lenamtrung321123@gmail.com', 1234, '123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`tendanhmuc`),
  ADD UNIQUE KEY `IDdanhmuc` (`IDdanhmuc`),
  ADD UNIQUE KEY `tendanhmuc` (`tendanhmuc`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`IDdonhang`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`IDgiohang`);

--
-- Indexes for table `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`IDhanghoa`,`tenhanghoa`),
  ADD UNIQUE KEY `IDhanghoa` (`IDhanghoa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `IDuser` (`IDuser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `IDdanhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `IDdonhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `IDgiohang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `IDhanghoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `IDuser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
