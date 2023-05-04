-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 04, 2023 lúc 01:55 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nlcs`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(6) NOT NULL,
  `time` datetime NOT NULL,
  `empaccount` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`id`, `time`, `empaccount`, `total`) VALUES
(0, '2019-10-30 07:10:47', 'giangtran', 156000),
(1, '2019-10-30 07:10:01', 'giangtran', 457000),
(2, '2019-10-30 07:10:13', 'giangtran', 952000),
(3, '2019-10-31 10:10:16', 'giangtran', 58000),
(4, '2023-04-23 09:04:25', 'giangtran', 100000),
(5, '2023-04-24 12:04:28', 'giangtran', 29000),
(6, '2023-04-24 01:04:34', 'uyen', 90000),
(7, '2023-04-24 03:04:06', 'uyen', 50000),
(8, '2023-04-27 09:04:30', 'uyen', 29000),
(9, '2023-04-27 12:04:38', 'uyen', 15000),
(10, '2023-04-27 01:04:34', 'uyen', 15000),
(11, '2023-04-29 07:04:49', 'uyen', 15000),
(12, '2023-04-29 09:04:46', 'uyen', 60000),
(13, '2023-04-29 09:04:04', 'uyen', 50000),
(14, '2023-04-29 09:04:01', 'uyen', 60000),
(15, '2023-04-29 11:04:10', 'uyen', 35000),
(16, '2023-04-30 03:04:40', 'uyen', 40000),
(17, '2023-04-30 03:04:57', 'uyen', 30000),
(18, '2023-04-30 12:04:17', 'uyen', 25000),
(19, '2023-04-30 12:04:31', 'uyen', 25000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_bill`
--

CREATE TABLE `detail_bill` (
  `id` int(4) NOT NULL,
  `product` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `quantity` int(6) NOT NULL,
  `total` double NOT NULL,
  `id_product` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `detail_bill`
--

INSERT INTO `detail_bill` (`id`, `product`, `quantity`, `total`, `id_product`) VALUES
(10, 'Cà phê đá', 1, 15000, 54),
(11, 'Trà lipton', 1, 15000, 56),
(12, 'Cà phê sữa', 1, 20000, 55),
(13, 'Trà lipton', 2, 30000, 56),
(14, 'Cà phê sữa', 3, 60000, 55),
(15, 'Cà phê sữa', 1, 20000, 55),
(16, 'Cà phê sữa', 2, 40000, 55),
(17, 'Trà lipton', 2, 30000, 56),
(18, 'Espresso', 1, 25000, 58),
(19, 'Espresso', 1, 25000, 58);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_import`
--

CREATE TABLE `detail_import` (
  `id` int(4) NOT NULL,
  `id_employee` int(4) UNSIGNED NOT NULL,
  `id_supplier` int(4) UNSIGNED NOT NULL,
  `id_warehouse` int(4) UNSIGNED NOT NULL,
  `quantity` float NOT NULL,
  `unit` varchar(10) NOT NULL,
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

CREATE TABLE `employees` (
  `id` int(4) UNSIGNED NOT NULL,
  `fullname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `account` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_vietnamese_ci NOT NULL,
  `id_num` varchar(13) COLLATE utf8_vietnamese_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `job` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `start` varchar(15) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `user_group` varchar(10) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`id`, `fullname`, `account`, `password`, `id_num`, `address`, `phone`, `job`, `start`, `user_group`) VALUES
(1, 'Trần Thanh Giang', 'giangtran', 'a940d8b1b4dbed2f777656fd0d965759d99c8ea9', '331800117', 'Tam Bình, Vĩnh Long', '0868442808', 'Quản lý', '2022', 'admin'),
(15, 'Nguyễn Văn A', 'vana', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123456789', 'đại học cần thơ', '0907986991', 'Phục vụ', '2023', ''),
(16, 'Trần Thị Thúy Uyên', 'uyen', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '12345678234', 'cần thơ', '0907986991', 'quản lý', '2022', 'admin'),
(18, 'Nguyễn Thị Như', 'nhu', '4cd4a80a06a7aab4e825302453175a91b9d2b00c', '123456789', 'an giang', '0786847593', 'Chế biến', '2023', ''),
(19, 'Nguyễn Văn B', 'bnguyen', '88c094e4f690c701fa8967bb9f44e071dce5137b', '12345678235', 'an giang', '0907986993', 'Order', '2023', 'order');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `species` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `price` int(11) NOT NULL,
  `thumb_img` varchar(200) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `species`, `price`, `thumb_img`) VALUES
