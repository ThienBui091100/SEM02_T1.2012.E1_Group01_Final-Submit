-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 27, 2021 lúc 08:23 AM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `backshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reset_pass`
--

CREATE TABLE `reset_pass` (
  `id` int(11) NOT NULL,
  `m_email` varchar(100) NOT NULL,
  `m_token` varchar(256) NOT NULL,
  `m_time` bigint(20) NOT NULL,
  `m_numcheck` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `reset_pass`
--

INSERT INTO `reset_pass` (`id`, `m_email`, `m_token`, `m_time`, `m_numcheck`) VALUES
(18, 'jay123@gmail.com', 'SNTkv4Xm0YynU0jC', 1638866737, 0),
(20, 'anhthuhunganh@gmail.com', 'PsyQxOHoEy24hAoF', 1638866950, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `email`, `password`, `admin_name`) VALUES
(1, 'joy@gmail.com', '123456', 'Joy Nguyen'),
(2, 'joy1402@gmail.com', '123456', 'Jay'),
(3, 'anhthuhunganh@gmail.com', 'hunganh', 'Ngo Tran Hung Anh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_baiviet`
--

CREATE TABLE `tbl_baiviet` (
  `baiviet_id` int(11) NOT NULL,
  `tenbaiviet` varchar(100) NOT NULL,
  `tomtat` text NOT NULL,
  `noidung` text NOT NULL,
  `danhmuctin_id` int(11) NOT NULL,
  `baiviet_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_baiviet`
--

INSERT INTO `tbl_baiviet` (`baiviet_id`, `tenbaiviet`, `tomtat`, `noidung`, `danhmuctin_id`, `baiviet_image`) VALUES
(6, 'Nike', 'Nike, Inc. is an American multinational corporation that is engaged in the design, development, manufacturing, and worldwide marketing and sales of footwear, apparel, equipment, accessories, and services. The company is headquartered near Beaverton, Oregon, in the Portland metropolitan area.', 'Sportwear, Shoes, Socks...', 6, 'nikelogo.png'),
(8, 'Nike', 'Nike for you', '', 7, 'adidasultraboost2021.jpg'),
(9, 'ADIDAS', 'Adidas AG is a German multinational corporation, founded and headquartered in Herzogenaurach, Germany, that designs and manufactures shoes, clothing and accessories. It is the largest sportswear manufacturer in Europe, and the second largest in the world, after Nike', '', 8, 'addidaslogo.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `parent_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `parent_id`) VALUES
(29, 'Ties', 0),
(30, 'Sportwear', 0),
(42, 'Sportwear', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmuc_tin`
--

CREATE TABLE `tbl_danhmuc_tin` (
  `danhmuctin_id` int(11) NOT NULL,
  `tendanhmuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_danhmuc_tin`
--

INSERT INTO `tbl_danhmuc_tin` (`danhmuctin_id`, `tendanhmuc`) VALUES
(7, 'Nike'),
(8, 'Adidas'),
(9, 'Levis');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_donhang`
--

CREATE TABLE `tbl_donhang` (
  `donhang_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `mahang` varchar(50) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tinhtrang` int(11) NOT NULL,
  `huydon` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL,
  `thanhtoan` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_donhang`
--

INSERT INTO `tbl_donhang` (`donhang_id`, `sanpham_id`, `soluong`, `mahang`, `khachhang_id`, `ngaythang`, `tinhtrang`, `huydon`, `amount`, `thanhtoan`) VALUES
(106, 34, 1, '3190', 45, '2021-12-08 03:14:42', 1, 0, 2700000, 1),
(107, 30, 1, '3190', 45, '2021-12-08 03:14:42', 1, 0, 2700000, 1),
(108, 29, 1, '3190', 45, '2021-12-08 03:14:42', 1, 0, 2750000, 1),
(109, 32, 1, '535', 45, '2021-12-07 13:31:01', 0, 0, 360000, 1),
(110, 31, 1, '541', 45, '2021-12-08 03:14:28', 0, 2, 180000, 1),
(111, 31, 1, '4905', 45, '2021-12-08 03:14:48', 1, 0, 180000, 1),
(112, 33, 2, '8550', 55, '2021-12-08 03:14:19', 0, 2, 400000, 1),
(113, 33, 2, '9354', 55, '2021-12-07 14:54:07', 0, 0, 400000, 1),
(117, 34, 1, '728', 53, '2021-12-08 03:14:15', 0, 2, 3000000, 1),
(118, 29, 1, '728', 53, '2021-12-08 03:14:15', 0, 2, 3000000, 1),
(119, 33, 1, '3102', 48, '2021-12-08 23:22:03', 0, 0, 200000, 1),
(120, 34, 1, '3102', 48, '2021-12-08 23:22:03', 0, 0, 2700000, 1),
(121, 31, 1, '3990', 48, '2021-12-08 23:22:23', 0, 0, 200000, 1),
(122, 36, 1, '8958', 57, '2021-12-09 06:24:26', 0, 0, 250000, 1),
(123, 35, 4, '8542', 57, '2021-12-09 06:46:30', 0, 0, 1000000, 1),
(124, 37, 1, '8542', 57, '2021-12-09 06:46:30', 0, 0, 300000, 1),
(125, 30, 6, '1579', 57, '2021-12-13 13:00:55', 0, 0, 18000000, 1),
(126, 38, 1, '1579', 57, '2021-12-13 13:00:55', 0, 0, 200000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_giaodich`
--

CREATE TABLE `tbl_giaodich` (
  `giaodich_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `magiaodich` varchar(50) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `khachhang_id` int(11) NOT NULL,
  `tinhtrangdon` int(11) NOT NULL DEFAULT 0,
  `huydon` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL,
  `thanhtoan` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_giaodich`
--

INSERT INTO `tbl_giaodich` (`giaodich_id`, `sanpham_id`, `soluong`, `magiaodich`, `ngaythang`, `khachhang_id`, `tinhtrangdon`, `huydon`, `amount`, `thanhtoan`) VALUES
(83, 34, 1, '3190', '2021-12-08 03:14:42', 45, 1, 0, 2700000, 1),
(84, 30, 1, '3190', '2021-12-08 03:14:42', 45, 1, 0, 2700000, 1),
(85, 29, 1, '3190', '2021-12-08 03:14:42', 45, 1, 0, 2750000, 1),
(86, 32, 1, '535', '2021-12-07 13:31:45', 45, 0, 0, 360000, 1),
(87, 31, 1, '541', '2021-12-08 03:14:28', 45, 0, 2, 180000, 1),
(88, 31, 1, '4905', '2021-12-08 03:14:48', 45, 1, 0, 180000, 1),
(89, 33, 2, '8550', '2021-12-08 03:14:19', 55, 0, 2, 400000, 1),
(90, 33, 2, '9354', '2021-12-07 14:54:07', 55, 0, 0, 400000, 1),
(91, 34, 20, '2140', '2021-12-07 17:20:06', 56, 0, 0, 60000000, 1),
(92, 34, 100000000, '7655', '2021-12-07 17:30:24', 45, 0, 0, 2147483647, 1),
(93, 30, 10000000, '7655', '2021-12-07 17:30:24', 45, 0, 0, 2147483647, 1),
(94, 34, 1, '728', '2021-12-08 03:14:15', 53, 0, 2, 3000000, 1),
(95, 29, 1, '728', '2021-12-08 03:14:15', 53, 0, 2, 3000000, 1),
(96, 33, 1, '3102', '2021-12-08 23:22:03', 48, 0, 0, 200000, 1),
(97, 34, 1, '3102', '2021-12-08 23:22:03', 48, 0, 0, 2700000, 1),
(98, 31, 1, '3990', '2021-12-08 23:22:23', 48, 0, 0, 200000, 1),
(99, 36, 1, '8958', '2021-12-09 06:24:26', 57, 0, 0, 250000, 1),
(100, 35, 4, '8542', '2021-12-09 06:46:30', 57, 0, 0, 1000000, 1),
(101, 37, 1, '8542', '2021-12-09 06:46:30', 57, 0, 0, 300000, 1),
(102, 30, 6, '1579', '2021-12-13 13:00:55', 57, 0, 0, 18000000, 1),
(103, 38, 1, '1579', '2021-12-13 13:00:55', 57, 0, 0, 200000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_giohang`
--

CREATE TABLE `tbl_giohang` (
  `giohang_id` int(11) NOT NULL,
  `tensanpham` varchar(100) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `giasanpham` varchar(50) NOT NULL,
  `hinhanh` varchar(50) NOT NULL,
  `soluong` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `khachhang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_giohang`
--

INSERT INTO `tbl_giohang` (`giohang_id`, `tensanpham`, `sanpham_id`, `giasanpham`, `hinhanh`, `soluong`, `amount`, `khachhang_id`) VALUES
(75, 'Sportswear for Running Nike', 32, '400000', 'sportwearnike.jpg', 2, 800000, 53);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_khachhang`
--

CREATE TABLE `tbl_khachhang` (
  `khachhang_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `note` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `giaohang` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_khachhang`
--

INSERT INTO `tbl_khachhang` (`khachhang_id`, `name`, `phone`, `address`, `note`, `email`, `password`, `giaohang`, `amount`) VALUES
(29, 'Joy', '0909448688', 'TPHCM', '', 'joynguyen1402@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(30, 'Joy', '0909090909', 'TPHCM', 'note', 'joynguyen1402@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(31, 'ABC', '123', '2121', '00000', 'joynguyen1402@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 1, 0),
(32, 'ABC', '123', '2121', '00000', 'joynguyen1402@gmail.com', '', 1, 0),
(33, 'jay', '0909090909', 'TPHCM', '', 'jay@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(34, 'jay', '1234567890', '2121', '', 'jay@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(35, 'jay', '0909090909', 'TPHCM', 'Note', 'jay@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(36, 'Jack', '0909090909', 'TPHCM', '', 'jack@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(37, 'Joy', '0909090909', 'TPHCM', '', 'joynguyen1402@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(38, 'Joy', '0909090909', 'TPHCM', '', 'joynguyen1402@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(39, 'Joy', '0909090909', 'TPHCM', '', 'joynguyen1402@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(40, 'Joy', '0909090909', 'TPHCM', '', 'joynguyen1402@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(41, 'Joy', '0909090909', 'TPHCM', '', 'joynguyen1402@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(45, 'Ngô Trần Hùng Anh', '0908013547', 'Gò Vấp', '123', 'anhthuhunganh@gmail.com', '1b740a0c25b6c22d0a2a38b420a94d4c', 0, 0),
(47, 'Ngô Trần Hùng em', '0908013547', 'Gò Vấp', '123', 'AnhNTHTS2012006@fpt.edu.vn', 'd0a9699ee090a74345b9f27ebe2499fe', 0, 0),
(48, 'Ngô Trần Hùng Anh', '0908013547', 'Gò Vấp', '123', 'ngothanhyen57@gmail.com', '1b740a0c25b6c22d0a2a38b420a94d4c', 0, 0),
(49, 'Ngô Trần Hùng Anh', '0908013547', 'Gò Vấp', '123', 'AnhNTHTS2012006@fpt.edu.vn', 'd0a9699ee090a74345b9f27ebe2499fe', 0, 0),
(50, 'test123', '0919199199', 'Ca Mau', 'dsda', '123@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 0),
(51, 'test0001', '123', '123', '123', 'test0001@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 0),
(52, 'Jack Phan', '090990909', 'THPCM', '', 'jay123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(53, 'Joy Phan', '0909090909', 'THPCM', '', 'joynguyen.ewec@gmail.com', '508df4cb2f4d8f80519256258cfb975f', 0, 0),
(54, 'tetss', '0909090909', 'THPCM', '', 'test123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(55, 'Test009', '123', '123', '123', 'test123@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 0),
(57, 'Bùi Đức Thiện', '0583845585', '16CP3WJyUmQtHm7UXth6WXYS8gTWXDRoDF', '', 'thienbui0911@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(58, 'thien bui', '+84906318470', '16CP3WJyUmQtHm7UXth6WXYS8gTWXDRoDF', '', 'joy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `sanpham_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sanpham_name` varchar(255) NOT NULL,
  `sanpham_chitiet` text NOT NULL,
  `sanpham_mota` text NOT NULL,
  `sanpham_gia` varchar(100) NOT NULL,
  `sanpham_giakhuyenmai` varchar(100) NOT NULL,
  `sanpham_active` int(11) NOT NULL,
  `sanpham_hot` int(11) NOT NULL,
  `sanpham_soluong` int(11) NOT NULL,
  `sanpham_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`sanpham_id`, `category_id`, `sanpham_name`, `sanpham_chitiet`, `sanpham_mota`, `sanpham_gia`, `sanpham_giakhuyenmai`, `sanpham_active`, `sanpham_hot`, `sanpham_soluong`, `sanpham_image`) VALUES
(29, 31, 'Waffle-one', 'Colour Shown: Black/Sport Red/White\r\nStyle: DD8014-001', 'Bringing a new look to the Waffle sneaker family, the Nike Waffle One balances everything you love about heritage Nike running with fresh innovations.Its TPU heel clip adds energy while a mixture of transparent mesh (let that sock game shine) and retro suedes give texture and depth.The updated Waffle outsole provides a level of support and traction you have to feel to believe.', '3000000', '2750000', 0, 0, 4, 'waffle-one-se-shoe-8Qm3Hr.jpg'),
(30, 31, 'Adidas New Arrivals', '', '', '3000000', '2700000', 0, 0, 4, 'adidasnewarrivals.jpg'),
(31, 29, 'Ties', 'The Ties have many color. You can choose color for you.', 'Just for successful people', '200000', '180000', 0, 0, 100, 'allties.jpg'),
(32, 30, 'Sportswear for Running Nike', 'Many size and color for you choose.', 'You can running, trekking...', '400000', '360000', 0, 0, 5, 'sportwearnike.jpg'),
(33, 31, 'Nike', 'Color:\r\nSize', 'Nike for you', '200000', '180000', 0, 0, 2, 'nike1.jpg'),
(34, 31, 'Adidas New Arrivals', 'Colr: black, white, red', 'addis das for running', '3000000', '2700000', 0, 0, 4, 'adidasOriginal2021.jpg'),
(35, 31, 'nike run', 'good', 'good', '250000', '200000', 0, 0, 3, 'nikeairmax2021.jpg'),
(36, 31, 'adidas run ', 'for man', 'good', '250000', '200000', 0, 0, 3, 'adidasultraboost2021.jpg'),
(37, 40, 'new paints', 'good', 'for women', '300000', '200000', 0, 0, 10, 'quan-soc-caro-ong-rong-cuc-chat,-gia-re-1-2409.jpg'),
(38, 40, 'test', 'test', 'test', '300000', '200000', 0, 0, 10, 'adidassocks.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `slider_id` int(11) NOT NULL,
  `slider_image` varchar(100) NOT NULL,
  `slider_caption` text NOT NULL,
  `slider_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`slider_id`, `slider_image`, `slider_caption`, `slider_active`) VALUES
(1, 'b4.jpg', 'New Arrival', 0),
(2, 'b3.jpg', 'Slider 50%', 0),
(3, 'nike1.jpg', 'Computer shoes', 1),
(4, 'nike2.jpg', 'Nike Purple', 1),
(5, 'nike5.jpg', 'Nike Air Youth', 1),
(6, 'nike4.jpg', 'Nike Man Black', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `reset_pass`
--
ALTER TABLE `reset_pass`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  ADD PRIMARY KEY (`baiviet_id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_danhmuc_tin`
--
ALTER TABLE `tbl_danhmuc_tin`
  ADD PRIMARY KEY (`danhmuctin_id`);

--
-- Chỉ mục cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD PRIMARY KEY (`donhang_id`);

--
-- Chỉ mục cho bảng `tbl_giaodich`
--
ALTER TABLE `tbl_giaodich`
  ADD PRIMARY KEY (`giaodich_id`);

--
-- Chỉ mục cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  ADD PRIMARY KEY (`giohang_id`);

--
-- Chỉ mục cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  ADD PRIMARY KEY (`khachhang_id`);

--
-- Chỉ mục cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`sanpham_id`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `reset_pass`
--
ALTER TABLE `reset_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  MODIFY `baiviet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `tbl_danhmuc_tin`
--
ALTER TABLE `tbl_danhmuc_tin`
  MODIFY `danhmuctin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `donhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT cho bảng `tbl_giaodich`
--
ALTER TABLE `tbl_giaodich`
  MODIFY `giaodich_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  MODIFY `giohang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  MODIFY `khachhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `sanpham_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
