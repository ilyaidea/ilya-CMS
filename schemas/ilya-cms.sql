-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 07:32 AM
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
(1053686370509, 'jpg', NULL, 'Patern_test.jpg', '36623', NULL, NULL, NULL, '2019-01-08 21:31:07', 'active'),
(3088137902901, 'png', NULL, '3.png', '134636', NULL, NULL, NULL, '2019-01-09 13:42:31', 'active'),
(3365714601171, 'jpg', NULL, 'Beta-Test-NerdMelt-Showroom.jpg', '11713', NULL, NULL, NULL, '2019-01-09 13:39:57', 'active'),
(7218396985669, 'jpg', NULL, 'Patern_test.jpg', '36623', NULL, NULL, NULL, '2018-12-26 15:45:12', 'tmp'),
(7927389985114, 'png', NULL, '2.png', '134636', NULL, NULL, NULL, '2018-12-25 12:34:05', 'tmp'),
(12390668396875, 'png', NULL, '3 - Copy.png', '134636', NULL, NULL, NULL, '2019-01-09 13:41:27', 'tmp'),
(12396990466262, 'jpg', NULL, 'Beta-Test-NerdMelt-Showroom.jpg', '11713', NULL, NULL, NULL, '2019-01-08 21:38:51', 'active'),
(18295911254788, 'png', NULL, '3.png', '134636', NULL, NULL, NULL, '2018-12-25 12:31:57', 'active');

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
(2, 'fa', 'فارسی', 4, '0', 'rtl'),
(3, 'ar', 'عربی', 1, '0', 'rtl'),
(4, 'qqq', 'qqq', 2, '0', 'rtl'),
(5, 'rrr', 'rrr', 2, '0', 'rtl'),
(6, 'bbb', 'bbb', 2, '0', 'rtl'),
(7, 'ddd', 'ddd', 2, '0', 'rtl'),
(8, 'oo', 'rrrtt', 2, '0', 'rtl'),
(9, 'lll', 'kkk', 2, '0', 'rtl'),
(10, 'vvv', 'vvv', 2, '0', 'rtl'),
(11, 'zzz', 'zzz', 2, '0', 'rtl'),
(12, 'xxxx', 'xxxx', 2, '0', 'rtl'),
(13, 'bbbb', 'bbbb', 2, '0', 'rtl'),
(14, 'sss', 'sssss', 2, '0', 'rtl'),
(15, 'kjkj', 'kjkj', 2, '0', 'rtl'),
(16, 'kkjj', 'llll', 2, '1', 'rtl');

-- --------------------------------------------------------

--
-- Table structure for table `ilya_options`
--

CREATE TABLE `ilya_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_options`
--

