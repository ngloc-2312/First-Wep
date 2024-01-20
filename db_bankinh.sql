-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 28, 2023 lúc 06:57 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_bankinh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `admin` bit(1) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(50) DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `name`, `username`, `password`, `admin`, `phone`, `address`, `image`) VALUES
(1, 'Vũ Minh Toàn', 'minhtoan', '123456', b'1', '0868478729', 'Thái Bình', 'ngua.png'),
(2, 'Đỗ Xuân Trưởng', 'truong', '123', NULL, '0916858382', 'Thái Bình', 'anhmeo.png'),
(3, 'Nguyễn Thế Vinh', 'vinh', '123', NULL, '0913320382', 'Hà Nội', 'anhmeo.png'),
(4, 'Nguyễn Ngọc Hoàng', 'hoang', '123', NULL, '0913320382', 'Phú Yên', 'anhthe.png'),
(5, 'Vũ Ngọc Đoàn', 'doan', '123', NULL, '01625320382', 'Nha Trang', 'avatar.png'),
(11, 'Phùng Bá Duy', 'duy2', '123', NULL, '0868478720', 'Nha Trang', '1701189889_anhthe.jpg'),
(15, 'Đỗ Thúy Quỳnh', 'quynh', '123', NULL, '0868478729', 'Phú Yên', 'avatar.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `total` float DEFAULT NULL,
  `status` bit(1) DEFAULT b'0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`id`, `id_customer`, `date_order`, `total`, `status`) VALUES
(1, 2, '2020-11-06', 160000, b'1'),
(2, 3, '2020-11-07', 400000, b'1'),
(3, 4, '2020-11-02', 520000, b'1'),
(4, 5, '2020-11-08', 420000, b'1'),
(5, 6, '2020-11-06', 220000, b'1'),
(22, 2, '2020-11-11', 12825000, b'1'),
(21, 2, '2020-11-11', 8720000, b'1'),
(23, 2, '2020-11-11', 9953000, b'1'),
(26, 11, '2020-11-14', 15836000, b'1'),
(27, 11, '2020-11-14', 7479000, b'1'),
(28, 11, '2020-11-14', 8066000, b'1'),
(33, 11, '2020-11-21', 6993000, b'0'),
(30, 11, '2020-11-19', 9229000, b'0'),
(31, 15, '2020-11-20', 9829000, b'0'),
(34, 3, NULL, 0, b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bill` int(10) NOT NULL,
  `id_glasses` int(10) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `normal_price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `id_bill`, `id_glasses`, `quantity`, `normal_price`) VALUES
(1, 1, 2, 6, 220000),
(2, 2, 11, 1, 160000),
(3, 3, 8, 1, 200000),
(4, 4, 15, 1, 200000),
(5, 5, 37, 2, 200000),
(6, 5, 19, 1, 120000),
(22, 21, 1, 1, 3246000),
(23, 21, 12, 2, 2737000),
(25, 22, 17, 1, 3747000),
(24, 22, 31, 1, 5501000),
(26, 22, 22, 1, 3577000),
(27, 23, 45, 1, 3173000),
(28, 23, 40, 1, 6780000),
(29, 24, 45, 1, 3173000),
(30, 24, 40, 1, 6780000),
(31, 25, 12, 1, 2737000),
(32, 26, 8, 1, 3747000),
(33, 26, 5, 2, 4820000),
(34, 26, 15, 1, 2449000),
(35, 27, 45, 1, 3173000),
(36, 27, 47, 1, 4306000),
(37, 28, 1, 1, 3246000),
(38, 28, 5, 1, 4820000),
(39, 29, 17, 1, 3747000),
(40, 29, 54, 1, 6883000),
(41, 30, 12, 1, 2737000),
(42, 30, 1, 2, 3246000),
(43, 31, 2, 2, 3546000),
(44, 31, 12, 1, 2737000),
(45, 32, 12, 1, 2737000),
(46, 32, 15, 1, 2449000),
(47, 33, 1, 1, 3246000),
(48, 33, 17, 1, 3747000),
(49, 34, 1, 2, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`id`, `name`, `image`, `country`) VALUES
(1, 'Coach', 'coach.png', 'Mỹ'),
(2, 'Dolce & Gabbana', 'd&g.png', 'Ý'),
(3, 'Fendi', 'fendi.png', 'Ý'),
(4, 'Maui Jim', 'mauijim.png', 'Mỹ'),
(5, 'Oakley', 'oakley.png', 'Mỹ'),
(6, 'Prada', 'prada.png', 'Ý'),
(7, 'Ray-Ban', 'rayban.png', 'Mỹ'),
(8, 'Saint Laurent', 'saint.png', 'Pháp'),
(9, 'Tory Burch', 'tory.png', 'Mỹ'),
(10, 'Versace', 'versace.png', 'Ý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_product` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `text` varchar(500) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `id_product`, `id_user`, `text`, `rate`) VALUES
(2, 1, 11, 'Kính rất đẹp, tôi mua cái thứ 10 rồi vẫn ưng', 5),
(3, 1, 2, 'Đeo vào đẹp trai hẳn !!!', 5),
(4, 1, 3, 'Mắc quá ai mua -_- cho 3 sao thôi', 3),
(5, 12, 15, 'Kính vừa đẹp vừa rẻ.', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `glasses`
--

CREATE TABLE `glasses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `id_brand` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `hover_image` varchar(100) DEFAULT NULL,
  `normal_price` int(11) DEFAULT NULL,
  `sale_price` int(20) DEFAULT NULL,
  `rating` smallint(11) DEFAULT 4,
  `new` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `glasses`
--

INSERT INTO `glasses` (`id`, `name`, `id_brand`, `image`, `hover_image`, `normal_price`, `sale_price`, `rating`, `new`) VALUES
(1, 'Fendi FF011', 3, 'prd1.png', 'image/prd3.jpeg', 3246000, NULL, 5, b'1'),
(2, 'Fendi FF021', 3, 'prd2.jpeg', 'image/prd2.jpeg', 3546000, 3326000, 4, NULL),
(5, 'Fendi Orchidea', 3, 'prd4.jpeg', 'image/prd5.jpeg', 4820000, 4690000, 5, NULL),
(6, 'Fendi F08', 3, 'prd4.jpeg', 'img/prd7.jpeg', 3286000, NULL, 3, NULL),
(7, 'Fendi FF132', 3, 'prd5.jpeg', 'img/prd8.jpeg', 3501000, NULL, 4, NULL),
(8, 'Fendi FF026', 3, 'prd3.jpeg', 'img/prd6.jpeg', 3747000, 3682000, 4, NULL),
(9, 'Fendi FFM30', 3, 'list4.jpeg', 'img/prd9.jpeg', 4880000, NULL, 5, NULL),
(10, 'Fendi FFM70', 3, 'list4a.jpeg', 'img/prd10.jpeg', 4106000, NULL, 5, NULL),
(12, 'Coach LH023', 1, 'prd5.jpeg', 'img/prd11.jpeg', 2737000, NULL, 4, b'1'),
(14, 'Coach LH037', 1, 'prd2.jpeg', 'img/prd12.jpeg', 2667000, NULL, 4, NULL),
(15, 'Coach LH044', 1, 'prd3.jpeg', 'img/prd13.jpeg', 2449000, 2038000, 4, NULL),
(16, 'D&G DG441', 2, 'prd4.jpeg', 'img/prd14.jpeg', 5124000, NULL, 5, NULL),
(17, 'D&G DG441', 2, 'prd5.jpeg', 'img/prd15.jpeg', 3747000, NULL, 5, b'1'),
(18, 'D&G DG356', 2, 'list4.jpeg', 'img/prd16.jpeg', 6280000, NULL, 5, NULL),
(19, 'D&G DG441', 2, 'list4a.jpeg', 'img/prd17.png', 7124000, NULL, 5, NULL),
(20, 'D&G DG441', 2, 'prd4.jpeg', 'img/prd18.png', 6737000, NULL, 5, NULL),
(21, 'Oakley FLAX04', 5, 'prd2.jpeg', 'img/prd19.png', 3064000, NULL, 4, NULL),
(22, 'Oakley FLAX03', 5, 'prd5.jpeg', 'img/prd20.png', 3577000, NULL, 5, b'1'),
(23, 'Oakley FLAX06', 5, 'prd1.png', 'img/prd21.jpeg', 3923000, NULL, 4, NULL),
(24, 'Oakley Jacket', 5, 'prd2.jpeg', 'img/prd22.jpeg', 3308000, 3268000, 4, NULL),
(25, 'Oakley FLAX35', 5, 'prd4.jpeg', 'img/prd23.jpeg', 5130000, NULL, 5, NULL),
(26, 'MJ Hikina', 4, 'prd5.jpeg', 'img/prd24.jpeg', 5394000, NULL, 5, NULL),
(27, 'MJ Arch', 4, 'prd2.jpeg', 'img/prd25.jpeg', 6037000, NULL, 5, b'1'),
(28, 'MJ Pokawai', 4, 'list4.jpeg', 'img/prd26.jpeg', 5286000, NULL, 4, NULL),
(29, 'MJ Redsand', 4, 'list4a.jpeg', 'img/prd27.jpeg', 5436000, NULL, 5, NULL),
(30, 'MJ Sitowa', 4, 'prd2.jpeg', 'img/prd28.jpeg', 5336000, NULL, 4, NULL),
(31, 'MJ Kaupo', 4, 'prd3.jpeg', 'img/prd29.jpeg', 5501000, NULL, 5, b'1'),
(32, 'MJ Pokawai', 4, 'prd4.jpeg', 'img/prd30.jpeg', 5286000, NULL, 4, NULL),
(33, 'MJ Redsand', 4, 'prd5.jpeg', 'img/prd31.jpeg', 5436000, NULL, 5, NULL),
(34, 'MJ Swell', 4, 'list4.jpeg', 'img/prd32.jpeg', 4836000, NULL, 5, NULL),
(35, 'MJ Byron', 4, 'list4a.jpeg', 'img/prd7.jpeg', 5063000, NULL, 4, NULL),
(36, 'Prada Monorch', 6, 'prd2.jpeg', 'img/prd8.jpeg', 7940000, 6760000, 5, NULL),
(37, 'Prada Decode', 6, 'prd3.jpeg', 'img/prd9.jpeg', 7730000, NULL, 5, NULL),
(38, 'Prada P3001', 6, 'prd4.jpeg', 'img/prd10.jpeg', 6580000, NULL, 5, NULL),
(39, 'Prada P3008', 6, 'prd5.jpeg', 'img/prd11.jpeg', 6637000, NULL, 5, NULL),
(40, 'Prada P3010', 6, 'list4.jpeg', 'img/prd12.jpeg', 6780000, NULL, 5, b'1'),
(41, 'Prada P3011', 6, 'list4a.jpeg', 'img/prd13.jpeg', 6407000, NULL, 5, NULL),
(42, 'Prada P3015', 6, 'prd2.jpeg', 'img/prd14.jpeg', 6780000, NULL, 5, NULL),
(43, 'Prada P3018', 6, 'prd3.jpeg', 'img/prd15.jpeg', 6811000, NULL, 5, NULL),
(44, 'Ray-Ban OB4', 7, 'prd4.jpeg', 'img/prd16.jpeg', 2673000, 2289000, 3, NULL),
(45, 'Ray-Ban OBN', 7, 'prd5.jpeg', 'img/prd17.png', 3173000, NULL, 4, NULL),
(46, 'Ray-Ban Club', 7, 'list4.jpeg', 'img/prd18.png', 3702000, NULL, 3, NULL),
(47, 'Ray-Ban Club-M', 7, 'list4a.jpeg', 'img/prd19.png', 4306000, NULL, 4, NULL),
(48, 'Ray-Ban OBM', 7, 'prd2.jpeg', 'img/prd20.png', 2673000, NULL, 3, NULL),
(49, 'Ray-Ban Aviat', 7, 'prd3.jpeg', 'img/prd21.jpeg', 5473000, NULL, 4, NULL),
(50, 'Ray-Ban Aviat2', 7, 'prd4.jpeg', 'img/prd22.jpeg', 3702000, NULL, 5, NULL),
(51, 'Ray-Ban Aviat3', 7, 'prd5.jpeg', 'img/prd23.jpeg', 4306000, 4103000, 5, NULL),
(52, 'Ray-Ban Aviat4', 7, 'list4.jpeg', 'img/prd24.jpeg', 3702000, NULL, 3, NULL),
(53, 'Ray-Ban Aviat5', 7, 'list4a.jpeg', 'img/prd25.jpeg', 7113000, NULL, 5, NULL),
(54, 'Ray-Ban Justin', 7, 'prd2.jpeg', 'img/prd26.jpeg', 6883000, NULL, 5, b'1'),
(55, 'Ray-Ban Leo', 7, 'prd3.jpeg', 'img/prd27.jpeg', 7213000, NULL, 5, NULL),
(56, 'Ray-Ban Eric', 7, 'prd4.jpeg', 'img/prd28.jpeg', 6683000, NULL, 5, NULL),
(57, 'Ray-Ban Marsh', 7, 'prd5.jpeg', 'img/prd29.jpeg', 6891000, NULL, 5, NULL),
(58, 'YSL SL291', 8, 'list4.jpeg', 'img/prd30.jpeg', 8240000, NULL, 5, b'1'),
(59, 'YSL SL383', 8, 'list4a.jpeg', 'img/prd31.jpeg', 8360000, NULL, 5, NULL),
(60, 'YSL SL294', 8, 'prd2.jpeg', 'img/prd32.jpeg', 8110000, NULL, 5, NULL),
(61, 'YSL SL319', 8, 'prd3.jpeg', 'img/prd7.jpeg', 8500000, NULL, 5, NULL),
(62, 'YSL SL110', 8, 'prd4.jpeg', 'img/prd8.jpeg', 8470000, NULL, 5, NULL),
(63, 'Tory TY711', 9, 'prd5.jpeg', 'img/prd9.jpeg', 3306000, 3126000, 4, NULL),
(64, 'Tory TY844', 9, 'list4.jpeg', 'img/prd10.jpeg', 3712000, NULL, 4, NULL),
(65, 'Tory TY722', 9, 'list4a.jpeg', 'img/prd11.jpeg', 3545000, NULL, 4, NULL),
(66, 'Tory TY769', 9, 'prd2.jpeg', 'img/prd12.jpeg', 3540000, NULL, 4, NULL),
(67, 'Tory TY730', 9, 'prd3.jpeg', 'img/prd13.jpeg', 3622000, NULL, 4, b'1'),
(68, 'Versace VE029', 10, 'prd4.jpeg', 'img/prd14.jpeg', 6114000, NULL, 5, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_ibfk_1` (`id_customer`);

--
-- Chỉ mục cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_detail_ibfk_2` (`id_glasses`);

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `glasses`
--
ALTER TABLE `glasses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `glasses_ibfk_1` (`id_brand`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `glasses`
--
ALTER TABLE `glasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `glasses` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `account` (`id`);

--
-- Các ràng buộc cho bảng `glasses`
--
ALTER TABLE `glasses`
  ADD CONSTRAINT `glasses_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