(54, 'Cà phê đá', 'cafe', 15000, 'https://img.thuthuatphanmem.vn/uploads/2018/10/04/anh-dep-ben-ly-cafe-den_110730392.jpg'),
(55, 'Cà phê sữa', 'cafe', 20000, 'https://lepathcoffee.com/wp-content/uploads/2021/12/Cafe-Sua-2.jpg'),
(56, 'Trà lipton', 'Trà', 15000, 'https://product.hstatic.net/1000262144/product/tra-lipton-chanh-da_goc-ca-phe_b37aa8f00d194b738e71546f1d99e206_master.png'),
(58, 'Espresso', 'cafe', 25000, 'https://chefjob.vn/wp-content/uploads/2017/12/thuc-uong-epresso-la-gi.jpg'),
(59, 'Trà olong chai', 'Nước ngọt', 20000, 'https://cdn.tgdd.vn/Products/Images/8938/79209/bhx/tra-o-long-tea-plus-chai-455ml-0911201814410.JPG'),
(60, 'Sting', 'Nước ngọt', 20000, 'https://cdn.tgdd.vn/Products/Images/3226/76520/bhx/nuoc-tang-luc-sting-huong-dau-330ml-201909031559004919.jpg'),
(61, 'Nước suối', 'Nước ngọt', 10000, 'https://sonhawater.com/wp-content/uploads/2019/10/aquafina-500ml-300x300.jpg'),
(62, 'Latte', 'cafe', 25000, 'https://bizweb.dktcdn.net/thumb/1024x1024/100/438/465/products/89bdcf046b49a817f158.jpg?v=1655371671897'),
(63, 'Bạc xỉu', 'cafe', 20000, 'https://cdn.tgdd.vn/2021/03/content/Bac-xiu-la-gi-nguon-goc-va-cach-lam-bac-xiu-thom-ngon-don-gian-tai-nha-5-800x529.jpg'),
(64, 'Matcha Latte', 'Trà', 30000, 'https://www.foodandwine.com/thmb/2tI8aL1Z8hKhfV48_c8b6uWG-TQ=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Iced-Matcha-Latte-FT-RECIPE0622-2000-9c2e116d3bc54bdaacda10e62e8e0205.jpg'),
(65, 'Trà đào', 'Trà', 25000, 'https://breadtalkvietnam.com/wp-content/uploads/2020/12/tr%C3%A0-%C4%91%C3%A0o.jpg'),
(66, 'Trà vải', 'Trà', 25000, 'https://congthucphache.com/wp-content/uploads/2020/04/Tra-Vai_KoCTA_2.png'),
(67, 'Matcha đá xay', 'Đá xay', 30000, 'https://hc.com.vn/i/ecommerce/media/ckeditor_3289120.jpg'),
(68, 'Socola đá xay', 'Đá xay', 35000, 'https://product.hstatic.net/1000075078/product/chocolate-ice-blended_400940_c1d8d152416f403a9a44e1fd469496bc_master.jpg'),
(71, 'Trà dâu', 'Trà', 30000, 'https://bizweb.dktcdn.net/thumb/1024x1024/100/360/184/products/pixlr-bg-result-5-optimized.png?v=1657091695143');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shifts`
--

CREATE TABLE `shifts` (
  `id` int(6) UNSIGNED NOT NULL,
  `shiftName` varchar(10) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `dayOfShift` varchar(10) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `empAccount` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `salaryOfShift` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `shifts`
--

INSERT INTO `shifts` (`id`, `shiftName`, `dayOfShift`, `empAccount`, `salaryOfShift`) VALUES
(181, '1', '3', 'vana', 100000),
(182, '3', '5', 'vana', 100000),
(184, '3', '4', 'nhu', 100000),
(186, '1', '5', 'nhu', 100000),
(187, '3', '5', 'uyen', 100000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supplier`
--

CREATE TABLE `supplier` (
  `id` int(4) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`, `address`) VALUES
(0, 'Công ty B', '0907986992', 'cần thơ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(4) UNSIGNED NOT NULL,
  `material` varchar(20) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `remain` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `warehouse`
--

INSERT INTO `warehouse` (`id`, `material`, `unit`, `remain`) VALUES
(0, 'Đá', 'bao', '5');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empaccount` (`empaccount`);

--
-- Chỉ mục cho bảng `detail_bill`
--
ALTER TABLE `detail_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id` (`id`);

--
-- Chỉ mục cho bảng `detail_import`
--
ALTER TABLE `detail_import`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_warehouse` (`id_warehouse`) USING BTREE,
  ADD KEY `id_employee` (`id_employee`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Chỉ mục cho bảng `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account` (`account`),
  ADD KEY `account_2` (`account`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empAccount` (`empAccount`);

--
-- Chỉ mục cho bảng `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `detail_import`
--
ALTER TABLE `detail_import`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`empaccount`) REFERENCES `employees` (`account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `detail_bill`
--
ALTER TABLE `detail_bill`
  ADD CONSTRAINT `detail_bill_ibfk_1` FOREIGN KEY (`id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_bill_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `detail_import`
--
ALTER TABLE `detail_import`
  ADD CONSTRAINT `detail_import_ibfk_1` FOREIGN KEY (`id_employee`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_import_ibfk_2` FOREIGN KEY (`id_warehouse`) REFERENCES `warehouse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_import_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `shifts`
--
ALTER TABLE `shifts`
  ADD CONSTRAINT `shifts_ibfk_1` FOREIGN KEY (`empAccount`) REFERENCES `employees` (`account`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
