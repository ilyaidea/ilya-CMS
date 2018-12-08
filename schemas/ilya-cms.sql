-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2018 at 02:07 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+03:30";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `ilya_blobs`
--

CREATE TABLE `ilya_blobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `ilya_lang`
--

CREATE TABLE `ilya_lang` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(45) NOT NULL,
  `value` varchar(10) NOT NULL,
  `is_primary` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_lang`
--

INSERT INTO `ilya_lang` (`id`, `title`, `value`, `is_primary`) VALUES
  (1, 'فارسی', 'fa', 1),
  (2, 'English', 'en', 0),
  (3, 'Español', 'es', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ilya_language`
--

CREATE TABLE `ilya_language` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `iso` varchar(10) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `position` smallint(5) DEFAULT NULL,
  `is_primary` enum('0','1') NOT NULL DEFAULT '0',
  `direction` enum('rtl','ltr') NOT NULL DEFAULT 'ltr'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_language`
--

INSERT INTO `ilya_language` (`id`, `iso`, `title`, `position`, `is_primary`, `direction`) VALUES
  (1, 'en', 'English', 2, '0', 'ltr'),
  (2, 'fa', 'فارسی', 4, '1', 'rtl'),
  (3, 'ar', 'عربی', 1, '0', 'rtl');

-- --------------------------------------------------------

--
-- Table structure for table `ilya_pages`
--

CREATE TABLE `ilya_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `language` varchar(10) DEFAULT NULL,
  `position` smallint(5) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_in` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_pages`
--

INSERT INTO `ilya_pages` (`id`, `parent_id`, `title`, `language`, `position`, `created_at`, `modified_in`) VALUES
  (1, NULL, 'کالای دیجیتال', 'fa', 4, '2018-11-03 16:49:13', NULL),
  (2, NULL, 'آرایشی و بهداشتی', 'fa', 2, '2018-11-03 16:49:13', NULL),
  (3, NULL, 'وسایل نقلیه', 'en', 1, '2018-11-03 16:49:13', NULL),
  (4, NULL, 'مد و پوشاک', 'fa', 3, '2018-11-03 16:49:13', NULL),
  (5, NULL, 'خانه و آشپزخانه', 'fa', 1, '2018-11-03 16:49:13', NULL),
  (6, 1, 'لوازم جانبی گوشی', 'fa', 2, '2018-11-03 16:49:13', NULL),
  (7, 1, 'گوشی موبایل', 'fa', 1, '2018-11-03 16:49:13', NULL),
  (8, 2, 'لوازم بهداشتی', 'fa', 1, '2018-11-03 16:49:13', NULL),
  (9, 2, 'لوازم آرایشی', 'fa', 2, '2018-11-03 16:49:13', NULL),
  (10, 3, 'لوازم جانبی خودرو', 'en', 3, '2018-11-03 16:49:13', NULL),
  (11, 3, 'ابزار برقی', 'en', 4, '2018-11-03 16:49:13', NULL),
  (12, 4, 'ساعت', 'fa', 2, '2018-11-03 16:49:13', NULL),
  (13, 4, 'زنانه', 'fa', 3, '2018-11-03 16:49:13', NULL),
  (14, 5, 'سرو و پذیرایی', 'fa', 7, '2018-11-03 16:49:13', NULL),
  (15, 5, 'صوتی و تصویری', 'fa', 8, '2018-11-03 16:49:13', NULL),
  (16, 6, 'کیف و کاور گوشی', 'fa', 1, '2018-11-03 16:49:13', NULL),
  (17, 6, 'پایه نگهدارنده گوشی', 'fa', 6, '2018-11-03 16:49:13', NULL),
  (18, 10, 'لوازم تزیینی', 'en', 3, '2018-11-03 16:49:13', NULL),
  (19, 11, 'اره برقی', 'en', 2, '2018-11-03 16:49:13', NULL),
  (20, 15, 'TV', 'fa', 1, '2018-11-03 16:49:13', '2018-11-03 16:49:13'),
  (43, NULL, 'PAGE 1', 'ar', 1, '2018-11-03 17:17:42', NULL),
  (44, NULL, 'PAGE 2', 'ar', 2, '2018-11-03 17:17:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ilya_roles`
--

CREATE TABLE `ilya_roles` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ilya_translate`
--

CREATE TABLE `ilya_translate` (
  `id` int(10) UNSIGNED NOT NULL,
  `language` varchar(10) NOT NULL,
  `phrase` varchar(500) DEFAULT NULL,
  `translation` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_translate`
--

INSERT INTO `ilya_translate` (`id`, `language`, `phrase`, `translation`) VALUES
  (27, 'fa', 'add', NULL),
  (28, 'ar', 'add', 'اضافة'),
  (29, 'en', 'add', 'Add');

-- --------------------------------------------------------

--
-- Table structure for table `ilya_users`
--

CREATE TABLE `ilya_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime DEFAULT NULL,
  `create_ip` varbinary(16) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `username` varchar(20) NOT NULL,
  `avatar_id` bigint(20) UNSIGNED DEFAULT NULL,
  `avata_width` smallint(5) UNSIGNED DEFAULT NULL,
  `avatar_height` smallint(5) UNSIGNED DEFAULT NULL,
  `pass_salt` binary(16) DEFAULT NULL,
  `pass_check` binary(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` tinyint(3) UNSIGNED DEFAULT NULL,
  `logged_in` datetime DEFAULT NULL,
  `login_ip` varbinary(16) DEFAULT NULL,
  `written` datetime DEFAULT NULL,
  `write_ip` varbinary(16) DEFAULT NULL,
  `email_code` char(8) DEFAULT '"',
  `session_code` char(8) DEFAULT '"',
  `session_source` varchar(16) DEFAULT '"',
  `flags` smallint(5) UNSIGNED DEFAULT '0',
  `wall_posts` mediumint(9) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_users`
--

INSERT INTO `ilya_users` (`id`, `created`, `create_ip`, `email`, `username`, `avatar_id`, `avata_width`, `avatar_height`, `pass_salt`, `pass_check`, `password`, `level`, `logged_in`, `login_ip`, `written`, `write_ip`, `email_code`, `session_code`, `session_source`, `flags`, `wall_posts`) VALUES
  (2, NULL, NULL, 'reza@yahoo.com', 'reza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '"', '"', '"', 0, 0),
  (3, NULL, NULL, 'shima@gmail.com', 'shima', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '"', '"', '"', 0, 0),
  (4, NULL, NULL, 'fdjfk@kjj.flfl', 'aaaaaaaaaa', NULL, NULL, NULL, NULL, NULL, 'aaaaaaaaaa', NULL, NULL, NULL, NULL, NULL, '"', '"', '"', 0, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `title` varchar(100) NOT NULL,
  `content` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`title`, `content`) VALUES
  ('minify_html', '1'),
  ('site_language', 'fa'),
  ('site_text_direction', 'rtl'),
  ('site_title', 'Ilya CMS');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '0',
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`, `active`, `role`) VALUES
  (2, 'ali', 'alimatin221@yahoo.com', 'JsVcQrAVLdLZjcijK4XTsVTh1GbUGq5zNA==', '2018-08-04 10:32:49', 1, 'admin'),
  (3, 'ali2', 'alimatin@yahoo.com', 'JsVcQrAVLdLZjcijK4XTsVTh1GbUGq5zNA==', '2018-08-04 10:32:49', 1, 'member'),
  (4, 'ali3', 'ali@yahoo.com', 'JsVcQrAVLdLZjcijK4XTsVTh1GbUGq5zNA==', '2018-08-04 10:32:49', 1, 'member'),
  (6, 'qqqqqqqqqq', 'fdjfk@kjj.flfl', 'tTYLauP5BHMVKIcp4ruNnVEZF8ZKmnQWnog=', '2018-10-09 19:16:07', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ilya_blobs`
--
ALTER TABLE `ilya_blobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ilya_lang`
--
ALTER TABLE `ilya_lang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value` (`value`);

--
-- Indexes for table `ilya_language`
--
ALTER TABLE `ilya_language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iso` (`iso`);

--
-- Indexes for table `ilya_pages`
--
ALTER TABLE `ilya_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `language` (`language`);

--
-- Indexes for table `ilya_roles`
--
ALTER TABLE `ilya_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ilya_translate`
--
ALTER TABLE `ilya_translate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `language` (`language`);

--
-- Indexes for table `ilya_users`
--
ALTER TABLE `ilya_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ilya_widgets`
--
ALTER TABLE `ilya_widgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ilya_lang`
--
ALTER TABLE `ilya_lang`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ilya_language`
--
ALTER TABLE `ilya_language`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ilya_pages`
--
ALTER TABLE `ilya_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `ilya_roles`
--
ALTER TABLE `ilya_roles`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ilya_translate`
--
ALTER TABLE `ilya_translate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `ilya_users`
--
ALTER TABLE `ilya_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ilya_widgets`
--
ALTER TABLE `ilya_widgets`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ilya_pages`
--
ALTER TABLE `ilya_pages`
  ADD CONSTRAINT `fk1_ilya_pages` FOREIGN KEY (`parent_id`) REFERENCES `ilya_pages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2_ilya_pages` FOREIGN KEY (`language`) REFERENCES `ilya_language` (`iso`) ON UPDATE CASCADE;

--
-- Constraints for table `ilya_translate`
--
ALTER TABLE `ilya_translate`
  ADD CONSTRAINT `fk1_ilya_translate` FOREIGN KEY (`language`) REFERENCES `ilya_language` (`iso`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
