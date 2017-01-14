-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 11:57 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestead`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `symbol`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LQANQG', 'Liên quan an ninh quốc gia', '2017-01-11 09:38:06', '2017-01-11 02:53:58', NULL),
(2, 'HN', 'Hiềm nghi', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL),
(3, 'ST', 'Sưu tra', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL),
(4, 'CA', 'Chuyên án', '2017-01-11 02:52:50', '2017-01-11 02:52:50', NULL),
(5, 'KTNV', 'Kiểm tra nghiệp vụ', '2017-01-11 02:53:19', '2017-01-11 02:53:19', NULL),
(6, 'QLNV', 'Quản lý nghiệp vụ', '2017-01-11 02:53:34', '2017-01-11 02:53:34', NULL),
(7, 'TX', 'Truy xét', '2017-01-11 02:54:15', '2017-01-11 02:54:15', NULL),
(8, 'TT', 'Truy tìm', '2017-01-11 02:54:28', '2017-01-11 02:54:28', NULL),
(9, 'TN', 'Truy nã', '2017-01-11 03:21:50', '2017-01-11 03:21:50', NULL),
(10, 'ĐT Khác', 'Đối tượng khác', '2017-01-11 19:20:38', '2017-01-11 19:20:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `ship_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original-name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content-type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kinds`
--

CREATE TABLE `kinds` (
  `id` int(10) UNSIGNED NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kinds`
--

INSERT INTO `kinds` (`id`, `symbol`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'HS', 'Hình sự', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL),
(2, 'MT', 'Ma túy', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL),
(3, 'PĐ', 'Phản động', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL),
(4, 'KT', 'Kinh tế', '2017-01-11 02:55:01', '2017-01-11 02:55:01', NULL),
(5, 'GĐ', 'Gián điệp', '2017-01-11 02:55:12', '2017-01-11 02:55:12', NULL),
(6, 'TB', 'Tình báo', '2017-01-11 02:55:20', '2017-01-11 02:55:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `receive_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_number` int(11) NOT NULL,
  `date_submit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_23_074105_create_purposes_table', 1),
('2015_12_23_074244_create_kinds_table', 1),
('2015_12_23_074348_create_categories_table', 1),
('2015_12_23_074506_create_units_table', 1),
('2015_12_23_075036_create_orders_table', 1),
('2015_12_23_075530_create_phones_table', 1),
('2015_12_23_081854_create_order_purpose_table', 1),
('2015_12_23_082501_create_lists_table', 1),
('2015_12_23_082501_create_ships_table', 1),
('2016_01_26_012335_create_ships_news_table', 1),
('2016_02_17_111310_create_news_table', 1),
('2016_02_17_185410_create_files_table', 1),
('2016_03_21_145050_create_networks_table', 1),
('2016_03_21_145343_create_network_ship_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE `networks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `networks`
--

INSERT INTO `networks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'viettel', '2017-01-11 09:38:06', '2017-01-11 09:38:06'),
(2, 'vinaphone', '2017-01-11 09:38:06', '2017-01-11 09:38:06'),
(3, 'mobifone', '2017-01-11 09:38:06', '2017-01-11 09:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `network_ship`
--

CREATE TABLE `network_ship` (
  `id` int(10) UNSIGNED NOT NULL,
  `ship_id` int(10) UNSIGNED NOT NULL,
  `network_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `number_cv_pa71` int(11) NOT NULL,
  `receive_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_number` int(11) NOT NULL,
  `number_news` int(11) NOT NULL,
  `date_submit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `kind_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `purpose_id` int(10) UNSIGNED NOT NULL,
  `number_cv` int(11) NOT NULL,
  `number_cv_pa71` int(11) NOT NULL,
  `order_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `manager` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_order` date NOT NULL,
  `date_begin` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `date_cut` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `kind_id`, `category_id`, `unit_id`, `purpose_id`, `number_cv`, `number_cv_pa71`, `order_name`, `order_phone`, `customer_name`, `customer_phone`, `file_name`, `slug`, `comment`, `manager`, `date_order`, `date_begin`, `date_end`, `date_cut`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 4, 4, 4, 36, 7, 'Nguyễn Anh Tuấn', '', 'Nguyễn Viết Huân', '0918897598', '', 'nguyen-anh-tuan', '', NULL, '2017-01-06', '2017-01-10', '2017-03-10', NULL, '2017-01-11 02:57:49', '2017-01-11 02:58:12', NULL),
