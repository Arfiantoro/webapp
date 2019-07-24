-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2019 at 05:42 AM
-- Server version: 10.2.15-MariaDB
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrator', '1', 1542182038),
('User', '2', 1542182344);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1542181582, 1542181582),
('/admin/*', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/default/*', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/default/index', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/menu/*', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/menu/create', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/menu/index', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/menu/update', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/menu/view', 2, NULL, NULL, NULL, 1542181577, 1542181577),
('/admin/permission/*', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/permission/create', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/permission/index', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/permission/update', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/permission/view', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/role/*', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/role/assign', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/role/create', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/role/delete', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/role/index', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/role/remove', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/role/update', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/role/view', 2, NULL, NULL, NULL, 1542181578, 1542181578),
('/admin/route/*', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/route/assign', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/route/create', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/route/index', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/route/remove', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/rule/*', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/rule/create', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/rule/index', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/rule/update', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/rule/view', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/user/*', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/user/activate', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/user/delete', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/user/index', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/admin/user/login', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/user/logout', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/user/signup', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/admin/user/view', 2, NULL, NULL, NULL, 1542181579, 1542181579),
('/bank/*', 2, NULL, NULL, NULL, 1563888698, 1563888698),
('/bank/create', 2, NULL, NULL, NULL, 1563888697, 1563888697),
('/bank/delete', 2, NULL, NULL, NULL, 1563888698, 1563888698),
('/bank/index', 2, NULL, NULL, NULL, 1563888055, 1563888055),
('/bank/update', 2, NULL, NULL, NULL, 1563888697, 1563888697),
('/bank/view', 2, NULL, NULL, NULL, 1563888697, 1563888697),
('/debug/*', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/debug/default/*', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/debug/default/index', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/debug/default/view', 2, NULL, NULL, NULL, 1542181580, 1542181580),
('/debug/user/*', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/gii/*', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/gii/default/*', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/gii/default/action', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/gii/default/diff', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/gii/default/index', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/gii/default/preview', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/gii/default/view', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/site/*', 2, NULL, NULL, NULL, 1542181582, 1542181582),
('/site/about', 2, NULL, NULL, NULL, 1542181582, 1542181582),
('/site/captcha', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/site/contact', 2, NULL, NULL, NULL, 1542181582, 1542181582),
('/site/error', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/site/index', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/site/login', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/site/logout', 2, NULL, NULL, NULL, 1542181581, 1542181581),
('/user/*', 2, NULL, NULL, NULL, 1563889129, 1563889129),
('/user/create', 2, NULL, NULL, NULL, 1563889129, 1563889129),
('/user/delete', 2, NULL, NULL, NULL, 1563889129, 1563889129),
('/user/index', 2, NULL, NULL, NULL, 1563889129, 1563889129),
('/user/update', 2, NULL, NULL, NULL, 1563889129, 1563889129),
('/user/view', 2, NULL, NULL, NULL, 1563889129, 1563889129),
('Administrator', 1, 'Fungsi Untuk Administartor', NULL, NULL, 1542181324, 1563889161),
('User', 1, 'Fungsi Pembatasan Untuk User', NULL, NULL, 1542181346, 1563898356);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Administrator', '/*'),
('Administrator', '/admin/*'),
('Administrator', '/admin/assignment/*'),
('Administrator', '/admin/assignment/assign'),
('Administrator', '/admin/assignment/index'),
('Administrator', '/admin/assignment/revoke'),
('Administrator', '/admin/assignment/view'),
('Administrator', '/admin/default/*'),
('Administrator', '/admin/default/index'),
('Administrator', '/admin/menu/*'),
('Administrator', '/admin/menu/create'),
('Administrator', '/admin/menu/delete'),
('Administrator', '/admin/menu/index'),
('Administrator', '/admin/menu/update'),
('Administrator', '/admin/menu/view'),
('Administrator', '/admin/permission/*'),
('Administrator', '/admin/permission/assign'),
('Administrator', '/admin/permission/create'),
('Administrator', '/admin/permission/delete'),
('Administrator', '/admin/permission/index'),
('Administrator', '/admin/permission/remove'),
('Administrator', '/admin/permission/update'),
('Administrator', '/admin/permission/view'),
('Administrator', '/admin/role/*'),
('Administrator', '/admin/role/assign'),
('Administrator', '/admin/role/create'),
('Administrator', '/admin/role/delete'),
('Administrator', '/admin/role/index'),
('Administrator', '/admin/role/remove'),
('Administrator', '/admin/role/update'),
('Administrator', '/admin/role/view'),
('Administrator', '/admin/route/*'),
('Administrator', '/admin/route/assign'),
('Administrator', '/admin/route/create'),
('Administrator', '/admin/route/index'),
('Administrator', '/admin/route/refresh'),
('Administrator', '/admin/route/remove'),
('Administrator', '/admin/rule/*'),
('Administrator', '/admin/rule/create'),
('Administrator', '/admin/rule/delete'),
('Administrator', '/admin/rule/index'),
('Administrator', '/admin/rule/update'),
('Administrator', '/admin/rule/view'),
('Administrator', '/admin/user/*'),
('Administrator', '/admin/user/activate'),
('Administrator', '/admin/user/change-password'),
('Administrator', '/admin/user/delete'),
('Administrator', '/admin/user/index'),
('Administrator', '/admin/user/login'),
('Administrator', '/admin/user/logout'),
('Administrator', '/admin/user/request-password-reset'),
('Administrator', '/admin/user/reset-password'),
('Administrator', '/admin/user/signup'),
('Administrator', '/admin/user/view'),
('Administrator', '/bank/*'),
('Administrator', '/bank/create'),
('Administrator', '/bank/delete'),
('Administrator', '/bank/index'),
('Administrator', '/bank/update'),
('Administrator', '/bank/view'),
('Administrator', '/debug/*'),
('Administrator', '/debug/default/*'),
('Administrator', '/debug/default/db-explain'),
('Administrator', '/debug/default/download-mail'),
('Administrator', '/debug/default/index'),
('Administrator', '/debug/default/toolbar'),
('Administrator', '/debug/default/view'),
('Administrator', '/debug/user/*'),
('Administrator', '/debug/user/reset-identity'),
('Administrator', '/debug/user/set-identity'),
('Administrator', '/gii/*'),
('Administrator', '/gii/default/*'),
('Administrator', '/gii/default/action'),
('Administrator', '/gii/default/diff'),
('Administrator', '/gii/default/index'),
('Administrator', '/gii/default/preview'),
('Administrator', '/gii/default/view'),
('Administrator', '/site/*'),
('Administrator', '/site/about'),
('Administrator', '/site/captcha'),
('Administrator', '/site/contact'),
('Administrator', '/site/error'),
('Administrator', '/site/index'),
('Administrator', '/site/login'),
('Administrator', '/site/logout'),
('Administrator', '/user/*'),
('Administrator', '/user/create'),
('Administrator', '/user/delete'),
('Administrator', '/user/index'),
('Administrator', '/user/update'),
('Administrator', '/user/view'),
('User', '/bank/*'),
('User', '/bank/create'),
('User', '/bank/delete'),
('User', '/bank/index'),
('User', '/bank/update'),
('User', '/bank/view'),
('User', '/site/*'),
('User', '/site/about'),
('User', '/site/captcha'),
('User', '/site/contact'),
('User', '/site/error'),
('User', '/site/index'),
('User', '/site/login'),
('User', '/site/logout');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(9, 'User Access Control', NULL, NULL, 3, NULL),
(10, 'Role', 9, '/admin/role/index', 1, NULL),
(11, 'Menu', 9, '/admin/menu/index', 2, NULL),
(12, 'Route', 9, '/admin/route/index', 3, NULL),
(13, 'Permission', 9, '/admin/permission/index', 4, NULL),
(14, 'Assignment', 9, '/admin/assignment/index', 5, NULL),
(15, 'Rule', 9, '/admin/role/index', 5, NULL),
(27, 'Master Data', NULL, NULL, 1, NULL),
(28, 'Pengguna', 27, '/user/index', 2, NULL),
(29, 'Bank', 27, '/bank/index', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1542171928),
('m140506_102106_rbac_init', 1542172452),
('m140602_111327_create_menu_table', 1542171933),
('m160312_050000_create_user', 1542171934),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1542172453),
('m180523_151638_rbac_updates_indexes_without_prefix', 1542172454);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE IF NOT EXISTS `tbl_bank` (
`bank_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_address` text NOT NULL,
  `bank_phone` varchar(20) NOT NULL,
  `bank_email` varchar(255) NOT NULL,
  `bank_photo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`bank_id`, `bank_name`, `bank_address`, `bank_phone`, `bank_email`, `bank_photo`) VALUES
(33, 'Bank Central Asia', 'Menara BCA, Grand Indonesia\r\nJl. MH Thamrin No. 1, Jakarta 10313', '(021) 235 88000', 'halobca@bca.co.id', 'Y-HDtOR241xs9F8jmcAjPF-4qqMw_1-U.jpg'),
(34, 'Bank Mandiri', 'Jl. Jenderal Gatot Subroto Kav. 36-38\r\nJakarta 12190 Indonesia', '(021) 14000', 'mandiricare@bankmandiri.co.id', '_UJr28ctnpnjWbwHNgvhEaBQzZADC9za.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Ru9aRB6T6RAa30--Y8NuQmY8V_-amHBj', '$2y$13$WYOutb0VCWxDqGPKlFxL4ObPjCXCKnTOeCMIyTFO25RUXYAAp9vFu', 'uW87Jzmltfc1jNMZQsDHzrhNEs0ZorvI_1488535290', 'super@localhost.id', 4, NULL, NULL),
(2, 'user', 'Ru9aRB6T6RAa30--Y8NuQmY8V_-amHB5', '$2y$13$WYOutb0VCWxDqGPKlFxL4ObPjCXCKnTOeCMIyTFO25RUXYAAp9vFu', 'uW87Jzmltfc1jNMZQsDHzrhNEs0ZorvI_1488535280', 'user@localhost.id', 4, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`), ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
 ADD PRIMARY KEY (`name`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id`), ADD KEY `parent` (`parent`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
 ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
