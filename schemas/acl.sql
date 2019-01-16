-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2019 at 10:03 AM
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

--
-- Indexes for dumped tables
--

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
-- Indexes for table `ilya_users_roles_map`
--
ALTER TABLE `ilya_users_roles_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ilya_resources`
--
ALTER TABLE `ilya_resources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ilya_roles`
--
ALTER TABLE `ilya_roles`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ilya_users_roles_map`
--
ALTER TABLE `ilya_users_roles_map`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

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
-- Constraints for table `ilya_users_roles_map`
--
ALTER TABLE `ilya_users_roles_map`
  ADD CONSTRAINT `fk1_ilya_users_roles_map` FOREIGN KEY (`user_id`) REFERENCES `ilya_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2_ilya_users_roles_map` FOREIGN KEY (`role_id`) REFERENCES `ilya_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