(2, 1, 1, 2, 5, 4, 78, 603, 'Hoàng Văn Nam', '', 'Nguyễn Như Lam', '0983882477', '', 'hoang-van-nam', '', NULL, '2016-12-06', '2016-12-08', '2017-01-15', NULL, '2017-01-11 03:04:17', '2017-01-12 20:40:00', '2017-01-12 20:40:00'),
(3, 1, 1, 2, 5, 4, 3, 4, 'Hoàng Văn Nam', '', 'Nguyễn Như Lam', '0983882477', '', 'hoang-van-nam', '', NULL, '2017-01-03', '2017-01-15', '2017-02-15', NULL, '2017-01-11 03:06:27', '2017-01-11 03:06:27', NULL),
(4, 1, 1, 4, 4, 1, 27, 3, 'Lê Văn Bình', '', 'Nguyễn Xuân Hưng', '0912819977', '', 'le-van-binh', '', NULL, '2017-01-05', '2016-10-01', '2016-12-31', NULL, '2017-01-11 03:17:53', '2017-01-11 20:12:07', NULL),
(5, 1, 1, 9, 4, 1, 31, 660, 'Trần Việt Hùng', '', 'Trương Mạnh Linh', '0941771357', '', 'tran-viet-hung', '', NULL, '2016-12-29', '2016-08-01', '2016-10-31', NULL, '2017-01-11 03:23:07', '2017-01-11 03:23:07', NULL),
(6, 1, NULL, NULL, 6, 2, 292, 599, '', '', 'Nguyễn Thành Trung', '01699009845', '', '', '', NULL, '2016-11-30', NULL, NULL, NULL, '2017-01-11 03:29:58', '2017-01-11 03:29:58', NULL),
(7, 1, 1, 2, 5, 4, 3, 4, 'Trần Thị Loan', '', 'Lam', '0983882477', '', 'tran-thi-loan', '', NULL, '2017-01-12', '2017-01-15', '2017-02-15', NULL, '2017-01-11 19:34:35', '2017-01-11 19:34:35', NULL),
(8, 1, 1, 7, 16, 1, 1, 12, 'Dương Thanh Hải', '', 'Dũng', '0912637779', '', 'duong-thanh-hai', '', NULL, '2017-01-11', '2016-12-20', '2016-12-25', NULL, '2017-01-11 19:37:53', '2017-01-11 19:37:53', NULL),
(9, 1, 2, 4, 14, 4, 421, 643, 'Nguyễn Văn Tuấn', '', 'Long', '0905809089', '', 'nguyen-van-tuan', '', NULL, '2016-12-22', '2016-12-22', '2017-02-22', NULL, '2017-01-11 19:39:18', '2017-01-11 19:39:18', NULL),
(10, 1, 1, 7, 16, 1, 2, 12, 'Đặng Quang Nhật', '', 'Dũng', '0912637779', '', 'dang-quang-nhat', '', NULL, '2017-01-11', '2016-12-20', '2016-12-25', NULL, '2017-01-11 19:41:39', '2017-01-11 19:41:39', NULL),
(11, 1, 1, 7, 16, 1, 3, 12, 'Nguyễn Hoàng Minh', '', 'Dũng', '0912637779', '', 'nguyen-hoang-minh', '', NULL, '2017-01-11', '2016-12-20', '2016-12-25', NULL, '2017-01-11 19:43:50', '2017-01-11 19:43:50', NULL),
(12, 1, 2, 4, 14, 4, 422, 643, 'Nguyễn Thị Hiền', '', 'Long', '0905809089', '', 'nguyen-thi-hien', '', NULL, '2016-12-22', '2016-12-22', '2017-02-22', NULL, '2017-01-11 19:44:21', '2017-01-11 19:44:21', NULL),
(13, 1, 1, 7, 16, 1, 4, 12, 'Trần Văn Hùng', '', 'Dũng', '0912637779', '', 'tran-van-hung', '', NULL, '2017-01-11', '2016-12-20', '2016-12-25', NULL, '2017-01-11 19:46:16', '2017-01-11 19:46:16', NULL),
(14, 1, 2, 4, 14, 4, 423, 643, 'Phạm Trần Hà Trung Hiếu', '', 'Long', '0905809089', '', 'pham-tran-ha-trung-hieu', ' 06/01/2017', NULL, '2016-12-22', '2016-12-22', '2017-02-22', '2017-01-13', '2017-01-11 19:47:43', '2017-01-12 20:30:32', NULL),
(15, 1, 1, 4, 4, 1, 28, 4, 'Trần Thị Phước', '', '', '', '', 'tran-thi-phuoc', '', NULL, '2017-01-05', '2016-10-01', '2016-12-31', NULL, '2017-01-11 19:48:18', '2017-01-11 19:48:18', NULL),
(16, 1, 2, 4, 14, 4, 428, 646, 'Trần Thị Chiến', '', 'Long', '0905809089', '', 'tran-thi-chien', '', NULL, '2016-12-23', '2016-12-30', '2017-02-22', NULL, '2017-01-11 19:49:51', '2017-01-11 19:49:51', NULL),
(17, 1, 1, 4, 4, 1, 27, 3, 'Lê Văn Bình', '', '', '', '', 'le-van-binh', '', NULL, '2017-01-05', '2016-10-01', '2016-12-31', NULL, '2017-01-11 19:50:07', '2017-01-11 20:12:34', '2017-01-11 20:12:34'),
(18, 1, 1, 7, 6, 1, 312, 654, 'Nguyễn Văn Tuyết', '', 'Trung', '01699009845', '', 'nguyen-van-tuyet', '', NULL, '2016-12-29', '2016-10-01', '2016-12-28', NULL, '2017-01-11 19:52:22', '2017-01-11 20:10:50', NULL),
(19, 1, 1, 2, 11, 4, 88, 646, 'Trần Đức Hiếu', '', 'Linh', '0982899833', '', 'tran-duc-hieu', '', NULL, '2016-12-23', '2016-12-23', '2017-01-19', NULL, '2017-01-11 19:54:54', '2017-01-11 19:54:54', NULL),
(20, 1, 1, 7, 6, 1, 314, 654, 'Nguyễn Hồng Lâm', '', 'Trung', '', '', 'nguyen-hong-lam', '', NULL, '2016-12-29', '2016-10-01', '2016-12-28', NULL, '2017-01-11 19:55:00', '2017-01-12 19:45:35', '2017-01-12 19:45:35'),
(21, 1, 2, 4, 3, 4, 15, 648, 'Lê Nam Sơn', '', 'Hưng', '0995850995', '', 'le-nam-son', '', NULL, '2016-12-27', '2016-12-27', '2017-02-27', NULL, '2017-01-11 19:56:33', '2017-01-11 19:56:33', NULL),
(22, 1, 2, 4, 14, 4, 431, 655, 'Trần Thị Chiến', '', 'Long', '0905809089', '', 'tran-thi-chien', '', NULL, '2016-12-29', '2016-12-29', '2017-03-15', NULL, '2017-01-11 19:58:43', '2017-01-11 19:58:43', NULL),
(23, 1, 1, 10, 6, 2, 313, 654, 'Chưa rõ', '', '', '', '', 'nguyen-hong-lam', '', NULL, '2016-12-29', '2017-01-13', '2017-01-20', NULL, '2017-01-11 20:04:04', '2017-01-12 19:19:15', '2017-01-12 19:19:15'),
(24, 1, 1, 9, 4, 1, 31, 660, 'Trần Việt Hùng', '', 'Linh', '0941771357', '', 'tran-viet-hung', '', NULL, '2016-12-30', '2016-08-01', '2016-10-31', NULL, '2017-01-11 20:07:15', '2017-01-11 20:13:28', '2017-01-11 20:13:28'),
(25, 1, 1, 9, 4, 4, 33, 661, 'Đoàn Thị Bích', '', 'Sỹ', '0988090098', '', 'doan-thi-bich', '', NULL, '2016-12-30', '2016-12-30', '2017-03-30', NULL, '2017-01-11 20:08:20', '2017-01-11 20:08:20', NULL),
(26, 1, 4, 2, 17, 4, 2, 661, 'Đinh Xuân Phố', '', 'Hùng', '0914369555', '', 'dinh-xuan-pho', '', NULL, '2016-12-30', '2016-12-29', '2017-03-29', NULL, '2017-01-11 20:10:19', '2017-01-11 20:10:19', NULL),
(27, 1, 4, 2, 17, 4, 3, 661, 'Trương Tuấn Anh', '', 'Hùng', '0914369555', '', 'truong-tuan-anh', '', NULL, '2016-12-30', '2016-12-29', '2017-03-29', NULL, '2017-01-11 20:11:54', '2017-01-11 20:11:54', NULL),
(28, 1, 1, 10, 6, 3, 311, 654, 'Nguyễn Văn Tuyết', '', 'Trung', '01699009845', '', 'nguyen-van-tuyet', '', NULL, '2016-12-29', '2016-10-01', '2016-12-28', NULL, '2017-01-11 20:15:17', '2017-01-12 19:25:46', NULL),
(29, 1, 2, 4, 14, 1, 424, 642, 'Nguyễn Thị Hiền', '', 'Long', '0905809089', '', 'nguyen-thi-hien', '', NULL, '2016-12-21', '2016-11-01', '2016-12-22', NULL, '2017-01-11 20:17:14', '2017-01-11 20:17:14', NULL),
(30, 1, 1, 2, 16, 1, 228, 642, 'Hoàng Trọng Hùng', '', '', '', '', 'hoang-trong-hung', '', NULL, '2016-12-21', '2016-12-20', '2016-12-22', NULL, '2017-01-11 20:19:09', '2017-01-11 20:19:09', NULL),
(31, 1, 2, 4, 3, 4, 4, 628, 'Lê Ngọc Sơn', '', 'Hưng', '0995850995', '', 'le-ngoc-son', '', NULL, '2016-12-15', '2016-12-12', '2017-03-12', NULL, '2017-01-11 20:19:24', '2017-01-11 20:19:24', NULL),
(32, 1, 1, 2, 16, 1, 229, 642, 'Đoàn Ngọc Huy', '', '', '', '', 'doan-ngoc-huy', '', NULL, '2016-12-21', '2016-12-20', '2016-12-22', NULL, '2017-01-11 20:22:01', '2017-01-11 20:22:01', NULL),
(33, 1, 2, 4, 3, 4, 10, 628, 'Trần Đình Mão', '', 'Hưng', '0995850995', '', 'tran-dinh-mao', '', NULL, '2016-12-15', '2016-12-14', '2017-01-20', NULL, '2017-01-11 20:23:11', '2017-01-11 20:23:11', NULL),
(34, 1, 1, 4, 10, 1, 9, 641, 'Trần Hùng', '', 'Hải', '0982368595', '', 'tran-hung', '', NULL, '2016-12-21', '2016-11-30', '2016-12-20', NULL, '2017-01-11 20:24:44', '2017-01-11 20:24:44', NULL),
(35, 1, 1, 2, 10, 1, 18, 637, 'Nguyễn Văn Xuân', '', '', '', '', 'nguyen-van-xuan', '', NULL, '2016-12-20', '2016-12-17', '2016-12-19', NULL, '2017-01-11 20:27:51', '2017-01-11 20:27:51', NULL),
(36, 1, 3, 5, 1, 4, 1, 634, 'Trần Văn Thành', '', 'An', '0694100234', '', 'tran-van-thanh', '', NULL, '2016-12-19', '2017-01-07', '2017-04-07', NULL, '2017-01-11 20:29:07', '2017-01-11 20:29:07', NULL),
(37, 1, 1, 2, 10, 1, 18, 637, 'Nguyễn Văn Xuân', '', '', '', '', 'nguyen-van-xuan', '', NULL, '2016-12-20', '2016-07-01', '2016-08-31', NULL, '2017-01-11 20:30:15', '2017-01-11 20:30:15', NULL),
(38, 1, 3, 6, 1, 4, 2, 634, 'Lê Nam Cao', '', 'Chí Thành', '0694100234', '', 'le-nam-cao', '', NULL, '2016-12-19', '2017-01-07', '2017-04-07', NULL, '2017-01-11 20:30:39', '2017-01-11 20:30:39', NULL),
(39, 1, 1, 2, 10, 1, 18, 637, 'Nguyễn Văn Xuân', '', '', '', '', 'nguyen-van-xuan', '', NULL, '2016-12-20', '2016-12-16', '2016-12-20', NULL, '2017-01-11 20:32:32', '2017-01-11 20:32:32', NULL),
(40, 1, 3, 6, 1, 4, 3, 634, 'Hoàng Anh Ngợi', '', 'Hùng', '0694100234', '', 'hoang-anh-ngoi', '', NULL, '2016-12-19', '2016-12-15', '2017-03-15', NULL, '2017-01-11 20:34:30', '2017-01-11 20:34:30', NULL),
(41, 1, 1, 2, 16, 1, 225, 637, 'Nguyễn Ngọc Thắng', '', '', '', '', 'nguyen-ngoc-thang', '', NULL, '2016-12-20', '2016-12-10', '2016-12-25', NULL, '2017-01-11 20:36:07', '2017-01-11 20:36:07', NULL),
(42, 1, 3, 6, 1, 4, 4, 634, 'Mai Xuân Ái', '', 'Thương', '0694100234', '', 'mai-xuan-ai', '', NULL, '2016-12-19', '2017-01-08', '2017-04-08', NULL, '2017-01-11 20:37:17', '2017-01-11 20:37:17', NULL),
(43, 1, 1, 10, 16, 3, 225, 637, 'Nguyễn Ngọc Thắng', '', '', '', '', 'nguyen-ngoc-thang', '', NULL, '2016-12-20', '2016-12-10', '2016-12-25', NULL, '2017-01-11 20:37:56', '2017-01-12 19:26:47', NULL),
(44, 1, 1, 3, 10, 4, 20, 643, 'Nguyễn Văn Xuân', '', 'Ngọc', '0982066606', '', 'nguyen-van-xuan', '', NULL, '2016-12-22', '2016-12-22', '2017-02-05', NULL, '2017-01-11 20:39:51', '2017-01-11 20:39:51', NULL),
(45, 1, 1, 2, 16, 1, 226, 637, 'Nguyễn Ngọc Thắng', '', 'Lợi', '01227475152', '', 'nguyen-ngoc-thang', '', NULL, '2016-12-20', '2016-12-08', '2016-12-25', NULL, '2017-01-11 20:40:24', '2017-01-11 20:40:24', NULL),
(46, 1, 1, 10, 16, 3, 226, 637, 'Nguyễn Ngọc Thắng', '', 'Lợi', '01227475152', '', 'nguyen-ngoc-thang', '', NULL, '2016-12-20', '2016-12-10', '2016-12-25', NULL, '2017-01-11 20:41:50', '2017-01-12 19:27:45', NULL),
(47, 1, 1, 3, 10, 4, 22, 643, 'Dương Văn Đạo', '', 'Ngọc', '0982066606', '', 'duong-van-dao', '', NULL, '2016-12-22', '2016-12-22', '2017-02-05', NULL, '2017-01-11 20:43:17', '2017-01-11 20:43:17', NULL),
(48, 1, 1, 2, 10, 1, 8, 629, 'Nguyễn Phi Hùng', '', '', '', '', 'nguyen-phi-hung', '', NULL, '2016-12-14', '2016-12-08', '2016-12-13', NULL, '2017-01-11 20:45:01', '2017-01-11 20:45:01', NULL),
(49, 1, 1, 2, 5, 4, 77, 603, 'Trần Thị Loan', '', 'Nguyễn Như Lam', '0983882477', '', 'tran-thi-loan', '', NULL, '2016-12-06', '2016-12-06', '2017-01-15', NULL, '2017-01-11 20:48:29', '2017-01-11 20:48:29', NULL),
(50, 1, 1, 2, 12, 1, 7, 618, 'Phạm Văn Nhuần', '', 'Lộc', '0912312419', '', 'pham-van-nhuan', '', NULL, '2016-12-13', '2016-10-20', '2016-11-15', NULL, '2017-01-11 20:49:26', '2017-01-11 20:49:26', NULL),
(51, 1, 1, 2, 5, 4, 78, 603, 'Hoàng Văn Nam', '', 'Lam', '0983882477', '', 'hoang-van-nam', '', NULL, '2016-12-06', '2016-12-06', '2017-01-15', NULL, '2017-01-11 20:50:26', '2017-01-11 20:50:26', NULL),
(52, 1, 1, 2, 12, 1, 7, 618, 'Phạm Văn Nhuần', '', 'Ký', '0905386851', '', 'pham-van-nhuan', '', NULL, '2016-12-13', '2016-12-05', '2016-12-12', NULL, '2017-01-11 20:51:07', '2017-01-11 20:51:07', NULL),
(53, 1, 1, 2, 11, 4, 50, 616, 'Ngô Văn Tài', '', 'Hùng', '0905885557', '', 'ngo-van-tai', '', NULL, '2016-12-09', '2016-12-09', '2017-01-15', NULL, '2017-01-11 20:52:59', '2017-01-11 20:52:59', NULL),
(54, 1, 1, 2, 12, 1, 8, 618, 'Đinh Xuân Trường', '', 'Ngọc ', '0982066606', '', 'dinh-xuan-truong', '', NULL, '2016-12-13', '2016-12-05', '2016-12-12', NULL, '2017-01-11 20:53:27', '2017-01-11 20:53:27', NULL),
(55, 1, 1, 2, 12, 3, 5, 614, 'Lê Văn Cảm', '', 'Ký ', '0905386851', '', 'le-van-cam', '', NULL, '2016-12-09', '2016-11-21', '2016-12-05', NULL, '2017-01-11 22:56:07', '2017-01-11 22:56:07', NULL),
(56, 1, 1, 2, 12, 3, 6, 614, 'Lê Văn Cảm', '', 'Long ', '0987188026', '', 'le-van-cam', '', NULL, '2016-12-09', '2016-11-28', '2016-12-08', NULL, '2017-01-11 23:00:46', '2017-01-11 23:00:46', NULL),
(57, 1, 1, 2, 16, 1, 220, 614, 'Nguyễn Ngọc Thắng', '', 'Thắng', '0905898905', '', 'nguyen-ngoc-thang', '', NULL, '2016-12-09', '2016-12-07', '2016-12-07', NULL, '2017-01-11 23:03:19', '2017-01-11 23:03:19', NULL),
(58, 1, 1, 2, 12, 1, 1, 596, 'Nguyễn Hồng Phong', '', 'Ký', '0905386851', '', 'nguyen-hong-phong', '', NULL, '2016-12-02', '2016-11-20', '2016-11-30', NULL, '2017-01-11 23:04:47', '2017-01-11 23:04:47', NULL),
(59, 1, 1, 10, 12, 3, 2, 596, 'Nguyễn Hồng Phong', '', 'Ký', '0905386851', '', 'nguyen-hong-phong', '', NULL, '2016-12-02', '2017-01-12', '2017-01-19', NULL, '2017-01-11 23:06:13', '2017-01-11 23:06:13', NULL),
(60, 1, 1, 7, 11, 1, 16, 599, 'Nguyễn Văn Nam', '', 'Cương', '0915420286', '', 'nguyen-van-nam', '', NULL, '2016-12-02', '2016-11-28', '2016-11-30', NULL, '2017-01-11 23:11:33', '2017-01-11 23:11:33', NULL),
(61, 1, 1, 7, 10, 1, 5, 599, 'Hoàng Văn Đạt', '', 'Hậu', '0982368595', '', 'hoang-van-dat', '', NULL, '2016-12-02', '2016-11-20', '2016-11-30', NULL, '2017-01-11 23:13:30', '2017-01-11 23:13:30', NULL),
(62, 1, 3, 4, 1, 4, 34, 617, 'Nguyễn Trung Trực', '', 'Vinh', '0912709808', '', 'nguyen-trung-truc', '', NULL, '2016-12-12', '2016-12-10', '2016-12-30', '2017-01-13', '2017-01-11 23:17:09', '2017-01-12 20:34:15', NULL),
(63, 1, 1, 2, 12, 1, 3, 602, 'Phạm Văn Phước', '', 'Trần Văn Ký', '0905386851', '', 'pham-van-phuoc', '', NULL, '2016-12-05', '2016-11-20', '2016-12-04', NULL, '2017-01-11 23:17:14', '2017-01-11 23:17:14', NULL),
(64, 1, 1, 2, 12, 1, 4, 602, 'Bùi Văn Cường', '', 'Trần Văn Ký', '0905386851', '', 'bui-van-cuong', '', NULL, '2016-12-05', '2016-11-20', '2016-12-04', NULL, '2017-01-11 23:19:25', '2017-01-11 23:19:25', NULL),
(65, 1, 3, 4, 1, 4, 35, 617, 'Mai Văn Tám', '', 'Vinh', '0912709808', '', 'mai-van-tam', '', NULL, '2016-12-12', '2016-12-10', '2016-12-30', '2017-01-13', '2017-01-11 23:19:36', '2017-01-12 20:34:40', NULL),
(66, 1, 1, 2, 10, 3, 7, 602, 'Hoàng Văn Đạt', '', 'Hậu', '0982368595', '', 'hoang-van-dat', '', NULL, '2016-12-05', '2016-11-26', '2016-12-05', NULL, '2017-01-11 23:22:20', '2017-01-11 23:22:20', NULL),
(67, 1, 1, 4, 6, 4, 290, 598, 'Võ Ngọc Giang', '', 'Ngà', '0912149555', '', 'vo-ngoc-giang', '', NULL, '2016-12-12', '2016-12-01', '2017-03-01', '2017-01-13', '2017-01-11 23:22:29', '2017-01-12 20:37:13', NULL),
(68, 1, 1, 4, 6, 4, 291, 598, 'Phạm Văn Lực', '', 'Ngà', '0912149555', '', 'pham-van-luc', '', NULL, '2016-12-12', '2016-12-01', '2017-03-01', '2017-01-13', '2017-01-11 23:24:57', '2017-01-12 20:37:23', NULL),
(69, 1, 1, 2, 16, 1, 212, 594, 'Nguyễn Ngọc Thắng', '', 'Thắng', '0905898903', '', 'nguyen-ngoc-thang', '', NULL, '2016-11-29', '2016-09-10', '2016-09-12', NULL, '2017-01-11 23:25:31', '2017-01-11 23:25:31', NULL),
(70, 1, 1, 4, 10, 1, 40, 594, 'Trần Hùng', '', 'Hải', '0982368595', '', 'tran-hung', '', NULL, '2016-11-29', '2016-11-10', '2016-11-29', NULL, '2017-01-11 23:27:30', '2017-01-11 23:27:30', NULL),
(71, 1, 2, 2, 3, 4, 419, 598, 'Lê Ngọc Hải', '', 'Phúc', '0982827895', '', 'le-ngoc-hai', '', NULL, '2016-12-12', '2016-11-10', '2017-02-10', '2017-01-13', '2017-01-11 23:28:11', '2017-01-12 20:37:47', NULL),
(72, 1, 1, 7, 6, 3, 281, 582, 'Hoàng Nam Yên', '', 'Trung', '01699009845', '', 'hoang-nam-yen', '', NULL, '2016-11-28', '2016-10-24', '2016-11-24', NULL, '2017-01-11 23:33:34', '2017-01-11 23:33:34', NULL),
(73, 1, 3, 6, 1, 4, 1, 577, 'Lê Anh Nguyên', '', 'Đăng', '0935058889', '', 'le-anh-nguyen', '', NULL, '2016-12-12', '2016-11-10', '2017-02-10', NULL, '2017-01-11 23:34:59', '2017-01-12 23:33:21', NULL),
(74, 1, 1, 7, 6, 1, 282, 582, 'Nguyễn Tiến Đạt', '', '', '', '', 'nguyen-tien-dat', '', NULL, '2016-11-28', '2016-07-05', '2016-07-21', NULL, '2017-01-11 23:36:40', '2017-01-11 23:36:40', NULL),
(75, 1, 3, 6, 1, 4, 2, 577, 'Nguyễn Thị Thu Hảo', '', 'Đăng', '0935058889', '', 'nguyen-thi-thu-hao', '', NULL, '2016-12-12', '2016-11-10', '2016-12-23', '2017-01-13', '2017-01-11 23:37:30', '2017-01-12 20:37:54', NULL),
(76, 1, 1, 7, 6, 3, 283, 582, 'Huỳnh Thị Trâm Ngọc', '', '', '', '', 'huynh-thi-tram-ngoc', '', NULL, '2016-11-28', '2016-09-29', '2016-11-24', NULL, '2017-01-11 23:38:34', '2017-01-11 23:38:34', NULL),
(77, 1, 3, 6, 1, 4, 3, 677, 'Nguyễn Thị Kim Liễu', '', 'Kiên', '0984388853', '', 'nguyen-thi-kim-lieu', '', NULL, '2016-12-12', '2016-12-10', '2016-12-30', '2017-01-13', '2017-01-11 23:38:53', '2017-01-12 20:38:00', NULL),
(78, 1, NULL, NULL, 6, 2, 284, 582, 'Chưa rõ', '', 'Trung', '01699009845', '', 'chua-ro', '', NULL, '2016-11-28', NULL, NULL, NULL, '2017-01-11 23:41:21', '2017-01-11 23:41:21', NULL),
(79, 1, 4, 2, 17, 4, 713, 589, 'Trần Hùng Tráng', '', 'Trần Sỹ Nghệ', '0912249565', '', 'tran-hung-trang', '', NULL, '2016-11-28', '2016-11-29', '2016-12-29', '2017-01-13', '2017-01-11 23:42:00', '2017-01-12 20:41:02', NULL),
(80, 1, 4, 2, 17, 4, 714, 589, 'Lê Văn Tý', '', 'Trần Sỹ Nghệ', '0912249565', '', 'le-van-ty', '', NULL, '2016-11-28', '2016-11-29', '2016-12-29', '2017-01-13', '2017-01-11 23:43:19', '2017-01-12 20:41:17', NULL),
(81, 1, 1, 7, 6, 3, 285, 582, 'Hà Thị Kim Cúc', '', '', '', '', 'ha-thi-kim-cuc', '', NULL, '2016-11-28', '2016-04-08', '2016-11-24', NULL, '2017-01-11 23:43:27', '2017-01-11 23:43:27', NULL),
(82, 1, 4, 2, 17, 4, 715, 589, 'Trương Công Tuấn', '', 'Trần Sỹ Nghệ', '0912249565', '', 'truong-cong-tuan', '', NULL, '2016-11-28', '2016-11-29', '2016-12-29', '2017-01-13', '2017-01-11 23:44:35', '2017-01-12 20:41:25', NULL),
(83, 1, 1, 4, 6, 1, 286, 582, 'Nguyễn Thị Kim Dung', '', 'Ngà', '0912149555', '', 'nguyen-thi-kim-dung', '', NULL, '2016-11-28', '2016-10-10', '2016-11-30', NULL, '2017-01-11 23:45:00', '2017-01-11 23:45:00', NULL),
(84, 1, 2, 2, 3, 4, 373, 603, 'Phan Hoàng Đạt', '', 'Đinh Đức Thắng', '0944201133', '', 'phan-hoang-dat', '', NULL, '2016-12-05', '2016-10-17', '2017-01-17', '2017-01-13', '2017-01-11 23:46:00', '2017-01-12 20:40:23', NULL),
(85, 1, 1, 4, 10, 4, 6, 603, 'Trần Hùng', '', 'Hậu', '0982368595', '', 'tran-hung', '', NULL, '2016-12-05', '2016-12-05', '2017-02-05', NULL, '2017-01-11 23:47:12', '2017-01-11 23:47:12', NULL),
(86, 1, 1, 7, 6, 3, 281, 582, 'Hoàng Nam Yên', '', 'Trung', '01699009845', '', 'hoang-nam-yen', '', NULL, '2016-11-28', '2016-10-24', '2016-11-24', NULL, '2017-01-11 23:47:12', '2017-01-11 23:47:12', NULL),
(87, 1, 1, 7, 10, 1, 2, 576, 'Nguyễn Văn Dử', '', 'Trang', '01699009845', '', 'nguyen-van-du', '', NULL, '2016-11-28', '2016-11-01', '2016-11-22', NULL, '2017-01-11 23:54:12', '2017-01-11 23:54:12', NULL),
(88, 1, 1, 7, 10, 3, 2, 576, 'Nguyễn Văn Dử', '', 'Hải', '0982368595', '', 'nguyen-van-du', '', NULL, '2016-11-28', '2016-10-01', '2016-11-22', NULL, '2017-01-11 23:55:46', '2017-01-11 23:55:46', NULL),
(89, 1, 2, 4, 3, 4, 423, 550, 'Lê Ngọc Sơn', '', 'Hưng', '', '', 'le-ngoc-son', '', NULL, '2016-11-14', '2016-11-08', '2016-12-08', NULL, '2017-01-11 23:57:31', '2017-01-12 20:47:27', NULL),
(90, 1, 1, 2, 12, 1, 57, 576, 'Nguyễn Thị Huyền', '', 'Lộc', '0912312419', '', 'nguyen-thi-huyen', '', NULL, '2016-11-28', '2016-11-10', '2016-11-24', NULL, '2017-01-11 23:57:57', '2017-01-11 23:57:57', NULL),
(91, 1, 1, 7, 10, 1, 40, 576, 'Nguyễn Xuân Hiển', '', 'Hà', '0982368595', '', 'nguyen-xuan-hien', '', NULL, '2016-11-28', '2016-11-08', '2016-11-13', NULL, '2017-01-11 23:59:51', '2017-01-11 23:59:51', NULL),
(92, 1, 2, 2, 12, 4, 52, 550, 'Nguyễn Thái Tuấn', '', 'Lộc', '0912312419', '', 'nguyen-thai-tuan', '', NULL, '2016-11-14', '2016-11-10', '2016-12-08', NULL, '2017-01-12 17:37:08', '2017-01-12 17:37:08', NULL),
(93, 1, 1, 2, 12, 4, 54, 550, 'Trần Công Trung', '', 'Lộc', '0912312419', '', 'tran-cong-trung', '', NULL, '2016-11-14', '2016-11-14', '2016-12-30', '2017-01-13', '2017-01-12 17:39:40', '2017-01-12 23:05:04', NULL),
(94, 1, 1, 2, 11, 1, 2, 566, 'Trương Thanh Dũng', '', '', '', '', 'truong-thanh-dung', '', NULL, '2016-11-21', '2016-11-16', '2016-12-21', NULL, '2017-01-12 17:40:51', '2017-01-12 17:40:51', NULL),
(95, 1, 1, 4, 5, 4, 66, 563, 'Nguyễn Văn Biên', '', 'Long', '0936317327', '', 'nguyen-van-bien', '', NULL, '2016-11-17', '2016-11-17', '2016-12-23', '2017-01-13', '2017-01-12 17:41:40', '2017-01-12 20:43:26', NULL),
(96, 1, 1, 4, 5, 4, 67, 563, 'Trần Đức Bốn', '', 'Long', '0936317327', '', 'tran-duc-bon', '', NULL, '2016-11-17', '2016-11-17', '2016-12-23', '2017-01-13', '2017-01-12 17:43:25', '2017-01-12 20:43:34', NULL),
(97, 1, 1, 4, 5, 4, 68, 563, 'Lê Văn Nghĩa', '', 'Long', '0936317327', '', 'le-van-nghia', '', NULL, '2016-11-17', '2016-11-17', '2016-12-23', '2017-01-13', '2017-01-12 17:46:12', '2017-01-12 20:43:41', NULL),
(98, 1, 1, 2, 6, 3, 271, 566, 'Phan Thị Nhung ', '', 'Trang', '01699009845', '', 'phan-thi-nhung', '', NULL, '2016-11-21', '2016-11-07', '2016-11-18', NULL, '2017-01-12 17:46:35', '2017-01-12 17:46:35', NULL),
(99, 1, 1, 7, 10, 4, 2, 577, 'Nguyễn Văn Dữ', '', 'Hải', '0982368595', '', 'nguyen-van-du', '', NULL, '2016-11-23', '2016-11-22', '2016-12-22', '2017-01-13', '2017-01-12 17:47:56', '2017-01-12 20:42:29', NULL),
(100, 1, 1, 10, 6, 3, 272, 566, 'Trần Văn Đáng', '', 'Trang', '01699009845', '', 'tran-van-dang', '', NULL, '2016-11-21', '2016-08-12', '2016-11-18', NULL, '2017-01-12 17:48:59', '2017-01-12 17:48:59', NULL),
(101, 1, 1, 2, 3, 4, 439, 577, 'Phan Hoàng Đạt', '', 'Thắng', '0944201133', '', 'phan-hoang-dat', '', NULL, '2016-11-23', '2016-11-17', '2017-01-17', '2017-01-13', '2017-01-12 17:49:23', '2017-01-12 20:43:13', NULL),
(102, 1, 1, 2, 6, 3, 273, 566, 'Trần Thị Khánh Linh', '', 'Trang', '01699009845', '', 'tran-thi-khanh-linh', '', NULL, '2016-11-21', '2016-11-04', '2016-11-30', NULL, '2017-01-12 17:50:40', '2017-01-12 17:50:40', NULL),
(103, 1, 1, 7, 6, 4, 287, 577, 'Phan Thị Nhung', '', 'Trung', '01699009845', '', 'phan-thi-nhung', '', NULL, '2016-11-23', '2016-11-24', '2016-12-15', '2017-01-13', '2017-01-12 17:51:06', '2017-01-12 20:52:22', NULL),
(104, 1, 2, 2, 3, 4, 373, 507, 'Phan Hoàng Đạt', '', 'Đinh Đức Thắng', '0944201133', '', 'phan-hoang-dat', '', NULL, '2016-10-18', '2016-10-17', '2016-11-17', NULL, '2017-01-12 17:53:53', '2017-01-12 20:48:41', NULL),
(105, 1, 1, 7, 16, 4, 190, 510, 'Nguyễn Văn Nam', '', 'Trà Đình Nam', '0935345685', '', 'nguyen-van-nam', '', NULL, '2016-10-18', '2016-10-17', '2016-11-17', NULL, '2017-01-12 18:03:53', '2017-01-12 18:03:53', NULL),
(106, 1, 2, 4, 3, 4, 406, 533, 'Đinh Xuân Mão', '', 'Hưng', '0995850995', '', 'dinh-xuan-mao', '', NULL, '2016-11-01', '2016-11-01', '2017-03-01', NULL, '2017-01-12 18:05:39', '2017-01-12 18:05:39', NULL),
(107, 1, 2, 4, 14, 4, 367, 550, 'Trần Thị Chiến', '', 'Long', '0905809089', '', 'tran-thi-chien', '', NULL, '2016-11-14', '2016-11-12', '2017-02-10', NULL, '2017-01-12 18:07:58', '2017-01-12 18:07:58', NULL),
(108, 1, 2, 2, 14, 4, 368, 550, 'Ngô Quốc Vũ', '', 'Long', '0905809089', '', 'ngo-quoc-vu', '', NULL, '2016-11-14', '2016-11-12', '2016-12-12', '2017-01-13', '2017-01-12 18:17:55', '2017-01-12 22:56:15', NULL),
(109, 1, 2, 3, 3, 4, 418, 550, 'Nguyễn Văn Quang', '', 'Thắng', '0944201133', '', 'nguyen-van-quang', '', NULL, '2016-11-14', '2016-11-10', '2016-12-01', '2017-01-13', '2017-01-12 18:25:23', '2017-01-12 22:52:27', NULL),
(110, 1, 2, 2, 10, 4, 2, 487, 'Phan Thanh Tuấn', '', 'Hiền', '0972722451', '', 'phan-thanh-tuan', '', NULL, '2016-10-05', '2016-10-04', '2016-11-17', NULL, '2017-01-12 18:28:13', '2017-01-12 18:28:13', NULL),
(111, 1, 1, 4, 6, 4, 235, 498, 'Võ Văn Sỹ', '', 'Dũng', '0977222727', '', 'vo-van-sy', '', NULL, '2016-10-12', '2016-10-11', '2016-12-01', '2017-01-13', '2017-01-12 18:32:42', '2017-01-12 20:15:33', NULL),
(112, 1, 2, 2, 6, 4, 236, 498, 'Nguyễn Hoàng Cường', '', 'Dũng', '0977222727', '', 'nguyen-hoang-cuong', '', NULL, '2016-10-12', '2016-10-11', '2016-11-17', NULL, '2017-01-12 18:46:42', '2017-01-12 18:46:42', NULL),
(113, 1, NULL, NULL, 6, 2, 313, 654, 'Chưa rõ', '', '', '', '', 'chua-ro', '', NULL, '2016-12-29', NULL, NULL, NULL, '2017-01-12 19:23:14', '2017-01-12 19:23:14', NULL),
(114, 1, 1, 4, 6, 4, 212, 456, 'Đàm Văn Thởi', '', 'Ngà', '0912149555', '', 'dam-van-thoi', '', NULL, '2016-09-21', '2016-09-20', '2016-12-10', NULL, '2017-01-12 19:47:04', '2017-01-12 19:47:04', NULL),
(115, 1, 1, 7, 6, 1, 314, 654, 'Nguyễn Hồng Lâm', '', 'Trung', '', '', 'nguyen-hong-lam', '', NULL, '2016-12-29', '2016-10-01', '2016-12-28', NULL, '2017-01-12 19:47:27', '2017-01-12 19:47:27', NULL),
(116, 1, 1, 4, 6, 4, 213, 456, 'Phạm Văn Nghiêm', '', 'Ngà', '0912149555', '', 'pham-van-nghiem', '', NULL, '2016-09-21', '2016-09-20', '2016-12-10', NULL, '2017-01-12 19:51:37', '2017-01-12 19:51:37', NULL),
(117, 1, 3, 6, 1, 4, 42, 462, 'Nguyễn Văn Hữu', '', 'Hiếu', '', '', 'nguyen-van-huu', '', NULL, '2016-09-22', '2016-10-07', '2017-01-07', NULL, '2017-01-12 19:54:23', '2017-01-12 19:56:42', NULL),
(118, 1, 3, 5, 1, 4, 43, 462, 'Trần Văn Thành', '', 'An', '', '', 'tran-van-thanh', '', NULL, '2016-09-22', '2016-10-07', '2017-01-07', NULL, '2017-01-12 19:56:26', '2017-01-12 19:56:26', NULL),
(119, 1, 3, 6, 1, 4, 44, 462, 'Lê Nam Cao', '', 'An', '', '', 'le-nam-cao', '', NULL, '2016-09-22', '2016-10-07', '2017-01-07', NULL, '2017-01-12 19:58:50', '2017-01-12 19:58:50', NULL),
(120, 1, 3, 6, 1, 4, 45, 462, 'Mai Xuân Ái', '', 'Thương', '', '', 'mai-xuan-ai', '', NULL, '2016-09-22', '2016-10-07', '2017-01-07', NULL, '2017-01-12 20:01:27', '2017-01-12 20:01:27', NULL),
(121, 1, 1, 7, 5, 4, 51, 470, 'Phạm Hồng Thái', '', 'Toản', '0912098312', '', 'pham-hong-thai', '', NULL, '2016-09-28', '2016-09-27', '2016-12-27', NULL, '2017-01-12 20:03:01', '2017-01-12 20:03:01', NULL),
(122, 1, 2, 2, 3, 4, 313, 428, 'Đặng Trung Đông', '', 'Hưng', '0913906525', '', 'dang-trung-dong', '', NULL, '2016-09-09', '2016-09-08', '2016-12-08', NULL, '2017-01-12 20:08:06', '2017-01-12 20:08:06', NULL),
(123, 1, 2, 2, 3, 4, 314, 428, 'Lê Ngọc Sơn', '', 'Hưng', '0913906525', '', 'le-ngoc-son', '', NULL, '2016-09-09', '2016-09-09', '2016-12-09', NULL, '2017-01-12 20:09:25', '2017-01-12 20:09:54', NULL),
(124, 1, 4, 4, 10, 4, 36, 15, 'Phan Hoàng Thế', '', 'Tư', '0913295302', '', 'phan-hoang-the', '', NULL, '2017-01-13', '2017-01-13', '2017-01-27', NULL, '2017-01-12 23:29:43', '2017-01-12 23:29:43', NULL),
(125, 1, 4, 2, 10, 1, 37, 15, 'Nguyễn Văn Tùng', '', 'Tư', '0913295302', '', 'nguyen-van-tung', '', NULL, '2017-01-13', '2017-01-13', '2017-01-27', NULL, '2017-01-12 23:32:22', '2017-01-12 23:32:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_purpose`
--

CREATE TABLE `order_purpose` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `purpose_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE `phones` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`id`, `order_id`, `number`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '359245061501530', 'warning', '2017-01-11 02:57:49', '2017-01-11 18:55:49', NULL),
(2, 2, '0949782187', 'success', '2017-01-11 03:04:17', '2017-01-11 03:07:03', NULL),
(3, 3, '0949782187', 'warning', '2017-01-11 03:06:27', '2017-01-11 03:06:27', NULL),
(4, 4, '01239746803', 'success', '2017-01-11 03:17:53', '2017-01-11 18:55:42', NULL),
(5, 4, '0941809547', 'success', '2017-01-11 03:17:53', '2017-01-11 23:49:28', NULL),
(6, 4, '0945872379', 'success', '2017-01-11 03:17:53', '2017-01-12 18:33:33', NULL),
(7, 5, '0981470128', 'success', '2017-01-11 03:23:07', '2017-01-11 03:23:45', NULL),
(8, 6, '0971567276', 'success', '2017-01-11 03:29:58', '2017-01-11 03:31:11', NULL),
(9, 6, '01683327682', 'success', '2017-01-11 03:29:58', '2017-01-11 03:31:39', NULL),
(10, 6, '0945430883', 'success', '2017-01-11 03:29:58', '2017-01-11 03:31:59', NULL),
(11, 6, '0944577681', 'success', '2017-01-11 03:29:58', '2017-01-11 03:32:22', NULL),
(12, 6, '01263178280', 'success', '2017-01-11 03:29:58', '2017-01-11 03:32:41', NULL),
(13, 6, '0914981035', 'success', '2017-01-11 03:29:58', '2017-01-11 03:32:54', NULL),
(14, 6, '0911371472', 'success', '2017-01-11 03:29:58', '2017-01-11 03:35:57', NULL),
(15, 6, '01205935484', 'success', '2017-01-11 03:29:58', '2017-01-11 03:33:23', NULL),
(16, 6, '01269422494', 'success', '2017-01-11 03:29:58', '2017-01-11 03:33:38', NULL),
(17, 6, '0986800386', 'success', '2017-01-11 03:29:58', '2017-01-11 03:33:52', NULL),
(18, 7, '0946898372', 'warning', '2017-01-11 19:34:35', '2017-01-11 19:34:35', NULL),
(19, 7, '0972327555', 'warning', '2017-01-11 19:34:35', '2017-01-11 19:34:35', NULL),
(20, 8, '0989333877', 'warning', '2017-01-11 19:37:53', '2017-01-11 19:37:53', NULL),
(21, 9, '01658572199', 'success', '2017-01-11 19:39:18', '2017-01-11 20:02:53', NULL),
(22, 9, '0932464746', 'danger', '2017-01-11 19:39:18', '2017-01-12 20:36:02', NULL),
(23, 10, '0966784777', 'warning', '2017-01-11 19:41:39', '2017-01-11 19:41:39', NULL),
(24, 10, '01633333127', 'warning', '2017-01-11 19:41:39', '2017-01-11 19:41:39', NULL),
(25, 10, '01672488211', 'warning', '2017-01-11 19:41:39', '2017-01-11 19:41:39', NULL),
(26, 11, '0985468818', 'warning', '2017-01-11 19:43:50', '2017-01-11 19:43:50', NULL),
(27, 11, '01228552585', 'warning', '2017-01-11 19:43:51', '2017-01-11 19:43:51', NULL),
(28, 11, '0944881389', 'warning', '2017-01-11 19:43:51', '2017-01-11 19:43:51', NULL),
(29, 12, '01219182846', 'success', '2017-01-11 19:44:21', '2017-01-11 20:03:26', NULL),
(30, 13, '01212738888', 'warning', '2017-01-11 19:46:16', '2017-01-11 19:46:16', NULL),
(31, 13, '012688604704', 'warning', '2017-01-11 19:46:16', '2017-01-11 19:46:16', NULL),
(32, 13, '01205908973', 'warning', '2017-01-11 19:46:17', '2017-01-11 19:46:17', NULL),
(33, 14, '096673553', 'danger', '2017-01-11 19:47:43', '2017-01-12 20:28:41', NULL),
(34, 14, '0932311851', 'danger', '2017-01-11 19:47:43', '2017-01-12 20:28:59', NULL),
(35, 15, '01295107352', 'success', '2017-01-11 19:48:18', '2017-01-11 23:53:12', NULL),
(36, 15, '0949632095', 'success', '2017-01-11 19:48:18', '2017-01-11 23:53:30', NULL),
(37, 16, '01257897881', 'success', '2017-01-11 19:49:52', '2017-01-11 20:02:28', NULL),
(38, 17, '01239746803', 'warning', '2017-01-11 19:50:07', '2017-01-11 19:50:07', NULL),
(39, 17, '0941809547', 'warning', '2017-01-11 19:50:07', '2017-01-11 19:50:07', NULL),
(40, 17, '0945872379', 'warning', '2017-01-11 19:50:07', '2017-01-11 19:50:07', NULL),
(41, 18, '01259345228', 'success', '2017-01-11 19:52:22', '2017-01-11 23:45:30', NULL),
(42, 18, '0916665142', 'success', '2017-01-11 19:52:22', '2017-01-11 23:46:26', NULL),
(43, 18, '0914555240', 'success', '2017-01-11 19:52:22', '2017-01-11 23:46:07', NULL),
(44, 18, '01354969270', 'success', '2017-01-11 19:52:22', '2017-01-11 23:45:52', NULL),
(45, 19, '0948179970', 'success', '2017-01-11 19:54:54', '2017-01-11 20:02:37', NULL),
(46, 20, '359362036231661', 'success', '2017-01-11 19:55:00', '2017-01-11 23:46:49', NULL),
(47, 20, '01259345228', 'warning', '2017-01-11 19:55:00', '2017-01-12 19:43:31', NULL),
(48, 20, '01698636533', 'success', '2017-01-11 19:55:00', '2017-01-11 23:47:33', NULL),
(49, 20, '0915874078', 'success', '2017-01-11 19:55:00', '2017-01-11 23:47:12', NULL),
(50, 21, '0985729671', 'success', '2017-01-11 19:56:33', '2017-01-11 20:02:20', NULL),
(51, 22, '01263145455', 'success', '2017-01-11 19:58:43', '2017-01-11 20:02:08', NULL),
(52, 23, '01654969270', 'warning', '2017-01-11 20:04:04', '2017-01-11 20:04:04', NULL),
(53, 23, '01698636533', 'warning', '2017-01-11 20:04:04', '2017-01-11 20:04:04', NULL),
(54, 23, '0915874078', 'warning', '2017-01-11 20:04:04', '2017-01-11 20:04:04', NULL),
(55, 23, '0966084084', 'warning', '2017-01-11 20:04:04', '2017-01-11 20:04:04', NULL),
(56, 23, '0979517412', 'warning', '2017-01-11 20:04:04', '2017-01-11 20:04:04', NULL),
(57, 23, '0916665142', 'warning', '2017-01-11 20:04:04', '2017-01-11 20:04:04', NULL),
(58, 23, '0914555240', 'warning', '2017-01-11 20:04:04', '2017-01-11 20:04:04', NULL),
(59, 24, '0981470128', 'warning', '2017-01-11 20:07:16', '2017-01-11 20:07:16', NULL),
(60, 25, '01658399794', 'success', '2017-01-11 20:08:20', '2017-01-11 20:12:16', NULL),
(61, 26, '0973701777', 'success', '2017-01-11 20:10:19', '2017-01-11 20:12:21', NULL),
(62, 27, '01673153111', 'success', '2017-01-11 20:11:54', '2017-01-11 20:12:30', NULL),
(63, 28, '980056009537107', 'warning', '2017-01-11 20:15:17', '2017-01-11 20:15:17', NULL),
(64, 29, '01219182846', 'success', '2017-01-11 20:17:14', '2017-01-11 23:42:00', NULL),
(65, 30, '0989890023', 'success', '2017-01-11 20:19:09', '2017-01-11 23:38:48', NULL),
(66, 30, '0987124883', 'success', '2017-01-11 20:19:09', '2017-01-11 23:39:18', NULL),
(67, 31, '0914698417', 'success', '2017-01-11 20:19:24', '2017-01-11 20:32:13', NULL),
(68, 31, '0977410444', 'success', '2017-01-11 20:19:24', '2017-01-11 20:31:17', NULL),
(69, 32, '0968776666', 'success', '2017-01-11 20:22:01', '2017-01-11 23:41:27', NULL),
(70, 32, '0978543888', 'success', '2017-01-11 20:22:01', '2017-01-11 23:40:35', NULL),
(71, 32, '0949989999', 'success', '2017-01-11 20:22:01', '2017-01-11 23:40:05', NULL),
(72, 33, '01672448301', 'success', '2017-01-11 20:23:11', '2017-01-11 20:31:08', NULL),
(73, 34, '0971995965', 'success', '2017-01-11 20:24:44', '2017-01-11 23:36:42', NULL),
(74, 34, '357192052519500', 'warning', '2017-01-11 20:24:44', '2017-01-11 20:24:44', NULL),
(75, 34, '862193034669660', 'warning', '2017-01-11 20:24:44', '2017-01-11 20:24:44', NULL),
(76, 34, '0935978431', 'success', '2017-01-11 20:24:44', '2017-01-11 23:35:35', NULL),
(77, 34, '01653567066', 'success', '2017-01-11 20:24:44', '2017-01-11 23:36:23', NULL),
(78, 34, '0912731200', 'success', '2017-01-11 20:24:44', '2017-01-11 23:35:58', NULL),
(79, 34, '0917323006', 'success', '2017-01-11 20:24:44', '2017-01-11 23:35:14', NULL),
(80, 35, '0975396999', 'success', '2017-01-11 20:27:51', '2017-01-11 23:34:30', NULL),
(81, 36, '0964041167', 'success', '2017-01-11 20:29:07', '2017-01-11 20:31:35', NULL),
(82, 36, '0907928692', 'success', '2017-01-11 20:29:07', '2017-01-11 20:31:41', NULL),
(83, 36, '0917837576', 'success', '2017-01-11 20:29:07', '2017-01-11 20:31:46', NULL),
(84, 37, '0916796489', 'success', '2017-01-11 20:30:15', '2017-01-11 23:31:55', NULL),
(85, 38, '0973403064', 'success', '2017-01-11 20:30:39', '2017-01-11 20:32:07', NULL),
(86, 39, '0912457963', 'success', '2017-01-11 20:32:32', '2017-01-11 23:33:28', NULL),
(87, 39, '01235940825', 'success', '2017-01-11 20:32:32', '2017-01-11 23:34:07', NULL),
(88, 40, '01226245723', 'success', '2017-01-11 20:34:30', '2017-01-11 20:44:50', NULL),
(89, 40, '0912018288', 'success', '2017-01-11 20:34:30', '2017-01-11 20:44:55', NULL),
(90, 40, '0988787235', 'success', '2017-01-11 20:34:30', '2017-01-11 20:45:00', NULL),
(91, 41, '359128074983533', 'warning', '2017-01-11 20:36:07', '2017-01-11 20:36:07', NULL),
(92, 42, '0935206224', 'success', '2017-01-11 20:37:17', '2017-01-11 20:45:08', NULL),
(93, 42, '01224561555', 'success', '2017-01-11 20:37:17', '2017-01-11 20:45:13', NULL),
(94, 43, '359128074983533', 'warning', '2017-01-11 20:37:56', '2017-01-11 20:37:56', NULL),
(95, 44, '0975396999', 'success', '2017-01-11 20:39:51', '2017-01-11 20:44:19', NULL),
(96, 44, '0912457963', 'success', '2017-01-11 20:39:51', '2017-01-11 20:44:25', NULL),
(97, 45, '0983210277', 'success', '2017-01-11 20:40:24', '2017-01-11 23:42:25', NULL),
(98, 45, '01674503203', 'success', '2017-01-11 20:40:24', '2017-01-11 23:42:55', NULL),
(99, 46, '0983210277', 'warning', '2017-01-11 20:41:50', '2017-01-11 20:41:50', NULL),
(100, 46, '01674503203', 'warning', '2017-01-11 20:41:50', '2017-01-11 20:41:50', NULL),
(101, 47, '01235940825', 'success', '2017-01-11 20:43:17', '2017-01-11 20:44:30', NULL),
(102, 47, '0918918705', 'success', '2017-01-11 20:43:17', '2017-01-11 20:44:35', NULL),
(103, 48, '01657297154', 'success', '2017-01-11 20:45:02', '2017-01-11 23:25:50', NULL),
(104, 48, '863008033866184', 'warning', '2017-01-11 20:45:02', '2017-01-11 20:45:02', NULL),
(105, 48, '863008035866192', 'warning', '2017-01-11 20:45:02', '2017-01-11 20:45:02', NULL),
(106, 48, '0913258906', 'success', '2017-01-11 20:45:02', '2017-01-11 23:25:41', NULL),
(107, 48, '01263074709', 'success', '2017-01-11 20:45:02', '2017-01-11 23:26:10', NULL),
(108, 48, '01675465629', 'success', '2017-01-11 20:45:02', '2017-01-11 23:26:01', NULL),
(109, 49, '0946898372', 'success', '2017-01-11 20:48:29', '2017-01-11 20:53:28', NULL),
(110, 49, '0972327555', 'success', '2017-01-11 20:48:29', '2017-01-11 20:53:34', NULL),
(111, 50, '0911905689', 'success', '2017-01-11 20:49:26', '2017-01-11 23:28:20', NULL),
(112, 51, '0949782187', 'success', '2017-01-11 20:50:26', '2017-01-11 20:53:40', NULL),
(113, 52, '0965714225', 'success', '2017-01-11 20:51:07', '2017-01-11 23:32:41', NULL),
(114, 53, '0973701777', 'success', '2017-01-11 20:52:59', '2017-01-11 20:53:20', NULL),
(115, 54, '01205951232', 'success', '2017-01-11 20:53:27', '2017-01-11 23:29:56', NULL),
(116, 55, '01259364792', 'warning', '2017-01-11 22:56:08', '2017-01-11 22:56:08', NULL),
(117, 56, '356376050523202', 'warning', '2017-01-11 23:00:46', '2017-01-11 23:00:46', NULL),
(118, 57, '0983210277', 'success', '2017-01-11 23:03:19', '2017-01-11 23:27:30', NULL),
(119, 57, '0905739398', 'warning', '2017-01-11 23:03:19', '2017-01-11 23:03:19', NULL),
(120, 58, '0905739398', 'success', '2017-01-11 23:04:47', '2017-01-12 23:55:16', NULL),
(121, 59, '357337071830249', 'warning', '2017-01-11 23:06:13', '2017-01-11 23:06:13', NULL),
(122, 60, '0935930097', 'warning', '2017-01-11 23:11:33', '2017-01-11 23:11:33', NULL),
(123, 60, '01667208577', 'warning', '2017-01-11 23:11:33', '2017-01-11 23:11:33', NULL),
(124, 61, '0911009734', 'success', '2017-01-11 23:13:30', '2017-01-12 23:51:30', NULL),
(125, 61, '0963798673', 'success', '2017-01-11 23:13:30', '2017-01-12 23:52:58', NULL),
(126, 62, '01663416908', 'danger', '2017-01-11 23:17:09', '2017-01-12 20:34:15', NULL),
(127, 63, '0949096306', 'success', '2017-01-11 23:17:15', '2017-01-12 23:53:49', NULL),
(128, 63, '0943466053', 'success', '2017-01-11 23:17:15', '2017-01-12 23:54:27', NULL),
(129, 64, '01289151705', 'success', '2017-01-11 23:19:25', '2017-01-12 23:56:23', NULL),
(130, 65, '01627945217', 'danger', '2017-01-11 23:19:36', '2017-01-12 20:34:23', NULL),
(131, 65, '0987945926', 'danger', '2017-01-11 23:19:36', '2017-01-12 20:34:40', NULL),
(132, 66, '355156068274532', 'warning', '2017-01-11 23:22:20', '2017-01-11 23:22:20', NULL),
(133, 66, '354729663521230', 'warning', '2017-01-11 23:22:20', '2017-01-11 23:22:20', NULL),
(134, 67, '0919226213', 'danger', '2017-01-11 23:22:29', '2017-01-12 20:37:12', NULL),
(135, 68, '0983646703', 'danger', '2017-01-11 23:24:57', '2017-01-12 20:37:18', NULL),
(136, 68, '01685726633', 'danger', '2017-01-11 23:24:57', '2017-01-12 20:37:23', NULL),
(137, 69, '0972669977', 'success', '2017-01-11 23:25:31', '2017-01-12 23:33:05', NULL),
(138, 70, '01678425539', 'warning', '2017-01-11 23:27:31', '2017-01-11 23:27:31', NULL),
(139, 70, '01208197204', 'warning', '2017-01-11 23:27:31', '2017-01-11 23:27:31', NULL),
(140, 70, '0989233891', 'warning', '2017-01-11 23:27:31', '2017-01-11 23:27:31', NULL),
(141, 71, '0948246180', 'danger', '2017-01-11 23:28:11', '2017-01-12 20:37:43', NULL),
(142, 71, '01669652273', 'danger', '2017-01-11 23:28:11', '2017-01-12 20:37:47', NULL),
(143, 72, '3 52260058636680', 'warning', '2017-01-11 23:33:34', '2017-01-11 23:33:34', NULL),
(144, 72, '358721061127931', 'warning', '2017-01-11 23:33:34', '2017-01-11 23:33:34', NULL),
(145, 72, '358721061127923', 'warning', '2017-01-11 23:33:34', '2017-01-11 23:33:34', NULL),
(146, 72, '354868025962990', 'warning', '2017-01-11 23:33:34', '2017-01-11 23:33:34', NULL),
(147, 73, '0915801522', 'success', '2017-01-11 23:34:59', '2017-01-11 23:35:11', NULL),
(148, 73, '0916550674', 'success', '2017-01-11 23:34:59', '2017-01-11 23:35:16', NULL),
(149, 74, '0973137944', 'success', '2017-01-11 23:36:40', '2017-01-12 23:43:19', NULL),
(150, 74, '098211833', 'success', '2017-01-11 23:36:40', '2017-01-12 23:44:51', NULL),
(151, 74, '0941171516', 'warning', '2017-01-11 23:36:40', '2017-01-11 23:36:40', NULL),
(152, 74, '0962998897', 'success', '2017-01-11 23:36:40', '2017-01-12 23:44:09', NULL),
(153, 75, '0978712845', 'danger', '2017-01-11 23:37:30', '2017-01-12 20:37:54', NULL),
(154, 76, '353317071012703', 'warning', '2017-01-11 23:38:34', '2017-01-11 23:38:34', NULL),
(155, 77, '01694488607', 'danger', '2017-01-11 23:38:53', '2017-01-12 20:38:00', NULL),
(156, 78, '01655405718', 'success', '2017-01-11 23:41:21', '2017-01-13 00:05:52', NULL),
(157, 78, '0996197888', 'success', '2017-01-11 23:41:21', '2017-01-13 00:04:36', NULL),
(158, 78, '0941376966', 'success', '2017-01-11 23:41:21', '2017-01-13 00:05:52', NULL),
(159, 78, '0946032778', 'success', '2017-01-11 23:41:21', '2017-01-13 00:05:52', NULL),
(160, 78, '0911371472', 'success', '2017-01-11 23:41:21', '2017-01-13 00:05:52', NULL),
(161, 79, '0913018077', 'danger', '2017-01-11 23:42:00', '2017-01-12 20:41:02', NULL),
(162, 80, '0988598388', 'danger', '2017-01-11 23:43:19', '2017-01-12 20:41:17', NULL),
(163, 81, '35585905165560', 'warning', '2017-01-11 23:43:27', '2017-01-11 23:43:27', NULL),
(164, 82, '0912944618', 'danger', '2017-01-11 23:44:35', '2017-01-12 20:41:25', NULL),
(165, 83, '0976606585', 'success', '2017-01-11 23:45:00', '2017-01-12 23:50:13', NULL),
(166, 84, '0961954008', 'danger', '2017-01-11 23:46:00', '2017-01-12 20:40:23', NULL),
(167, 85, '862193034669660', 'success', '2017-01-11 23:47:12', '2017-01-11 23:47:50', NULL),
(168, 86, '352260058636680', 'warning', '2017-01-11 23:47:12', '2017-01-11 23:47:12', NULL),
(169, 86, '358721061127931', 'warning', '2017-01-11 23:47:12', '2017-01-11 23:47:12', NULL),
(170, 86, '358721061127923', 'warning', '2017-01-11 23:47:12', '2017-01-11 23:47:12', NULL),
(171, 86, '354868025962990', 'warning', '2017-01-11 23:47:12', '2017-01-11 23:47:12', NULL),
(172, 87, '0913753339', 'success', '2017-01-11 23:54:12', '2017-01-12 23:47:28', NULL),
(173, 88, '359278060309720', 'warning', '2017-01-11 23:55:46', '2017-01-11 23:55:46', NULL),
(174, 89, '01238680938', 'success', '2017-01-11 23:57:31', '2017-01-11 23:59:24', NULL),
(175, 90, '01673789178', 'warning', '2017-01-11 23:57:57', '2017-01-11 23:57:57', NULL),
(176, 90, '0971964088', 'warning', '2017-01-11 23:57:57', '2017-01-11 23:57:57', NULL),
(177, 91, '01657602625', 'success', '2017-01-11 23:59:51', '2017-01-12 23:36:21', NULL),
(178, 91, '01258588301', 'success', '2017-01-11 23:59:51', '2017-01-12 23:36:58', NULL),
(179, 91, '01659945524', 'success', '2017-01-11 23:59:51', '2017-01-12 23:37:27', NULL),
(180, 91, '0914285300', 'success', '2017-01-11 23:59:51', '2017-01-12 23:35:27', NULL),
(181, 92, '359249061386421', 'success', '2017-01-12 17:37:08', '2017-01-12 17:44:35', NULL),
(182, 92, '353541071297010', 'success', '2017-01-12 17:37:08', '2017-01-12 17:44:41', NULL),
(183, 93, '0912807446', 'success', '2017-01-12 17:39:41', '2017-01-12 23:59:14', NULL),
(184, 93, '0967741267', 'success', '2017-01-12 17:39:41', '2017-01-12 23:59:40', NULL),
(185, 94, '01257313160', 'success', '2017-01-12 17:40:51', '2017-01-12 23:48:33', NULL),
(186, 95, '0914470631', 'danger', '2017-01-12 17:41:41', '2017-01-12 20:43:26', NULL),
(187, 96, '0912517694', 'danger', '2017-01-12 17:43:25', '2017-01-12 20:43:34', NULL),
(188, 97, '0986999879', 'danger', '2017-01-12 17:46:12', '2017-01-12 20:43:41', NULL),
(189, 98, '013176003956610', 'warning', '2017-01-12 17:46:35', '2017-01-12 17:46:35', NULL),
(190, 98, '353416083430539', 'warning', '2017-01-12 17:46:35', '2017-01-12 17:46:35', NULL),
(191, 98, '353415083430831', 'warning', '2017-01-12 17:46:35', '2017-01-12 17:46:35', NULL),
(192, 98, '358093060900902', 'warning', '2017-01-12 17:46:35', '2017-01-12 17:46:35', NULL),
(193, 99, '0916784178', 'danger', '2017-01-12 17:47:56', '2017-01-12 20:42:29', NULL),
(194, 100, '359312044992523', 'warning', '2017-01-12 17:48:59', '2017-01-12 17:48:59', NULL),
(195, 100, '352005068876989', 'warning', '2017-01-12 17:48:59', '2017-01-12 17:48:59', NULL),
(196, 100, '359312044992531', 'warning', '2017-01-12 17:48:59', '2017-01-12 17:48:59', NULL),
(197, 101, '0917189117', 'danger', '2017-01-12 17:49:23', '2017-01-12 20:43:13', NULL),
(198, 102, '355435071875024', 'warning', '2017-01-12 17:50:40', '2017-01-12 17:50:40', NULL),
(199, 103, '0868977197', 'danger', '2017-01-12 17:51:06', '2017-01-12 20:52:08', NULL),
(200, 103, '0916710700', 'danger', '2017-01-12 17:51:06', '2017-01-12 20:52:22', NULL),
(201, 104, '0961954008', 'success', '2017-01-12 17:53:53', '2017-01-12 17:53:59', NULL),
(202, 104, '0988820500', 'success', '2017-01-12 17:53:53', '2017-01-12 17:54:06', NULL),
(203, 105, '0919625540', 'success', '2017-01-12 18:03:54', '2017-01-12 18:06:02', NULL),
(204, 105, '35183007194570', 'success', '2017-01-12 18:03:54', '2017-01-12 18:06:08', NULL),
(205, 106, '0987063156', 'success', '2017-01-12 18:05:39', '2017-01-12 18:05:50', NULL),
(206, 106, '0964797100', 'success', '2017-01-12 18:05:39', '2017-01-12 18:05:56', NULL),
(207, 107, '01257897881', 'success', '2017-01-12 18:07:58', '2017-01-12 18:21:11', NULL),
(208, 107, '0932311851', 'success', '2017-01-12 18:07:58', '2017-01-12 18:21:16', NULL),
(209, 108, '0914579153', 'success', '2017-01-12 18:17:55', '2017-01-12 22:59:27', NULL),
(210, 108, '0969606114', 'success', '2017-01-12 18:17:55', '2017-01-12 22:59:32', NULL),
(211, 109, '0972664582', 'success', '2017-01-12 18:25:23', '2017-01-12 22:55:16', NULL),
(212, 109, '01654709835', 'success', '2017-01-12 18:25:23', '2017-01-12 22:55:22', NULL),
(213, 110, '0949042809', 'success', '2017-01-12 18:28:13', '2017-01-12 19:48:17', NULL),
(214, 110, '0919347139', 'success', '2017-01-12 18:28:13', '2017-01-12 19:48:23', NULL),
(215, 111, '0915443171', 'danger', '2017-01-12 18:32:42', '2017-01-12 20:15:33', NULL),
(216, 112, '01682224349', 'success', '2017-01-12 18:46:42', '2017-01-12 19:48:06', NULL),
(217, 112, '0975662557', 'success', '2017-01-12 18:46:42', '2017-01-12 19:48:12', NULL),
(218, 113, '01259345228', 'success', '2017-01-12 19:23:14', '2017-01-12 19:31:53', NULL),
(219, 113, '01698636533', 'warning', '2017-01-12 19:23:14', '2017-01-12 19:23:14', NULL),
(220, 113, '0915874078', 'warning', '2017-01-12 19:23:14', '2017-01-12 19:23:14', NULL),
(221, 113, '0966084084', 'warning', '2017-01-12 19:23:14', '2017-01-12 19:23:14', NULL),
(222, 113, '0979517412', 'warning', '2017-01-12 19:23:14', '2017-01-12 19:23:14', NULL),
(223, 113, '0916665142', 'warning', '2017-01-12 19:23:14', '2017-01-12 19:23:14', NULL),
(224, 113, '0914555240', 'success', '2017-01-12 19:23:14', '2017-01-12 19:31:21', NULL),
(225, 113, '01654969270', 'warning', '2017-01-12 19:23:14', '2017-01-12 19:23:14', NULL),
(226, 114, '01693528175', 'success', '2017-01-12 19:47:04', '2017-01-12 19:48:28', NULL),
(227, 115, '359362036231661', 'success', '2017-01-12 19:47:27', '2017-01-12 19:49:55', NULL),
(228, 115, '01698636533', 'success', '2017-01-12 19:47:27', '2017-01-12 19:51:51', NULL),
(229, 115, '0915874078', 'success', '2017-01-12 19:47:27', '2017-01-12 19:51:43', NULL),
(230, 116, '0928998544', 'success', '2017-01-12 19:51:37', '2017-01-12 19:57:12', NULL),
(231, 116, '01696769764', 'success', '2017-01-12 19:51:37', '2017-01-12 19:57:17', NULL),
(232, 117, '0913368456', 'success', '2017-01-12 19:54:23', '2017-01-12 19:56:49', NULL),
(233, 117, '0984660008', 'success', '2017-01-12 19:54:23', '2017-01-12 19:56:55', NULL),
(234, 118, '0964041167', 'success', '2017-01-12 19:56:26', '2017-01-12 19:57:00', NULL),
(235, 118, '0907928692', 'success', '2017-01-12 19:56:26', '2017-01-12 19:57:05', NULL),
(236, 119, '0915017708', 'success', '2017-01-12 19:58:50', '2017-01-12 19:59:24', NULL),
(237, 119, '0973403064', 'success', '2017-01-12 19:58:50', '2017-01-12 19:59:29', NULL),
(238, 120, '0935206224', 'success', '2017-01-12 20:01:27', '2017-01-12 20:03:19', NULL),
(239, 120, '01224561555', 'success', '2017-01-12 20:01:27', '2017-01-12 20:03:24', NULL),
(240, 121, '0947482983', 'success', '2017-01-12 20:03:01', '2017-01-12 20:03:08', NULL),
(241, 122, '0977177186', 'success', '2017-01-12 20:08:06', '2017-01-12 20:09:30', NULL),
(242, 122, '0971513773', 'success', '2017-01-12 20:08:06', '2017-01-12 20:09:36', NULL),
(243, 123, '0914698417', 'success', '2017-01-12 20:09:25', '2017-01-12 20:09:54', NULL),
(244, 123, '0977410444', 'success', '2017-01-12 20:09:25', '2017-01-12 20:10:11', NULL),
(245, 124, '0946161093', 'warning', '2017-01-12 23:29:43', '2017-01-12 23:29:43', NULL),
(246, 125, '0912607572', 'warning', '2017-01-12 23:32:22', '2017-01-12 23:32:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purposes`
--

CREATE TABLE `purposes` (
  `id` int(10) UNSIGNED NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purposes`
--

INSERT INTO `purposes` (`id`, `symbol`, `description`, `group`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'list', '', 'list', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL),
(2, 'xmctb', '', 'xmctb', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL),
(3, 'imei', '', 'imei', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL),
(4, 'giám sát', '', 'monitor', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ships`
--

CREATE TABLE `ships` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `number_cv_pa71` int(11) DEFAULT NULL,
  `news` int(11) DEFAULT NULL,
  `page_news` int(11) DEFAULT NULL,
  `page_list` int(11) DEFAULT NULL,
  `page_xmctb` int(11) DEFAULT NULL,
  `page_imei` int(11) DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receive_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_submit` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ships`
--

INSERT INTO `ships` (`id`, `phone_id`, `user_id`, `number_cv_pa71`, `news`, `page_news`, `page_list`, `page_xmctb`, `page_imei`, `file_name`, `receive_name`, `date_submit`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, NULL, NULL, NULL, 80, NULL, NULL, '', 'Nguyễn Xuân Hưng', '2017-01-10', '2017-01-11 03:19:51', '2017-01-11 03:19:51', NULL),
(2, 6, 1, NULL, NULL, NULL, 6, NULL, NULL, '', 'Nguyễn Xuân Hưng', '2017-01-10', '2017-01-11 03:20:15', '2017-01-12 18:33:33', NULL),
(3, 7, 1, NULL, NULL, NULL, 44, NULL, NULL, '', 'Trương Mạnh Linh', '2017-01-11', '2017-01-11 03:23:45', '2017-01-11 03:23:45', NULL),
(4, 8, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:31:11', '2017-01-11 03:31:11', NULL),
(5, 9, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:31:39', '2017-01-11 03:31:39', NULL),
(6, 10, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:31:59', '2017-01-11 03:31:59', NULL),
(7, 11, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:32:22', '2017-01-11 03:32:22', NULL),
(8, 12, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:32:41', '2017-01-11 03:32:41', NULL),
(9, 13, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:32:54', '2017-01-11 03:32:54', NULL),
(10, 14, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:33:09', '2017-01-11 03:35:57', NULL),
(11, 15, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:33:23', '2017-01-11 03:33:23', NULL),
(12, 16, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:33:38', '2017-01-11 03:33:38', NULL),
(13, 17, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Thành Trung', '2016-12-06', '2017-01-11 03:33:52', '2017-01-11 03:33:52', NULL),
(14, 103, 1, NULL, NULL, NULL, 4, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-15', '2017-01-11 23:23:24', '2017-01-11 23:25:50', NULL),
(15, 108, 1, NULL, NULL, NULL, 4, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-15', '2017-01-11 23:24:07', '2017-01-11 23:26:01', NULL),
(16, 107, 1, NULL, NULL, NULL, 4, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-15', '2017-01-11 23:24:26', '2017-01-11 23:26:10', NULL),
(17, 106, 1, NULL, NULL, NULL, 3, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-15', '2017-01-11 23:25:18', '2017-01-11 23:25:41', NULL),
(18, 92, 1, 625, 1, 3, 0, NULL, NULL, '', '', '2016-12-14', '2017-01-11 23:25:41', '2017-01-11 23:47:38', NULL),
(19, 112, 1, 623, 1, 3, 0, NULL, NULL, '', '', '2016-12-14', '2017-01-11 23:26:35', '2017-01-11 23:47:07', NULL),
(20, 118, 1, NULL, NULL, NULL, 4, NULL, NULL, '', 'Thắng', '2016-12-15', '2017-01-11 23:26:40', '2017-01-11 23:27:30', NULL),
(21, 111, 1, NULL, NULL, NULL, 10, NULL, NULL, '', 'Phùng Quốc Đạt', '2016-12-16', '2017-01-11 23:27:58', '2017-01-11 23:28:20', NULL),
(22, 112, 1, 636, 1, 1, 0, NULL, NULL, '', 'Lam', '2016-12-20', '2017-01-11 23:28:30', '2017-01-11 23:50:01', NULL),
(23, 115, 1, NULL, NULL, NULL, 5, NULL, NULL, '', 'p', '2016-12-16', '2017-01-11 23:29:56', '2017-01-11 23:29:56', NULL),
(24, 110, 1, 635, 1, 8, 0, NULL, NULL, '', 'Lam', '2016-12-20', '2017-01-11 23:30:11', '2017-01-11 23:48:54', NULL),
(25, 84, 1, NULL, NULL, NULL, 6, NULL, NULL, '', 'Hậu', '2016-12-20', '2017-01-11 23:31:55', '2017-01-11 23:31:55', NULL),
(26, 37, 1, 640, 1, 3, 0, NULL, NULL, '', '', '2016-12-21', '2017-01-11 23:32:09', '2017-01-11 23:54:49', NULL),
(27, 113, 1, NULL, NULL, NULL, 1, NULL, NULL, '', 'Phùng Quốc Đạt', '2016-12-19', '2017-01-11 23:32:41', '2017-01-11 23:32:41', NULL),
(28, 86, 1, NULL, NULL, NULL, 1, NULL, NULL, '', 'Hậu', '2016-12-20', '2017-01-11 23:33:28', '2017-01-11 23:33:28', NULL),
(29, 87, 1, NULL, NULL, NULL, 1, NULL, NULL, '', 'Hậu', '2016-12-20', '2017-01-11 23:34:07', '2017-01-11 23:34:07', NULL),
(30, 80, 1, NULL, NULL, NULL, 1, NULL, NULL, '', 'Hậu', '2016-12-20', '2017-01-11 23:34:30', '2017-01-11 23:34:30', NULL),
(31, 67, 1, 645, 1, 1, 0, NULL, NULL, '', 'Hoàng', '2016-12-23', '2017-01-11 23:34:46', '2017-01-11 23:56:58', NULL),
(32, 79, 1, NULL, NULL, NULL, 7, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-22', '2017-01-11 23:35:14', '2017-01-11 23:35:14', NULL),
(33, 76, 1, NULL, NULL, NULL, 1, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-22', '2017-01-11 23:35:35', '2017-01-11 23:35:35', NULL),
(34, 21, 1, 651, 1, 7, 0, NULL, NULL, '', '', '2016-12-29', '2017-01-11 23:35:47', '2017-01-11 23:58:27', NULL),
(35, 78, 1, NULL, NULL, NULL, 3, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-22', '2017-01-11 23:35:58', '2017-01-11 23:35:58', NULL),
(36, 77, 1, NULL, NULL, NULL, 5, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-22', '2017-01-11 23:36:23', '2017-01-11 23:36:23', NULL),
(37, 21, 1, 656, 1, 4, 0, NULL, NULL, '', '', '2016-12-29', '2017-01-11 23:36:33', '2017-01-11 23:58:02', NULL),
(38, 73, 1, NULL, NULL, NULL, 8, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-22', '2017-01-11 23:36:42', '2017-01-11 23:36:42', NULL),
(39, 92, 1, 657, 1, 1, 0, NULL, NULL, '', '', '2016-12-30', '2017-01-11 23:37:27', '2017-01-11 23:59:32', NULL),
(40, 67, 1, 2, 1, 1, 0, NULL, NULL, '', '', '2017-01-05', '2017-01-11 23:38:29', '2017-01-12 17:38:08', NULL),
(41, 65, 1, NULL, NULL, NULL, 5, NULL, NULL, '', 'Phạm Văn Thùy', '2016-12-22', '2017-01-11 23:38:48', '2017-01-11 23:38:48', NULL),
(42, 66, 1, NULL, NULL, NULL, 4, NULL, NULL, '', 'Phạm Văn Thùy', '2016-12-22', '2017-01-11 23:39:18', '2017-01-11 23:39:18', NULL),
(43, 21, 1, 9, 1, 8, 0, NULL, NULL, '', '', '2017-01-10', '2017-01-11 23:39:25', '2017-01-12 17:40:17', NULL),
(44, 71, 1, NULL, NULL, NULL, 1, NULL, NULL, '', 'Phạm Văn Thùy', '2016-12-22', '2017-01-11 23:40:05', '2017-01-11 23:40:05', NULL),
(45, 51, 1, 10, 1, 3, 0, NULL, NULL, '', '', '2017-01-10', '2017-01-11 23:40:19', '2017-01-12 17:39:54', NULL),
(46, 70, 1, NULL, NULL, NULL, 13, NULL, NULL, '', 'Phạm Văn Thùy', '2016-12-22', '2017-01-11 23:40:35', '2017-01-11 23:40:35', NULL),
(47, 69, 1, NULL, NULL, NULL, 9, NULL, NULL, '', 'Phạm Văn Thùy', '2016-12-22', '2017-01-11 23:41:27', '2017-01-11 23:41:27', NULL),
(48, 92, 1, 11, 1, 1, NULL, NULL, NULL, '', 'Hùng', '2017-01-10', '2017-01-11 23:41:29', '2017-01-11 23:41:29', NULL),
(49, 64, 1, NULL, NULL, NULL, 34, NULL, NULL, '', 'Long', '2016-12-26', '2017-01-11 23:42:00', '2017-01-11 23:42:00', NULL),
(50, 97, 1, NULL, NULL, NULL, 2, NULL, NULL, '', 'Lợi', '2016-12-26', '2017-01-11 23:42:25', '2017-01-11 23:42:25', NULL),
(51, 98, 1, NULL, NULL, NULL, 18, NULL, NULL, '', 'Lợi', '2016-12-26', '2017-01-11 23:42:55', '2017-01-11 23:42:55', NULL),
(52, 41, 1, NULL, NULL, NULL, 25, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-11 23:45:30', '2017-01-11 23:45:30', NULL),
(53, 44, 1, NULL, NULL, NULL, 25, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-11 23:45:52', '2017-01-11 23:45:52', NULL),
(54, 43, 1, NULL, NULL, NULL, 25, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-11 23:46:07', '2017-01-11 23:46:07', NULL),
(55, 42, 1, NULL, NULL, NULL, 31, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-11 23:46:25', '2017-01-11 23:46:25', NULL),
(56, 46, 1, NULL, NULL, NULL, 50, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-11 23:46:49', '2017-01-11 23:46:49', NULL),
(57, 49, 1, NULL, NULL, NULL, 50, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-11 23:47:12', '2017-01-11 23:47:12', NULL),
(58, 48, 1, NULL, NULL, NULL, 45, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-11 23:47:33', '2017-01-11 23:47:33', NULL),
(59, 5, 1, NULL, NULL, NULL, 13, NULL, NULL, '', '', '2017-01-10', '2017-01-11 23:49:28', '2017-01-11 23:49:28', NULL),
(60, 47, 1, NULL, NULL, NULL, 2, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-11 23:51:55', '2017-01-12 18:41:48', '2017-01-12 18:41:48'),
(61, 35, 1, NULL, NULL, NULL, 11, NULL, NULL, '', '', '2017-01-10', '2017-01-11 23:53:12', '2017-01-11 23:53:12', NULL),
(62, 36, 1, NULL, NULL, NULL, 11, NULL, NULL, '', '', '2017-01-10', '2017-01-11 23:53:30', '2017-01-11 23:53:30', NULL),
(63, 224, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Trung', '2017-01-05', '2017-01-12 19:31:20', '2017-01-12 19:31:20', NULL),
(64, 218, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Trung', '2017-01-05', '2017-01-12 19:31:53', '2017-01-12 19:31:53', NULL),
(65, 227, 1, NULL, NULL, NULL, 7, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-12 19:49:55', '2017-01-12 19:49:55', NULL),
(66, 229, 1, NULL, NULL, NULL, 68, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-12 19:50:53', '2017-01-12 19:51:43', NULL),
(67, 228, 1, NULL, NULL, NULL, 70, NULL, NULL, '', 'Trung', '2017-01-05', '2017-01-12 19:51:05', '2017-01-12 19:51:51', NULL),
(68, 202, 1, 641, 1, 2, NULL, NULL, NULL, '', 'Thắng', '2016-12-21', '2017-01-12 23:23:47', '2017-01-12 23:23:47', NULL),
(69, 147, 1, 619, 1, 2, NULL, NULL, NULL, '', 'Đăng', '2016-12-13', '2017-01-12 23:27:51', '2017-01-12 23:27:51', NULL),
(70, 238, 1, 615, 1, 2, NULL, NULL, NULL, '', '', '2016-12-09', '2017-01-12 23:28:56', '2017-01-12 23:28:56', NULL),
(71, 234, 1, 610, 1, 1, 0, NULL, NULL, '', '', '2016-12-07', '2017-01-12 23:30:10', '2017-01-12 23:31:19', NULL),
(72, 93, 1, 608, 1, 1, NULL, NULL, NULL, '', 'Thương', '2016-12-07', '2017-01-12 23:32:25', '2017-01-12 23:32:25', NULL),
(73, 137, 1, NULL, NULL, NULL, 3, NULL, NULL, '', 'Kỳ', '2016-12-06', '2017-01-12 23:33:05', '2017-01-12 23:33:05', NULL),
(74, 243, 1, 604, 1, 1, 0, NULL, NULL, '', 'Hoàng', '2016-12-06', '2017-01-12 23:33:27', '2017-01-12 23:53:57', NULL),
(75, 243, 1, 600, 1, 1, 0, NULL, NULL, '', 'Hoàng', '2016-12-02', '2017-01-12 23:34:40', '2017-01-12 23:54:24', NULL),
(76, 180, 1, NULL, NULL, NULL, 1, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-02', '2017-01-12 23:35:27', '2017-01-12 23:35:27', NULL),
(77, 243, 1, 592, 1, 1, 0, NULL, NULL, '', 'Hưng', '2016-11-29', '2017-01-12 23:35:29', '2017-01-12 23:54:54', NULL),
(78, 177, 1, NULL, NULL, NULL, 2, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-02', '2017-01-12 23:36:21', '2017-01-12 23:36:21', NULL),
(79, 178, 1, NULL, NULL, NULL, 2, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-02', '2017-01-12 23:36:57', '2017-01-12 23:36:57', NULL),
(80, 179, 1, NULL, NULL, NULL, 2, NULL, NULL, '', 'Nguyễn Quang Sơn', '2016-12-02', '2017-01-12 23:37:27', '2017-01-12 23:37:27', NULL),
(81, 149, 1, NULL, NULL, NULL, 49, NULL, NULL, '', 'Trung', '2016-12-02', '2017-01-12 23:43:19', '2017-01-12 23:43:19', NULL),
(82, 152, 1, NULL, NULL, NULL, 7, NULL, NULL, '', 'Trung', '2016-12-02', '2017-01-12 23:44:09', '2017-01-12 23:44:09', NULL),
(83, 150, 1, NULL, NULL, NULL, 26, NULL, NULL, '', 'Trung', '2017-01-13', '2017-01-12 23:44:51', '2017-01-12 23:44:51', NULL),
(84, 205, 1, 591, 1, 1, NULL, NULL, NULL, '', 'Hưng', '2016-11-29', '2017-01-12 23:47:27', '2017-01-12 23:47:27', NULL),
(85, 172, 1, NULL, NULL, NULL, 11, NULL, NULL, '', 'Hậu', '2016-11-22', '2017-01-12 23:47:28', '2017-01-12 23:47:28', NULL),
(86, 205, 1, 583, 1, 2, NULL, NULL, NULL, '', '', '2016-11-28', '2017-01-12 23:48:09', '2017-01-12 23:48:09', NULL),
(87, 185, 1, NULL, NULL, NULL, 1, NULL, NULL, '', 'Hậu', '2016-11-18', '2017-01-12 23:48:33', '2017-01-12 23:48:33', NULL),
(88, 165, 1, NULL, NULL, NULL, 10, NULL, NULL, '', 'Trung', '2016-12-02', '2017-01-12 23:50:13', '2017-01-12 23:50:13', NULL),
(89, 124, 1, NULL, NULL, NULL, 3, NULL, NULL, '', 'Ký', '2017-01-13', '2017-01-12 23:51:30', '2017-01-12 23:51:30', NULL),
(90, 240, 1, 571, 1, 1, NULL, NULL, NULL, '', '', '2016-11-23', '2017-01-12 23:52:00', '2017-01-12 23:52:00', NULL),
(91, 125, 1, NULL, NULL, NULL, 6, NULL, NULL, '', 'Kỳ', '2016-12-02', '2017-01-12 23:52:58', '2017-01-12 23:52:58', NULL),
(92, 127, 1, NULL, NULL, NULL, 3, NULL, NULL, '', 'Tài', '2016-12-12', '2017-01-12 23:53:49', '2017-01-12 23:53:49', NULL),
(93, 128, 1, NULL, NULL, NULL, 3, NULL, NULL, '', 'Tài', '2016-12-12', '2017-01-12 23:54:27', '2017-01-12 23:54:27', NULL),
(94, 120, 1, NULL, NULL, NULL, 8, NULL, NULL, '', 'Kỳ', '2016-12-06', '2017-01-12 23:55:16', '2017-01-12 23:55:16', NULL),
(95, 244, 1, 570, 1, 1, NULL, NULL, NULL, '', 'Hưng', '2016-11-21', '2017-01-12 23:56:21', '2017-01-12 23:56:21', NULL),
(96, 129, 1, NULL, NULL, NULL, 18, NULL, NULL, '', 'Tài', '2016-12-12', '2017-01-12 23:56:23', '2017-01-12 23:56:23', NULL),
(97, 205, 1, 569, 1, 4, NULL, NULL, NULL, '', 'Hưng', '2016-11-21', '2017-01-12 23:57:00', '2017-01-12 23:57:00', NULL),
(98, 201, 1, 561, 1, 2, NULL, NULL, NULL, '', '', '2016-11-17', '2017-01-12 23:58:12', '2017-01-12 23:58:12', NULL),
(99, 183, 1, 579, 1, 2, NULL, NULL, NULL, '', 'Đạt', '2016-11-25', '2017-01-13 00:01:58', '2017-01-13 00:01:58', NULL),
(100, 157, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Nguyễn Quang Sơn', '2016-12-22', '2017-01-13 00:04:36', '2017-01-13 00:04:36', NULL),
(101, 156, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Trung', '2016-12-02', '2017-01-13 00:05:52', '2017-01-13 00:05:52', NULL),
(102, 158, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Trung', '2016-12-02', '2017-01-13 00:05:52', '2017-01-13 00:05:52', NULL),
(103, 159, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Trung', '2016-12-02', '2017-01-13 00:05:52', '2017-01-13 00:05:52', NULL),
(104, 160, 1, NULL, NULL, NULL, NULL, 1, NULL, '', 'Trung', '2016-12-02', '2017-01-13 00:05:52', '2017-01-13 00:05:52', NULL),
(105, 29, 1, 14, 1, 1, NULL, NULL, NULL, '', '', '2017-01-12', '2017-01-13 00:07:56', '2017-01-13 00:07:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ships_news`
--

CREATE TABLE `ships_news` (
  `id` int(10) UNSIGNED NOT NULL,
  `ship_id` int(10) UNSIGNED NOT NULL,
  `number_cv` int(11) NOT NULL,
  `number_news` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `block` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `symbol`, `description`, `block`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PA88', 'An ninh chính trị tư tưởng', 'AN', '2017-01-11 09:38:06', '2017-01-11 09:38:06', NULL),
(2, 'PA92', 'An ninh điều tra', 'AN', '2017-01-11 09:38:06', '2017-01-11 19:03:29', NULL),
(3, 'PC47', 'Phòng chống ma túy', 'CS', '2017-01-11 09:38:06', '2017-01-11 19:14:03', NULL),
(4, 'PC52', 'Phòng truy nã', 'CS', '2017-01-11 02:51:20', '2017-01-11 02:51:20', NULL),
(5, 'CALT', 'Công an Lệ Thủy đội cảnh sát', 'CS', '2017-01-11 03:02:48', '2017-01-11 03:02:48', NULL),
(6, 'CAQT', 'Công an Quảng Trạch đội cảnh sát', 'CS', '2017-01-11 03:27:40', '2017-01-11 03:27:40', NULL),
(7, 'PA83', 'An ninh văn hóa tư tưởng', 'AN', '2017-01-11 18:56:47', '2017-01-11 18:56:47', NULL),
(8, 'PA61', 'Bảo vệ chính trị 1', 'AN', '2017-01-11 18:59:17', '2017-01-11 18:59:17', NULL),
(9, 'PA81', 'An ninh kinh tế', 'AN', '2017-01-11 19:00:23', '2017-01-11 19:00:23', NULL),
(10, 'CABT', 'Công an Bố Trạch đội cảnh sát', 'CS', '2017-01-11 19:02:31', '2017-01-11 19:02:31', NULL),
(11, 'CATH', 'Công an Tuyên Hóa đội cảnh sát', 'CS', '2017-01-11 19:06:03', '2017-01-11 19:06:03', NULL),
(12, 'CAĐH', 'Công an TP Đồng Hới đội cảnh sát', 'CS', '2017-01-11 19:07:16', '2017-01-11 19:13:11', NULL),
(13, 'CAQN', 'Công an Quảng Ninh đội cảnh sát', 'CS', '2017-01-11 19:08:23', '2017-01-11 19:12:49', NULL),
(14, 'CATXBĐ', 'Công an Thị xã Ba Đồn đội cảnh sát', 'CS', '2017-01-11 19:10:46', '2017-01-11 19:36:33', NULL),
(15, 'CAMH', 'Công an Minh Hóa đội cảnh sát', 'CS', '2017-01-11 19:11:30', '2017-01-11 19:11:57', NULL),
(16, 'PC45', 'Phòng về Trật tự xã hội', 'CS', '2017-01-11 19:15:03', '2017-01-11 19:16:17', NULL),
(17, 'PC46', 'Phòng quản lý kinh tế và chức vụ', 'CS', '2017-01-11 19:17:25', '2017-01-11 19:17:25', NULL),
(18, 'PC44', 'Văn phòng cơ quan cảnh sát điều tra', 'CS', '2017-01-11 19:18:06', '2017-01-11 19:18:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$xZUEQvhn40tLsxMC24hV4eAP64O1402PlcaIKATjCq37qhf.Xv.uy', 'admin', 'fhRBwKwYFCfDkkANHtdO3iSH6rbBn9M2OEWQG4hQQQM2jrSyAB8xKHTnt3eq', '2017-01-11 09:38:06', '2017-01-11 18:44:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_ship_id_foreign` (`ship_id`);

--
-- Indexes for table `kinds`
--
ALTER TABLE `kinds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lists_phone_id_foreign` (`phone_id`),
  ADD KEY `lists_user_id_foreign` (`user_id`);

--
-- Indexes for table `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `network_ship`
--
ALTER TABLE `network_ship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `network_ship_ship_id_foreign` (`ship_id`),
  ADD KEY `network_ship_network_id_foreign` (`network_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_phone_id_foreign` (`phone_id`),
  ADD KEY `news_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_kind_id_foreign` (`kind_id`),
  ADD KEY `orders_category_id_foreign` (`category_id`),
  ADD KEY `orders_unit_id_foreign` (`unit_id`),
  ADD KEY `orders_purpose_id_foreign` (`purpose_id`);

--
-- Indexes for table `order_purpose`
--
ALTER TABLE `order_purpose`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_purpose_order_id_foreign` (`order_id`),
  ADD KEY `order_purpose_purpose_id_foreign` (`purpose_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phones_order_id_foreign` (`order_id`);

--
-- Indexes for table `purposes`
--
ALTER TABLE `purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ships_phone_id_foreign` (`phone_id`),
  ADD KEY `ships_user_id_foreign` (`user_id`);

--
-- Indexes for table `ships_news`
--
ALTER TABLE `ships_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ships_news_ship_id_foreign` (`ship_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kinds`
--
ALTER TABLE `kinds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `network_ship`
--
ALTER TABLE `network_ship`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `order_purpose`
--
ALTER TABLE `order_purpose`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `purposes`
--
ALTER TABLE `purposes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `ships_news`
--
ALTER TABLE `ships_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ship_id_foreign` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`);

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`),
  ADD CONSTRAINT `lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `network_ship`
--
ALTER TABLE `network_ship`
  ADD CONSTRAINT `network_ship_network_id_foreign` FOREIGN KEY (`network_id`) REFERENCES `networks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `network_ship_ship_id_foreign` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`),
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `orders_kind_id_foreign` FOREIGN KEY (`kind_id`) REFERENCES `kinds` (`id`),
  ADD CONSTRAINT `orders_purpose_id_foreign` FOREIGN KEY (`purpose_id`) REFERENCES `purposes` (`id`),
  ADD CONSTRAINT `orders_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_purpose`
--
ALTER TABLE `order_purpose`
  ADD CONSTRAINT `order_purpose_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_purpose_purpose_id_foreign` FOREIGN KEY (`purpose_id`) REFERENCES `purposes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phones_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `ships`
--
ALTER TABLE `ships`
  ADD CONSTRAINT `ships_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`),
  ADD CONSTRAINT `ships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ships_news`
--
ALTER TABLE `ships_news`
  ADD CONSTRAINT `ships_news_ship_id_foreign` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
