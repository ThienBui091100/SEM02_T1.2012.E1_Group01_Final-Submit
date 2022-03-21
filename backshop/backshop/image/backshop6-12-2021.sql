-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 06, 2021 lúc 12:34 PM
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
CREATE DATABASE IF NOT EXISTS `backshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `backshop`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reset_pass`
--

DROP TABLE IF EXISTS `reset_pass`;
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
(17, 'anhthuhunganh@gmail.com', 'lS2YiygCkqTblerC', 1638778748, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
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

DROP TABLE IF EXISTS `tbl_baiviet`;
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

DROP TABLE IF EXISTS `tbl_category`;
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
(31, 'Shoes', 0),
(35, 'Pants', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmuc_tin`
--

DROP TABLE IF EXISTS `tbl_danhmuc_tin`;
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

DROP TABLE IF EXISTS `tbl_donhang`;
CREATE TABLE `tbl_donhang` (
  `donhang_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `mahang` varchar(50) NOT NULL,
  `khachhang_id` int(11) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tinhtrang` int(11) NOT NULL,
  `huydon` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_donhang`
--

INSERT INTO `tbl_donhang` (`donhang_id`, `sanpham_id`, `soluong`, `mahang`, `khachhang_id`, `ngaythang`, `tinhtrang`, `huydon`, `amount`) VALUES
(45, 30, 1, '2585', 29, '2021-11-29 13:35:34', 0, 2, 0),
(46, 32, 1, '8335', 29, '2021-11-28 06:11:57', 0, 0, 0),
(49, 32, 1, '4838', 30, '2021-11-25 13:54:59', 0, 0, 0),
(50, 33, 1, '4838', 30, '2021-11-25 13:54:59', 0, 0, 0),
(51, 33, 1, '4995', 30, '2021-11-25 13:55:37', 0, 0, 0),
(52, 11, 1, '4745', 29, '2021-11-28 06:42:46', 1, 0, 0),
(53, 33, 1, '6871', 29, '2021-11-27 14:33:41', 0, 0, 0),
(54, 33, 1, '8258', 31, '2021-11-29 15:02:34', 0, 0, 0),
(55, 33, 1, '2761', 32, '2021-12-02 07:51:06', 1, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_giaodich`
--

DROP TABLE IF EXISTS `tbl_giaodich`;
CREATE TABLE `tbl_giaodich` (
  `giaodich_id` int(11) NOT NULL,
  `sanpham_id` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `magiaodich` varchar(50) NOT NULL,
  `ngaythang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `khachhang_id` int(11) NOT NULL,
  `tinhtrangdon` int(11) NOT NULL DEFAULT 0,
  `huydon` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_giaodich`
--

INSERT INTO `tbl_giaodich` (`giaodich_id`, `sanpham_id`, `soluong`, `magiaodich`, `ngaythang`, `khachhang_id`, `tinhtrangdon`, `huydon`, `amount`) VALUES
(22, 30, 1, '2585', '2021-11-29 13:35:34', 29, 0, 2, 0),
(23, 32, 1, '8335', '2021-11-28 06:11:57', 29, 0, 0, 0),
(24, 33, 1, '3549', '2021-11-29 13:35:24', 29, 0, 0, 0),
(25, 30, 1, '4529', '2021-11-23 14:52:45', 29, 0, 0, 0),
(26, 32, 1, '4838', '2021-11-25 13:54:59', 30, 0, 0, 0),
(27, 33, 1, '4838', '2021-11-25 13:54:59', 30, 0, 0, 0),
(28, 33, 1, '4995', '2021-11-25 13:55:37', 30, 0, 0, 0),
(29, 11, 1, '4745', '2021-11-28 06:42:46', 29, 1, 0, 0),
(30, 33, 1, '6871', '2021-11-27 14:33:41', 29, 0, 0, 0),
(31, 33, 1, '8258', '2021-11-29 15:02:34', 31, 0, 0, 0),
(32, 33, 1, '2761', '2021-12-02 07:51:06', 32, 1, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_giohang`
--

DROP TABLE IF EXISTS `tbl_giohang`;
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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_khachhang`
--

DROP TABLE IF EXISTS `tbl_khachhang`;
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
(49, 'Ngô Trần Hùng Anh', '0908013547', 'Gò Vấp', '123', 'AnhNTHTS2012006@fpt.edu.vn', 'd0a9699ee090a74345b9f27ebe2499fe', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

DROP TABLE IF EXISTS `tbl_sanpham`;
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
(34, 31, 'Adidas New Arrivals', 'Colr: black, white, red', 'addis das for running', '3000000', '2700000', 0, 0, 4, 'adidasOriginal2021.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

DROP TABLE IF EXISTS `tbl_slider`;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `tbl_danhmuc_tin`
--
ALTER TABLE `tbl_danhmuc_tin`
  MODIFY `danhmuctin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `donhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `tbl_giaodich`
--
ALTER TABLE `tbl_giaodich`
  MODIFY `giaodich_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  MODIFY `giohang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  MODIFY `khachhang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `sanpham_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
