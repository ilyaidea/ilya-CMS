-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2018 at 04:27 PM
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
(34, 'ar', 'عربی', 1, '0', 'rtl');

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
(4, 'en', 'hi_name', 'Hi %name%'),
(5, 'en', 'the_field_is_required', 'The %field% is required'),
(10, 'fa', 'add', 'افزودن'),
(11, 'en', 'add', 'Add'),
(12, 'ar', 'add', 'اضافة'),
(13, 'ar', 'phrase', 'العبارة'),
(14, 'en', 'this_is_much_dollar', 'This is %much% dollar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ilya_language`
--
ALTER TABLE `ilya_language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iso` (`iso`);

--
-- Indexes for table `ilya_translate`
--
ALTER TABLE `ilya_translate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `language` (`language`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ilya_language`
--
ALTER TABLE `ilya_language`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ilya_translate`
--
ALTER TABLE `ilya_translate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ilya_translate`
--
ALTER TABLE `ilya_translate`
  ADD CONSTRAINT `fk1_ilya_translate` FOREIGN KEY (`language`) REFERENCES `ilya_language` (`iso`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
