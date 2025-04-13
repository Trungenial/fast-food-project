-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2025 at 04:25 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fastfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', '$2y$12$oeUXPZfXtLLFHDuoQcJHE.iVYQKVGmj0r7s4ycMMKUQZZyGBD.aSa', NULL, '2025-04-13 09:04:52', '2025-04-13 09:04:52'),
(2, 'Admin Test', 'test@admin.com', '$2y$12$5LE6kpkrn7QZxyA/Z9pgiuqQR93Ft07MRowgAM4hEpFvrkuR1Lj1q', NULL, '2025-04-13 09:04:52', '2025-04-13 09:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'Món ngon phải thử', NULL),
(2, 'Gà giòn vui vẻ', NULL),
(3, 'Mì Ý Jolly', NULL),
(4, 'Gà sốt cay', NULL),
(5, 'Burger/Cơm', NULL),
(6, 'Phần ăn phụ', NULL),
(7, 'Món tráng miệng', NULL),
(8, 'Thức uống', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('pvtuan280803@gmail.com', '$2y$12$EUkyASKBZBWEm0P3FPTYgO43vRLApqATQkCoB3MXca9NU/zHMB29i', '2025-04-13 05:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `method` enum('cash','credit_card','e_wallet') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','paid','failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'Cùng Bee Mix & Match 3', 'Combo hoàn hảo với nhiều lựa chọn hấp dẫn, kết hợp hương vị độc đáo.', 79000.00, 'cung-bee-mix-match-3.png', 1, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(3, 'Cùng Bee Mix & Match 1', 'Tự do lựa chọn món ăn yêu thích, kết hợp theo sở thích riêng của bạn.', 79000.00, 'cung-bee-mix-match-1.png', 1, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(4, 'Combo Một Mình Ăn Ngon', 'Suất ăn dành cho một người với đầy đủ hương vị thơm ngon.', 78000.00, 'combo-mot-minh-an-ngon.png', 1, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(5, 'Cặp đôi ăn ý', 'Combo lý tưởng cho hai người với sự kết hợp tuyệt vời của nhiều món ăn.', 145000.00, 'cap-doi-an-y.png', 1, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(6, 'Combo Cả Nhà No Nê', 'Bữa ăn trọn vẹn cho cả gia đình, đảm bảo ai cũng có phần.', 185000.00, 'combo-ca-nha-no-ne.png', 1, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(7, 'Combo Bạn Bè Tụ Tập', 'Bữa ăn lý tưởng để chia sẻ cùng bạn bè, đầy đủ món ngon và đồ uống.', 322000.00, 'combo-ban-be-tu-tap.png', 1, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(8, '4 miếng Gà Giòn Vui Vẻ', 'Bốn miếng gà giòn rụm, thơm ngon với lớp vỏ vàng óng hấp dẫn.', 199000.00, 'ga_gion_4_mieng.png', 2, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(9, '6 miếng Gà Giòn Vui Vẻ', 'Sáu miếng gà giòn, hoàn hảo cho bữa ăn gia đình hoặc chia sẻ cùng bạn bè.', 299000.00, 'ga_gion_6_mieng.png', 2, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(10, '2 miếng Gà Giòn Vui Vẻ', 'Hai miếng gà giòn rụm, thích hợp cho bữa ăn nhẹ hoặc kết hợp với món khác.', 99000.00, 'ga_gion_2_mieng.png', 2, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(11, '1 miếng Gà Giòn Vui Vẻ', 'Một miếng gà giòn ngon, lớp vỏ giòn tan và thịt mềm bên trong.', 55000.00, 'ga_gion_1_mieng.png', 2, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(12, '2 Gà Giòn Vui Vẻ + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Bữa ăn đầy đủ với hai miếng gà giòn, khoai tây chiên giòn rụm và nước ngọt mát lạnh.', 95000.00, 'ga_2_khoai_1_nuoc_1.png', 2, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(13, '1 Gà Giòn Vui Vẻ + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Thưởng thức một miếng gà giòn cùng khoai tây chiên và nước ngọt tươi mát.', 75000.00, 'ga_1_khoai_1_nuoc_1.png', 2, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(14, '1 Cơm Gà Giòn Vui Vẻ + 1 Súp bí đỏ + 1 Nước ngọt', 'Bữa ăn ngon miệng với cơm nóng hổi, gà giòn rụm, súp bí đỏ bổ dưỡng và nước ngọt.', 85000.00, 'com-ga-gion-vui-ve-sup-bi-do-nuoc-ngot.png', 2, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(15, '1 Cơm Gà Giòn Vui Vẻ + 1 Nước ngọt', 'Cơm gà giòn thơm ngon kết hợp với nước ngọt giúp bữa ăn thêm tròn vị.', 65000.00, 'com-ga-gion-vui-ve-nuoc-ngot.png', 2, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(16, '1 Mì Ý Jolly vừa + 1 Gà Giòn Vui Vẻ + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Thưởng thức mì Ý Jolly sốt đậm đà, kết hợp cùng gà giòn vui vẻ, khoai tây chiên vàng ươm và nước ngọt mát lạnh.', 85000.00, 'mi-y-jolly-vua-ga-gion-vui-ve-khoai-tay-chien-vua-nuoc-ngot.jpg', 3, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(17, '1 Mì Ý Jolly vừa + 2 Gà không xương + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Bữa ăn hoàn hảo với mì Ý Jolly thơm ngon, 2 miếng gà không xương giòn rụm, khoai tây chiên và nước ngọt.', 90000.00, 'mi-y-jolly-vua-2-ga-khong-xuong-khoai-tay-chien-vua-nuoc-ngot.jpg', 3, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(18, '1 Mì Ý Jolly vừa + 2 Gà không xương + 1 Nước ngọt', 'Món ăn kết hợp giữa mì Ý sốt béo ngậy, 2 miếng gà không xương giòn tan và nước ngọt mát lạnh.', 75000.00, 'mi-y-jolly-vua-2-ga-khong-xuong-nuoc-ngot.png', 3, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(19, '1 Mì Ý Jolly vừa + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Mì Ý Jolly sốt hấp dẫn, kèm khoai tây chiên giòn rụm và nước ngọt sảng khoái.', 70000.00, 'mi-y-jolly-vua-khoai-tay-chien-vua-nuoc-ngot.jpg', 3, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(20, '1 Mì Ý Jolly vừa + 1 Nước ngọt', 'Món mì Ý Jolly trứ danh với nước sốt đặc biệt, ăn kèm nước ngọt tươi mát.', 55000.00, 'mi-y-jolly-vua-nuoc-ngot.jpg', 3, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(21, 'Mì Ý Jolly lớn', 'Phiên bản mì Ý Jolly cỡ lớn dành cho những ai muốn thưởng thức trọn vẹn hương vị tuyệt hảo.', 60000.00, 'mi-y-jolly-lon.jpg', 3, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(22, 'Mì Ý Jolly vừa', 'Mì Ý Jolly với nước sốt đặc trưng, thơm ngon và hấp dẫn.', 45000.00, 'mi-y-jolly-vua.jpg', 3, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(23, '2 miếng Gà Sốt Cay', 'Hai miếng gà chiên giòn phủ lớp sốt cay đậm đà, kích thích vị giác.', 60000.00, '2-mieng-ga-sot-cay.jpg', 4, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(24, '2 Gà Sốt Cay + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Combo hấp dẫn với 2 miếng gà sốt cay, khoai tây chiên giòn rụm và nước ngọt mát lạnh.', 85000.00, '2-ga-sot-cay-khoai-tay-chien-vua-nuoc-ngot.jpg', 4, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(25, '1 Gà Sốt Cay + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Một miếng gà sốt cay thơm ngon kèm khoai tây chiên giòn tan và nước ngọt.', 65000.00, '1-ga-sot-cay-khoai-tay-chien-vua-nuoc-ngot.jpg', 4, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(26, '1 Cơm Gà Sốt Cay + 1 Súp bí đỏ + 1 Nước ngọt', 'Bữa ăn đầy đủ với cơm gà sốt cay, súp bí đỏ bổ dưỡng và nước ngọt giải khát.', 75000.00, 'com-ga-sot-cay-sup-bi-do-nuoc-ngot.jpg', 2, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(27, '1 Cơm Gà Sốt Cay + 1 Nước ngọt', 'Cơm gà sốt cay thơm ngon đi kèm nước ngọt giúp bữa ăn tròn vị.', 55000.00, 'com-ga-sot-cay-nuoc-ngot.jpg', 4, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(28, '1 Cơm Gà Sốt Cay', 'Cơm nóng hổi ăn kèm với gà sốt cay đậm vị, cực kỳ hấp dẫn.', 45000.00, 'com-ga-sot-cay.jpg', 4, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(29, '1 miếng Gà Sốt Cay', 'Một miếng gà chiên giòn phủ lớp sốt cay đặc biệt, thơm ngon đến miếng cuối cùng.', 35000.00, '1-mieng-ga-sot-cay.jpg', 4, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(30, '1 Burger Tôm + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Bữa ăn đầy đủ với Burger Tôm giòn rụm, khoai tây chiên thơm ngon và nước ngọt mát lạnh.', 65000.00, 'burger-tom-khoai-tay-chien-vua-nuoc-ngot.png', 5, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(31, '1 Burger Tôm + 1 Nước ngọt', 'Burger Tôm giòn với lớp nhân đậm đà kết hợp cùng nước ngọt sảng khoái.', 50000.00, 'burger-tom-nuoc-ngot.png', 5, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(32, '1 Jolly Hotdog + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Hotdog với xúc xích thơm ngon, khoai tây chiên giòn tan và nước ngọt mát lạnh.', 50000.00, 'jolly-hotdog-khoai-tay-chien-vua-nuoc-ngot.png', 5, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(33, '1 Jolly Hotdog + 1 Nước ngọt', 'Xúc xích nóng hổi kết hợp cùng nước ngọt giải khát.', 35000.00, 'jolly-hotdog-nuoc-ngot.png', 5, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(34, '1 Sandwich Gà Giòn + 1 Khoai tây chiên vừa + 1 Nước ngọt', 'Sandwich gà giòn ngon miệng, ăn kèm khoai tây chiên và nước ngọt.', 55000.00, 'sandwich-ga-gion-khoai-tay-chien-vua-nuoc-ngot.png', 5, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(35, '1 Sandwich Gà Giòn + 1 Nước ngọt', 'Sandwich với lớp gà giòn rụm kết hợp với nước ngọt tươi mát.', 40000.00, 'sandwich-ga-gion-nuoc-ngot.png', 5, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(36, 'Burger Tôm', 'Burger với nhân tôm giòn rụm, rau tươi và sốt đặc biệt.', 40000.00, 'burger-tom.png', 5, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(37, 'Sandwich Gà Giòn', 'Bánh sandwich với lớp gà giòn, sốt hấp dẫn và rau xanh tươi mát.', 30000.00, 'sandwich-ga-gion.png', 5, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(38, 'Jolly Hotdog', 'Hotdog với xúc xích thơm ngon, sốt đặc biệt và bánh mềm mại.', 25000.00, 'jolly-hotdog.png', 5, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(39, 'Khoai tây lắc vị BBQ lớn', 'Khoai tây giòn rụm phủ lớp gia vị BBQ đậm đà, thích hợp để nhâm nhi.', 35000.00, 'khoai-tay-lac-bbq-lon.jpg', 6, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(40, 'Khoai tây lắc vị BBQ vừa', 'Khoai tây lắc giòn tan với vị BBQ hấp dẫn, phù hợp cho một phần ăn nhẹ.', 25000.00, 'khoai-tay-lac-bbq-vua.jpg', 6, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(41, 'Khoai tây chiên lớn', 'Khoai tây chiên giòn rụm, vàng ươm, hoàn hảo để ăn kèm với món chính.', 25000.00, 'khoai-tay-chien-lon.jpg', 6, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(42, 'Khoai tây chiên vừa', 'Khoai tây chiên giòn ngon, kích thước vừa đủ cho một bữa ăn nhẹ.', 20000.00, 'khoai-tay-chien-vua.jpg', 6, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(43, 'Súp bí đỏ', 'Súp bí đỏ béo ngậy, thơm ngon, mang đến hương vị đặc trưng của bí đỏ.', 15000.00, 'sup-bi-do.png', 6, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(44, 'Cơm Trắng', 'Cơm trắng mềm dẻo, có thể ăn kèm với các món chính để tạo bữa ăn đầy đủ dinh dưỡng.', 10000.00, 'com-trang.png', 6, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(45, 'Bánh xoài đào', 'Bánh mềm thơm với hương vị xoài và đào tự nhiên, phù hợp làm món tráng miệng tuyệt vời.', 10000.00, 'banh-xoai-dao.png', 7, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(46, 'Tropical Sundae', 'Kem Sundae nhiệt đới với hương vị trái cây tươi mát, mang đến cảm giác sảng khoái.', 20000.00, 'tropical-sundae.png', 7, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(47, 'Kem Sundae Dâu', 'Kem Sundae mịn màng kết hợp với sốt dâu chua ngọt, tạo nên sự hòa quyện hoàn hảo.', 15000.00, 'kem-sundae-dau.png', 7, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(48, 'Kem Sundae Socola', 'Kem Sundae socola thơm ngon, béo ngậy với sốt socola đậm đà.', 15000.00, 'kem-sundae-socola.png', 7, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(49, 'Kem Sôcôla (Cúp)', 'Kem socola trong cúp nhỏ, phù hợp để thưởng thức một cách tiện lợi.', 7000.00, 'kem-socola-cup.png', 7, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(50, 'Kem Sữa Tươi (Cúp)', 'Kem sữa tươi mềm mịn, mang đến hương vị béo ngậy và tươi ngon.', 5000.00, 'kem-sua-tuoi-cup.png', 7, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(51, 'Trà Chanh Hạt Chia', 'Thức uống thanh mát với hạt chia', 20000.00, 'tra-chanh-hat-chia.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(52, 'Nước ép Xoài Đào', 'Nước ép trái cây tươi mát', 20000.00, 'nuoc-ep-xoai-dao.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(53, 'Pepsi lớn', 'Nước giải khát có ga Pepsi size lớn', 17000.00, 'pepsi-lon.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(54, 'Pepsi vừa', 'Nước giải khát có ga Pepsi size vừa', 12000.00, 'pepsi-vua.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(55, 'Mirinda lớn', 'Nước giải khát có ga Mirinda vị cam size lớn', 17000.00, 'mirinda-lon.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(56, 'Mirinda vừa', 'Nước giải khát có ga Mirinda vị cam size vừa', 12000.00, 'mirinda-vua.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(57, '7Up lớn', 'Nước giải khát có ga 7Up size lớn', 17000.00, '7up-lon.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(58, '7Up vừa', 'Nước giải khát có ga 7Up size vừa', 12000.00, '7up-vua.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(59, 'Cacao sữa đá lớn', 'Cacao kết hợp với sữa đá thơm ngon', 25000.00, 'cacao-sua-da-lon.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(60, 'Cacao sữa đá vừa', 'Cacao kết hợp với sữa đá thơm ngon size vừa', 20000.00, 'cacao-sua-da-vua.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37'),
(61, 'Nước suối', 'Nước suối tinh khiết', 8000.00, 'nuoc-suoi.png', 8, '2025-03-17 07:32:37', '2025-03-17 07:32:37');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `type` enum('percentage','fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `address`, `phone`, `latitude`, `longitude`) VALUES
(1, 'Jollibee Tô Hiến Thành', 'Tô Hiến Thành, Quận 10, TP.HCM', '+84-42-949-7588', 10.7789198, 106.6670743),
(2, 'Jollibee Vạn Hạnh Mall', 'Vạn Hạnh Mall, Quận 10, TP.HCM', '+84-85-592-2175', 10.7705874, 106.6698553),
(3, 'Jollibee Âu Cơ', 'Âu Cơ, Quận Tân Bình, TP.HCM', '+84-44-438-2561', 10.7852401, 106.6421002),
(4, 'Jollibee Pasteur', 'Pasteur, Quận 3, TP.HCM', '+84-62-122-8957', 10.7815818, 106.6948245);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `role` enum('customer','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pham Van Tuan', 'pvtuan280803@gmail.com', '$2y$12$0x2X/SNS54WqLrgV9lfxcO3lFzhOTgdVqJbEpmDGVgiG3OMp/dYqe', NULL, NULL, 'customer', NULL, NULL, '2025-04-13 01:57:16', '2025-04-13 01:57:16'),
(2, 'Phạm Văn Tuấn', '030238220290@st.buh.edu.vn', '$2y$12$PU3PlcinLJ1Pb1PGm44CC.mChQqQDV7ruthuBcaO5ElHrMND8ZEzS', NULL, NULL, 'customer', NULL, NULL, '2025-04-13 05:21:38', '2025-04-13 05:21:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