INSERT INTO `ilya_options` (`id`, `key`, `value`) VALUES
(1, 'site_theme', 'Snow'),
(2, 'site_theme_mobile', 'Snow Mobile'),
(3, 'site_title', 'Ilyaidea'),
(4, 'ADMIN_EMAIL', 'webmaster@localhost'),
(5, 'DEBUG_MODE', '1'),
(6, 'DISPLAY_CHANGELOG', '1'),
(7, 'PROFILER', '1'),
(8, 'TECHNICAL_WORKS', '0'),
(9, 'WIDGETS_CACHE', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ilya_pages`
--

CREATE TABLE `ilya_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` varchar(800) DEFAULT NULL,
  `language` varchar(10) DEFAULT NULL,
  `position` smallint(5) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_in` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ilya_resources`
--

CREATE TABLE `ilya_resources` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `controller` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_resources`
--

INSERT INTO `ilya_resources` (`id`, `role_id`, `controller`, `action`) VALUES
(3, 1, 'Modules\\Users\\Session\\Controllers\\LoginController', 'index'),
(4, 2, 'Modules\\Others\\Course\\Controllers\\CoursesController', 'index'),
(5, 1, 'Modules\\Users\\Session\\Controllers\\RegisterController', 'index');

-- --------------------------------------------------------

--
-- Table structure for table `ilya_roles`
--

CREATE TABLE `ilya_roles` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `parent_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_roles`
--

INSERT INTO `ilya_roles` (`id`, `parent_id`, `name`, `description`) VALUES
(1, NULL, 'guest', 'guest_role'),
(2, 1, 'member', 'member_role'),
(3, 2, 'manager', 'manager_role'),
(4, 3, 'admin', 'admin_role');

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
(29, 'en', 'add', 'Add'),
(30, 'rrr', 'add', NULL),
(31, 'bbb', 'add', NULL),
(32, 'ddd', 'add', NULL),
(33, 'oo', 'add', NULL),
(34, 'lll', 'add', NULL),
(35, 'vvv', 'add', NULL),
(36, 'zzz', 'add', NULL),
(37, 'xxxx', 'add', NULL),
(38, 'qqq', 'add', NULL),
(39, 'bbbb', 'add', NULL),
(40, 'sss', 'add', NULL),
(41, 'kjkj', 'add', NULL),
(42, 'kkjj', 'add', NULL),
(43, 'fa', 'number_book_available', '%number% book available'),
(44, 'ar', 'number_book_available', NULL),
(45, 'en', 'number_book_available', NULL),
(47, 'fa', 'num1_between_num2_exist', NULL),
(48, 'ar', 'num1_between_num2_exist', NULL),
(49, 'en', 'num1_between_num2_exist', '%num1% between %num2% Exist');

-- --------------------------------------------------------

--
-- Table structure for table `ilya_users`
--

CREATE TABLE `ilya_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `create_ip` varbinary(16) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `username` varchar(20) NOT NULL,
  `avatar_id` bigint(14) UNSIGNED DEFAULT NULL,
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

INSERT INTO `ilya_users` (`id`, `created_at`, `create_ip`, `email`, `username`, `avatar_id`, `avata_width`, `avatar_height`, `pass_salt`, `pass_check`, `password`, `level`, `logged_in`, `login_ip`, `written`, `write_ip`, `email_code`, `session_code`, `session_source`, `flags`, `wall_posts`) VALUES
(1, NULL, NULL, 'alimatin221@yahoo.com', 'alimatin', NULL, NULL, NULL, NULL, NULL, 'VR1+7GEcylMZbBPWK+0akl7yY4mWzz9/CQ==', NULL, NULL, NULL, NULL, NULL, '"', '"', '"', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ilya_users_roles_map`
--

CREATE TABLE `ilya_users_roles_map` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_users_roles_map`
--

INSERT INTO `ilya_users_roles_map` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 4);

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
(1, 'NT', 1, 'all', 'Modules\\Users\\Session\\Widgets\\Calender'),
(2, 'ST', 1, 'all', 'Modules\\Users\\Session\\Widgets\\Calender'),
(3, 'FT', 1, 'all', 'Modules\\Users\\Session\\Widgets\\Calender'),
(4, 'FB', 1, 'all', 'Modules\\Users\\Session\\Widgets\\Calender'),
(5, 'FL', 1, 'all', 'Modules\\Users\\Session\\Widgets\\Calender'),
(6, 'FH', 1, 'all', 'Modules\\Users\\Session\\Widgets\\Calender');

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
-- Indexes for table `ilya_options`
--
ALTER TABLE `ilya_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`key`);

--
-- Indexes for table `ilya_pages`
--
ALTER TABLE `ilya_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `language` (`language`);

--
-- Indexes for table `ilya_resources`
--
ALTER TABLE `ilya_resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `ilya_roles`
--
ALTER TABLE `ilya_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `parent_id` (`parent_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `avatar_id` (`avatar_id`);

--
-- Indexes for table `ilya_users_roles_map`
--
ALTER TABLE `ilya_users_roles_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `ilya_widgets`
--
ALTER TABLE `ilya_widgets`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ilya_options`
--
ALTER TABLE `ilya_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ilya_pages`
--
ALTER TABLE `ilya_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ilya_resources`
--
ALTER TABLE `ilya_resources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ilya_roles`
--
ALTER TABLE `ilya_roles`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ilya_translate`
--
ALTER TABLE `ilya_translate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `ilya_users`
--
ALTER TABLE `ilya_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ilya_users_roles_map`
--
ALTER TABLE `ilya_users_roles_map`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ilya_widgets`
--
ALTER TABLE `ilya_widgets`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
-- Constraints for table `ilya_resources`
--
ALTER TABLE `ilya_resources`
  ADD CONSTRAINT `fk1_ilya_resources` FOREIGN KEY (`role_id`) REFERENCES `ilya_roles` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ilya_roles`
--
ALTER TABLE `ilya_roles`
  ADD CONSTRAINT `fk1_ilya_roles` FOREIGN KEY (`parent_id`) REFERENCES `ilya_roles` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ilya_translate`
--
ALTER TABLE `ilya_translate`
  ADD CONSTRAINT `fk1_ilya_translate` FOREIGN KEY (`language`) REFERENCES `ilya_language` (`iso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ilya_users`
--
ALTER TABLE `ilya_users`
  ADD CONSTRAINT `fk1_ilya_users` FOREIGN KEY (`avatar_id`) REFERENCES `ilya_blobs` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ilya_users_roles_map`
--
ALTER TABLE `ilya_users_roles_map`
  ADD CONSTRAINT `fk1_ilya_users_roles_map` FOREIGN KEY (`user_id`) REFERENCES `ilya_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2_ilya_users_roles_map` FOREIGN KEY (`role_id`) REFERENCES `ilya_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
