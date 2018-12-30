-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2018 at 03:59 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `digikala`
--

CREATE TABLE `digikala` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `position` smallint(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `digikala`
--

INSERT INTO `digikala` (`id`, `title`, `position`) VALUES
(1, 'laptopfff', 1),
(2, 'gooshiiii', 10),
(3, 'tv', 3),
(4, 'tablet', 0),
(5, 'webcam', 0),
(11, 'aaa', 3),
(13, 'laptop', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ilya_blobs`
--

CREATE TABLE `ilya_blobs` (
  `id` bigint(14) UNSIGNED NOT NULL,
  `format` varchar(20) NOT NULL,
  `content` mediumblob,
  `name` varchar(255) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `cookie_id` bigint(20) UNSIGNED DEFAULT NULL,
  `create_ip` varbinary(16) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` enum('tmp','active') NOT NULL DEFAULT 'tmp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_blobs`
--

INSERT INTO `ilya_blobs` (`id`, `format`, `content`, `name`, `size`, `user_id`, `cookie_id`, `create_ip`, `created`, `status`) VALUES
(2278810236986476394, 'jpg', NULL, 'RIO-TINTO-4854s54.jpg', '394515', NULL, NULL, NULL, '2018-12-05 15:59:58', 'active'),
(5125437445030048428, 'jpg', NULL, 'RIO-TINTO-4854s54 - Copy.jpg', '394515', NULL, NULL, NULL, '2018-12-05 16:12:42', 'tmp'),
(5714100541416972596, 'jpg', NULL, 'RIO-TINTO-4854s54.jpg', '394515', NULL, NULL, NULL, '2018-12-05 16:10:09', 'tmp'),
(10584653261092988244, 'jpg', NULL, 'RIO-TINTO-4854s54 - Copy.jpg', '394515', NULL, NULL, NULL, '2018-12-05 16:10:08', 'tmp'),
(11877012988740629422, 'jpg', NULL, 'RIO-TINTO-4854s54 - Copy (2).jpg', '394515', NULL, NULL, NULL, '2018-12-05 16:12:41', 'tmp'),
(13762383199592721106, 'jpg', NULL, 'RIO-TINTO-4854s54 - Copy (2).jpg', '394515', NULL, NULL, NULL, '2018-12-05 16:10:06', 'tmp'),
(17339264436629024011, 'jpg', NULL, 'RIO-TINTO-4854s54.jpg', '394515', NULL, NULL, NULL, '2018-12-05 16:12:42', 'tmp');

-- --------------------------------------------------------

--
-- Table structure for table `ilya_products`
--

CREATE TABLE `ilya_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `products_category_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ilya_products_category`
--

CREATE TABLE `ilya_products_category` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(45) CHARACTER SET utf8 NOT NULL,
  `content` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `parent_id` smallint(5) UNSIGNED DEFAULT NULL,
  `digikala` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `digikala_id` int(10) UNSIGNED DEFAULT NULL,
  `image` bigint(14) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ilya_products_category`
--

INSERT INTO `ilya_products_category` (`id`, `title`, `content`, `parent_id`, `digikala`, `digikala_id`, `image`) VALUES
(1, 'کالای دیجیتال', 'کالای ایرانی', NULL, NULL, NULL, NULL),
(4, 'تلفن همراه', '', 1, 'gooshiiii', 2, NULL),
(5, 'گوشی سامسونگ', '', 4, 'gooshiiii', 2, NULL),
(6, 'لپ تاپ', '', 1, 'laptopfff', 1, NULL),
(13, 'پوشاک', NULL, NULL, NULL, NULL, NULL),
(15, 'ایسوس', NULL, 6, 'laptopfff', 1, NULL),
(16, 'تست ایسوس', NULL, 15, 'laptopfff', 1, NULL),
(17, 'مردانه', NULL, 13, NULL, NULL, NULL),
(18, 'زنانه', NULL, 13, NULL, NULL, NULL),
(34, 'd', '<p>rrrrr</p>\r\n', 1, NULL, NULL, NULL),
(35, 'd', '<p>rrrrr</p>\r\n', 1, NULL, 4, NULL),
(36, 'fsfsfsfsf', '', 1, NULL, 5, 2278810236986476394),
(37, 'ddddddd', '', 1, NULL, 5, NULL),
(38, 'ddddddd', '', 1, NULL, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ilya_products_category_map`
--

CREATE TABLE `ilya_products_category_map` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` smallint(5) UNSIGNED NOT NULL,
  `products_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ilya_widgets`
--

CREATE TABLE `ilya_widgets` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `place` char(2) NOT NULL,
  `position` smallint(5) UNSIGNED NOT NULL,
  `tags` varchar(800) NOT NULL,
  `namespace` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_widgets`
--

INSERT INTO `ilya_widgets` (`id`, `place`, `position`, `tags`, `namespace`) VALUES
(1, 'ST', 1, 'all', 'Modules\\Showcase\\Products\\Widgets\\Calender'),
(2, 'FB', 2, 'all', 'Modules\\Showcase\\Products\\Widgets\\Bottom'),
(3, 'NT', 3, 'all', 'Modules\\Showcase\\Products\\Widgets\\Calender'),
(4, 'FT', 4, 'all', 'Modules\\Showcase\\Products\\Widgets\\Newcategory');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `digikala`
--
ALTER TABLE `digikala`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `ilya_blobs`
--
ALTER TABLE `ilya_blobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ilya_products`
--
ALTER TABLE `ilya_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id` (`products_category_id`);

--
-- Indexes for table `ilya_products_category`
--
ALTER TABLE `ilya_products_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `digikala` (`digikala`),
  ADD KEY `digikala_id` (`digikala_id`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `ilya_products_category_map`
--
ALTER TABLE `ilya_products_category_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `products_id` (`products_id`);

--
-- Indexes for table `ilya_widgets`
--
ALTER TABLE `ilya_widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `digikala`
--
ALTER TABLE `digikala`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ilya_products`
--
ALTER TABLE `ilya_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ilya_products_category`
--
ALTER TABLE `ilya_products_category`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `ilya_products_category_map`
--
ALTER TABLE `ilya_products_category_map`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ilya_widgets`
--
ALTER TABLE `ilya_widgets`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ilya_products`
--
ALTER TABLE `ilya_products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`products_category_id`) REFERENCES `ilya_products_category` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ilya_products_category`
--
ALTER TABLE `ilya_products_category`
  ADD CONSTRAINT `fk1_products_category` FOREIGN KEY (`parent_id`) REFERENCES `ilya_products_category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_products_category` FOREIGN KEY (`digikala`) REFERENCES `digikala` (`title`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk4_products_category` FOREIGN KEY (`digikala_id`) REFERENCES `digikala` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk5_products_category` FOREIGN KEY (`image`) REFERENCES `ilya_blobs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `ilya_products_category_map`
--
ALTER TABLE `ilya_products_category_map`
  ADD CONSTRAINT `fk_products_category_map_category` FOREIGN KEY (`category_id`) REFERENCES `ilya_products_category` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_products_category_map_products` FOREIGN KEY (`products_id`) REFERENCES `ilya_products` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
