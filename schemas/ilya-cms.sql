-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2018 at 10:01 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(2, NULL, NULL, 'reza@yahoo.com', 'reza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"', '\"', '\"', 0, 0),
(3, NULL, NULL, 'shima@gmail.com', 'shima', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"', '\"', '\"', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ilya_users_fields_map`
--

CREATE TABLE `ilya_users_fields_map` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_field_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `content` varchar(8000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ilya_user_fields`
--

CREATE TABLE `ilya_user_fields` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `user_fields_category_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(100) DEFAULT NULL,
  `position` smallint(5) UNSIGNED DEFAULT NULL,
  `flags` tinyint(3) UNSIGNED DEFAULT NULL,
  `permit` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_user_fields`
--

INSERT INTO `ilya_user_fields` (`id`, `user_fields_category_id`, `title`, `content`, `position`, `flags`, `permit`) VALUES
(1, 1, 'نام', 'فیلد نام', 1, NULL, NULL),
(2, 1, 'نام خانوادگی', 'فیلد نام خانوادگی', 2, NULL, NULL),
(3, 1, 'نام پدر', 'فیلد نام پدر', 3, NULL, NULL),
(4, 1, 'شماره شناسنامه', 'فیلد شماره شناسنامه', 4, NULL, NULL),
(5, 1, 'محل صدور', 'فیلد محل صدور', 5, NULL, NULL),
(6, 1, 'جنسیت', 'فیلد جنسیت', 6, NULL, NULL),
(7, 1, 'تاریخ تولد', 'فیلد تاریخ تولد', 7, NULL, NULL),
(8, 2, 'منطقه زمانی', 'فیلد منطقه زمانی', 1, NULL, NULL),
(9, 2, 'سبک مورد استفاده', 'فیلد سبک مورد استفاده', 2, NULL, NULL),
(10, 2, 'تاریخ خاتمه عضویت', 'فیلد تاریخ خاتمه عضویت', 3, NULL, NULL),
(11, 3, 'نوع عضو', 'فیلد نوع عضو', 1, NULL, NULL),
(12, 3, 'نام شرکت', 'فیلد نام شرکت', 2, NULL, NULL),
(13, 3, 'کد اقتصادی', 'فیلد کد اقتصادی', 3, NULL, NULL),
(14, 3, 'کد ملی شرکت', 'فیلد کد ملی شرکت', 4, NULL, NULL),
(15, 3, 'شماره ثبت', 'فیلد شماره ثبت', 5, NULL, NULL),
(16, 3, 'سمت', 'فیلد سمت', 6, NULL, NULL),
(17, 3, 'کد پرسنلی', 'فیلد کد پرسنلی', 7, NULL, NULL),
(18, 4, 'رتبه تحصیلی', 'فیلد رتبه تحصیلی', 1, NULL, NULL),
(19, 4, 'رشته تحصیلی', 'فیلد رشته تحصیلی', 2, NULL, NULL),
(20, 5, 'آدرس صفحه شخصی', 'فیلد آدرس صفحه شخصی', 1, NULL, NULL),
(21, 5, 'آدرس وبلاگ', 'فیلد آدرس وبلاگ', 2, NULL, NULL),
(22, 5, 'امضا', 'فیلد امضا', 3, NULL, NULL),
(23, 5, 'علایق', 'فیلد علایق', 4, NULL, NULL),
(24, 6, 'first name', 'first name field', 1, NULL, NULL),
(25, 11, 'Nombre', NULL, 1, NULL, NULL),
(26, 6, 'last name', NULL, 2, NULL, NULL),
(27, 11, 'Apellido', NULL, 2, NULL, NULL),
(28, 6, 'father\'s name', NULL, 3, NULL, NULL),
(29, 11, 'El nombre del padre', NULL, 3, NULL, NULL),
(30, 6, 'Id', NULL, 4, NULL, NULL),
(31, 11, 'Número de identificación', NULL, 4, NULL, NULL),
(32, 6, 'Place of Issue', NULL, 5, NULL, NULL),
(33, 11, 'Lugar de emisión', NULL, 5, NULL, NULL),
(34, 6, 'Date of birth', NULL, 7, NULL, NULL),
(35, 11, 'Fecha de nacimiento', NULL, 7, NULL, NULL),
(36, 7, 'Time zone', NULL, 1, NULL, NULL),
(37, 12, 'Huso horario', NULL, 1, NULL, NULL),
(38, 7, 'Style used', NULL, 2, NULL, NULL),
(39, 12, 'Estilo utilizado', NULL, 2, NULL, NULL),
(40, 7, 'Date End Date', NULL, 3, NULL, NULL),
(41, 12, 'Fecha de finalización', NULL, 3, NULL, NULL),
(42, 8, 'Member type', NULL, 1, NULL, NULL),
(43, 13, 'Tipo de miembro', NULL, 1, NULL, NULL),
(44, 8, 'Company Name', NULL, 2, NULL, NULL),
(45, 12, 'Nombre de la compañía', NULL, 2, NULL, NULL),
(46, 8, 'Economic Code', NULL, 3, NULL, NULL),
(47, 13, 'Código económico', NULL, 3, NULL, NULL),
(48, 8, 'registration number', NULL, 4, NULL, NULL),
(49, 13, 'Número de registro', NULL, 5, NULL, NULL),
(50, 9, 'Grade', NULL, 1, NULL, NULL),
(51, 14, 'Nivel educacional', NULL, 1, NULL, NULL),
(52, 14, 'Campo de estudio', NULL, 2, NULL, NULL),
(53, 4, 'Field of Study', NULL, 2, NULL, NULL),
(54, 10, 'Page address', NULL, 1, NULL, NULL),
(55, 15, 'Dirección de la página', NULL, 1, NULL, NULL),
(56, 10, 'Blog address', NULL, 2, NULL, NULL),
(57, 15, 'Dirección del blog', NULL, 2, NULL, NULL),
(58, 10, 'Signature', NULL, 3, NULL, NULL),
(59, 15, 'Firma', NULL, 3, NULL, NULL),
(60, 10, 'Favorites', NULL, 4, NULL, NULL),
(61, 15, 'Intereses', NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ilya_user_fields_category`
--

CREATE TABLE `ilya_user_fields_category` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(45) NOT NULL,
  `content` varchar(100) DEFAULT NULL,
  `lang_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `position` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ilya_user_fields_category`
--

INSERT INTO `ilya_user_fields_category` (`id`, `title`, `content`, `lang_id`, `position`) VALUES
(1, 'اطلاعات شخصی', 'دسته بندی اطلاعات شخصی', 1, 1),
(2, 'اطلاعات تنظیمات', 'دسته بندی اطلاعات تنظیمات', 1, 2),
(3, 'اطلاعات شرکت', 'دسته بندی اطلاعات شرکت', 1, 3),
(4, 'اطلاعات تحصیلی', 'دسته بندی اطلاعات تحصیلی', 1, 4),
(5, 'اطلاعات تکمیلی', 'دسته بندی اطلاعات تکمیلی', 1, 5),
(6, 'Personal Information', 'Personal Information Category', 2, 1),
(7, 'Setting Information', 'Setting Information Category', 2, 2),
(8, 'Company Information', 'Company Information Category', 2, 3),
(9, 'Educational Information', 'Educational Information Category', 2, 4),
(10, 'Further information', 'Further information Category', 2, 5),
(11, 'Información personal', 'Categorizar información personal', 3, 1),
(12, 'Información de configuración', 'Categoría de información de configuración', 3, 2),
(13, 'Información de la compañía', 'Información de la empresa Categoría', 3, 3),
(14, 'Información educativa', 'Clasificación de la información educativa', 3, 4),
(15, 'Información adicional', 'Categorías de información adicional', 3, 5);

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
  `active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`, `active`) VALUES
(2, 'ali', 'alimatin221@yahoo.com', 'JsVcQrAVLdLZjcijK4XTsVTh1GbUGq5zNA==', '2018-08-04 10:32:49', 1),
(3, 'aliman2', 'alimatin@yahoo.com', 'JsVcQrAVLdLZjcijK4XTsVTh1GbUGq5zNA==', '2018-08-04 10:32:49', 1),
(4, 'ali', 'ali@yahoo.com', 'JsVcQrAVLdLZjcijK4XTsVTh1GbUGq5zNA==', '2018-08-04 10:32:49', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ilya_lang`
--
ALTER TABLE `ilya_lang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value` (`value`);

--
-- Indexes for table `ilya_users`
--
ALTER TABLE `ilya_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ilya_users_fields_map`
--
ALTER TABLE `ilya_users_fields_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_fields_map_field_id` (`user_field_id`),
  ADD KEY `fk_users_fields_map_user_id` (`user_id`);

--
-- Indexes for table `ilya_user_fields`
--
ALTER TABLE `ilya_user_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fields_category_id` (`user_fields_category_id`);

--
-- Indexes for table `ilya_user_fields_category`
--
ALTER TABLE `ilya_user_fields_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `lang_id_2` (`lang_id`);

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
-- AUTO_INCREMENT for table `ilya_users`
--
ALTER TABLE `ilya_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ilya_users_fields_map`
--
ALTER TABLE `ilya_users_fields_map`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ilya_user_fields`
--
ALTER TABLE `ilya_user_fields`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `ilya_user_fields_category`
--
ALTER TABLE `ilya_user_fields_category`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ilya_users_fields_map`
--
ALTER TABLE `ilya_users_fields_map`
  ADD CONSTRAINT `fk_users_fields_map_field_id` FOREIGN KEY (`user_field_id`) REFERENCES `ilya_user_fields` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_fields_map_user_id` FOREIGN KEY (`user_id`) REFERENCES `ilya_users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ilya_user_fields`
--
ALTER TABLE `ilya_user_fields`
  ADD CONSTRAINT `fk_user_fields_category_id` FOREIGN KEY (`user_fields_category_id`) REFERENCES `ilya_user_fields_category` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ilya_user_fields_category`
--
ALTER TABLE `ilya_user_fields_category`
  ADD CONSTRAINT `fk_user_fields_category_lang_id` FOREIGN KEY (`lang_id`) REFERENCES `ilya_lang` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
