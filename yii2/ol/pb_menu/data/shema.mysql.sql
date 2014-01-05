-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 03. Jul 2013 um 19:41
-- Server Version: 5.6.12
-- PHP-Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `db-rauschenberger`
--
CREATE DATABASE IF NOT EXISTS `db-rauschenberger` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `db-rauschenberger`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `authAssignment`
--

CREATE TABLE IF NOT EXISTS `authAssignment` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `authAssignment`
--

INSERT INTO `authAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('authManager', '4', NULL, 'N;'),
('Blogger', '4', NULL, 'N;'),
('menuManager', '4', NULL, 'N;'),
('superManager', '4', NULL, 'N;');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `authItem`
--

CREATE TABLE IF NOT EXISTS `authItem` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `authItem`
--

INSERT INTO `authItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('auth', 1, 'Auth Module Wildcard', NULL, 'N;'),
('auth.service.importModule', 0, 'auth.service.importModule', NULL, 'N;'),
('authManager', 2, 'AuthManager', NULL, 'N;'),
('Blogger', 2, 'Blog', NULL, 'N;'),
('menuManager', 2, 'Menue Manager', NULL, 'N;'),
('site.*', 1, 'Site Wildcard', NULL, 'N;'),
('site.index', 0, 'site.index', NULL, 'N;'),
('superManager', 2, 'Super Manager', NULL, 'N;'),
('wr_user.user.*', 0, 'User Wildcard', NULL, 'N;'),
('wr_user.user.admin', 0, 'wr_user.user.admin', NULL, 'N;'),
('wr_user.user.admin*', 0, 'User Admin', NULL, 'N;'),
('wr_user.user.avatar', 0, 'wr_user.user.avatar', NULL, 'N;'),
('wr_user.user.create', 0, 'create user', NULL, 'N;'),
('wr_user.user.createChar', 0, 'wr_user.user.createChar', NULL, 'N;'),
('wr_user.user.createProfile', 0, 'wr_user.user.createProfile', NULL, 'N;'),
('wr_user.user.delete', 0, 'delete user', NULL, 'N;'),
('wr_user.user.deleteChar', 0, 'wr_user.user.deleteChar', NULL, 'N;'),
('wr_user.user.index', 0, 'wr_user.user.index', NULL, 'N;'),
('wr_user.user.login', 0, 'wr_user.user.login', NULL, 'N;'),
('wr_user.user.logout', 0, 'wr_user.user.logout', NULL, 'N;'),
('wr_user.user.password', 0, 'wr_user.user.password', NULL, 'N;'),
('wr_user.user.register', 0, 'wr_user.user.register', NULL, 'N;'),
('wr_user.user.status', 0, 'wr_user.user.status', NULL, 'N;'),
('wr_user.user.update', 0, 'update user', NULL, 'N;'),
('wr_user.user.updateChar', 0, 'wr_user.user.updateChar', NULL, 'N;'),
('wr_user.user.updateEmail', 0, 'wr_user.user.updateEmail', NULL, 'N;'),
('wr_user.user.updatePassword', 0, 'wr_user.user.updatePassword', NULL, 'N;'),
('wr_user.user.view', 0, 'wr_user.user.view', NULL, 'N;');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `authItemChild`
--

CREATE TABLE IF NOT EXISTS `authItemChild` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `authItemChild`
--

INSERT INTO `authItemChild` (`parent`, `child`) VALUES
('authManager', 'auth'),
('superManager', 'auth'),
('auth', 'auth.service.importModule'),
('superManager', 'site.*'),
('site.*', 'site.index');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_icons`
--

CREATE TABLE IF NOT EXISTS `menu_icons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `html` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=141 ;

--
-- Daten für Tabelle `menu_icons`
--

INSERT INTO `menu_icons` (`id`, `html`, `name`) VALUES
(1, '<i class="icon-glass"></i>', 'icon-glass'),
(2, '<i class="icon-music"></i>', 'icon-music'),
(3, '<i class="icon-search"></i>', 'icon-search'),
(4, '<i class="icon-envelope"></i>', 'icon-envelope'),
(5, '<i class="icon-heart"></i>', 'icon-heart'),
(6, '<i class="icon-star"></i>', 'icon-star'),
(7, '<i class="icon-star-empty"></i>', 'icon-star-empty'),
(8, '<i class="icon-user"></i>', 'icon-user'),
(9, '<i class="icon-film"></i>', 'icon-film'),
(10, '<i class="icon-th-large"></i>', 'icon-th-large'),
(11, '<i class="icon-th"></i>', 'icon-th'),
(12, '<i class="icon-th-list"></i>', 'icon-th-list'),
(13, '<i class="icon-ok"></i>', 'icon-ok'),
(14, '<i class="icon-remove"></i>', 'icon-remove'),
(15, '<i class="icon-zoom-in"></i>', 'icon-zoom-in'),
(16, '<i class="icon-zoom-out"></i>', 'icon-zoom-out'),
(17, '<i class="icon-off"></i>', 'icon-off'),
(18, '<i class="icon-signal"></i>', 'icon-signal'),
(19, '<i class="icon-cog"></i>', 'icon-cog'),
(20, '<i class="icon-trash"></i>', 'icon-trash'),
(21, '<i class="icon-home"></i>', 'icon-home'),
(22, '<i class="icon-file"></i>', 'icon-file'),
(23, '<i class="icon-time"></i>', 'icon-time'),
(24, '<i class="icon-road"></i>', 'icon-road'),
(25, '<i class="icon-download-alt"></i>', 'icon-download-alt'),
(26, '<i class="icon-download"></i>', 'icon-download'),
(27, '<i class="icon-upload"></i>', 'icon-upload'),
(28, '<i class="icon-inbox"></i>', 'icon-inbox'),
(29, '<i class="icon-play-circle"></i>', 'icon-play-circle'),
(30, '<i class="icon-repeat"></i>', 'icon-repeat'),
(31, '<i class="icon-refresh"></i>', 'icon-refresh'),
(32, '<i class="icon-list-alt"></i>', 'icon-list-alt'),
(33, '<i class="icon-lock"></i>', 'icon-lock'),
(34, '<i class="icon-flag"></i>', 'icon-flag'),
(35, '<i class="icon-headphones"></i>', 'icon-headphones'),
(36, '<i class="icon-volume-off"></i>', 'icon-volume-off'),
(37, '<i class="icon-volume-down"></i>', 'icon-volume-down'),
(38, '<i class="icon-volume-up"></i>', 'icon-volume-up'),
(39, '<i class="icon-qrcode"></i>', 'icon-qrcode'),
(40, '<i class="icon-barcode"></i>', 'icon-barcode'),
(41, '<i class="icon-tag"></i>', 'icon-tag'),
(42, '<i class="icon-tags"></i>', 'icon-tags'),
(43, '<i class="icon-book"></i>', 'icon-book'),
(44, '<i class="icon-bookmark"></i>', 'icon-bookmark'),
(45, '<i class="icon-print"></i>', 'icon-print'),
(46, '<i class="icon-camera"></i>', 'icon-camera'),
(47, '<i class="icon-font"></i>', 'icon-font'),
(48, '<i class="icon-bold"></i>', 'icon-bold'),
(49, '<i class="icon-italic"></i>', 'icon-italic'),
(50, '<i class="icon-text-height"></i>', 'icon-text-height'),
(51, '<i class="icon-text-width"></i>', 'icon-text-width'),
(52, '<i class="icon-align-left"></i>', 'icon-align-left'),
(53, '<i class="icon-align-center"></i>', 'icon-align-center'),
(54, '<i class="icon-align-right"></i>', 'icon-align-right'),
(55, '<i class="icon-align-justify"></i>', 'icon-align-justify'),
(56, '<i class="icon-list"></i>', 'icon-list'),
(57, '<i class="icon-indent-left"></i>', 'icon-indent-left'),
(58, '<i class="icon-indent-right"></i>', 'icon-indent-right'),
(59, '<i class="icon-facetime-video"></i>', 'icon-facetime-video'),
(60, '<i class="icon-picture"></i>', 'icon-picture'),
(61, '<i class="icon-pencil"></i>', 'icon-pencil'),
(62, '<i class="icon-map-marker"></i>', 'icon-map-marker'),
(63, '<i class="icon-adjust"></i>', 'icon-adjust'),
(64, '<i class="icon-tint"></i>', 'icon-tint'),
(65, '<i class="icon-edit"></i>', 'icon-edit'),
(66, '<i class="icon-share"></i>', 'icon-share'),
(67, '<i class="icon-check"></i>', 'icon-check'),
(68, '<i class="icon-move"></i>', 'icon-move'),
(69, '<i class="icon-step-backward"></i>', 'icon-step-backward'),
(70, '<i class="icon-fast-backward"></i>', 'icon-fast-backward'),
(71, '<i class="icon-backward"></i>', 'icon-backward'),
(72, '<i class="icon-play"></i>', 'icon-play'),
(73, '<i class="icon-pause"></i>', 'icon-pause'),
(74, '<i class="icon-stop"></i>', 'icon-stop'),
(75, '<i class="icon-forward"></i>', 'icon-forward'),
(76, '<i class="icon-fast-forward"></i>', 'icon-fast-forward'),
(77, '<i class="icon-step-forward"></i>', 'icon-step-forward'),
(78, '<i class="icon-eject"></i>', 'icon-eject'),
(79, '<i class="icon-chevron-left"></i>', 'icon-chevron-left'),
(80, '<i class="icon-chevron-right"></i>', 'icon-chevron-right'),
(81, '<i class="icon-plus-sign"></i>', 'icon-plus-sign'),
(82, '<i class="icon-minus-sign"></i>', 'icon-minus-sign'),
(83, '<i class="icon-remove-sign"></i>', 'icon-remove-sign'),
(84, '<i class="icon-ok-sign"></i>', 'icon-ok-sign'),
(85, '<i class="icon-question-sign"></i>', 'icon-question-sign'),
(86, '<i class="icon-info-sign"></i>', 'icon-info-sign'),
(87, '<i class="icon-screenshot"></i>', 'icon-screenshot'),
(88, '<i class="icon-remove-circle"></i>', 'icon-remove-circle'),
(89, '<i class="icon-ok-circle"></i>', 'icon-ok-circle'),
(90, '<i class="icon-ban-circle"></i>', 'icon-ban-circle'),
(91, '<i class="icon-arrow-left"></i>', 'icon-arrow-left'),
(92, '<i class="icon-arrow-right"></i>', 'icon-arrow-right'),
(93, '<i class="icon-arrow-up"></i>', 'icon-arrow-up'),
(94, '<i class="icon-arrow-down"></i>', 'icon-arrow-down'),
(95, '<i class="icon-share-alt"></i>', 'icon-share-alt'),
(96, '<i class="icon-resize-full"></i>', 'icon-resize-full'),
(97, '<i class="icon-resize-small"></i>', 'icon-resize-small'),
(98, '<i class="icon-plus"></i>', 'icon-plus'),
(99, '<i class="icon-minus"></i>', 'icon-minus'),
(100, '<i class="icon-asterisk"></i>', 'icon-asterisk'),
(101, '<i class="icon-exclamation-sign"></i>', 'icon-exclamation-sign'),
(102, '<i class="icon-gift"></i>', 'icon-gift'),
(103, '<i class="icon-leaf"></i>', 'icon-leaf'),
(104, '<i class="icon-fire"></i>', 'icon-fire'),
(105, '<i class="icon-eye-open"></i>', 'icon-eye-open'),
(106, '<i class="icon-eye-close"></i>', 'icon-eye-close'),
(107, '<i class="icon-warning-sign"></i>', 'icon-warning-sign'),
(108, '<i class="icon-plane"></i>', 'icon-plane'),
(109, '<i class="icon-calendar"></i>', 'icon-calendar'),
(110, '<i class="icon-random"></i>', 'icon-random'),
(111, '<i class="icon-comment"></i>', 'icon-comment'),
(112, '<i class="icon-magnet"></i>', 'icon-magnet'),
(113, '<i class="icon-chevron-up"></i>', 'icon-chevron-up'),
(114, '<i class="icon-chevron-down"></i>', 'icon-chevron-down'),
(115, '<i class="icon-retweet"></i>', 'icon-retweet'),
(116, '<i class="icon-shopping-cart"></i>', 'icon-shopping-cart'),
(117, '<i class="icon-folder-close"></i>', 'icon-folder-close'),
(118, '<i class="icon-folder-open"></i>', 'icon-folder-open'),
(119, '<i class="icon-resize-vertical"></i>', 'icon-resize-vertical'),
(120, '<i class="icon-resize-horizontal"></i>', 'icon-resize-horizontal'),
(121, '<i class="icon-hdd"></i>', 'icon-hdd'),
(122, '<i class="icon-bullhorn"></i>', 'icon-bullhorn'),
(123, '<i class="icon-bell"></i>', 'icon-bell'),
(124, '<i class="icon-certificate"></i>', 'icon-certificate'),
(125, '<i class="icon-thumbs-up"></i>', 'icon-thumbs-up'),
(126, '<i class="icon-thumbs-down"></i>', 'icon-thumbs-down'),
(127, '<i class="icon-hand-right"></i>', 'icon-hand-right'),
(128, '<i class="icon-hand-left"></i>', 'icon-hand-left'),
(129, '<i class="icon-hand-up"></i>', 'icon-hand-up'),
(130, '<i class="icon-hand-down"></i>', 'icon-hand-down'),
(131, '<i class="icon-circle-arrow-right"></i>', 'icon-circle-arrow-right'),
(132, '<i class="icon-circle-arrow-left"></i>', 'icon-circle-arrow-left'),
(133, '<i class="icon-circle-arrow-up"></i>', 'icon-circle-arrow-up'),
(134, '<i class="icon-circle-arrow-down"></i>', 'icon-circle-arrow-down'),
(135, '<i class="icon-globe"></i>', 'icon-globe'),
(136, '<i class="icon-wrench"></i>', 'icon-wrench'),
(137, '<i class="icon-tasks"></i>', 'icon-tasks'),
(138, '<i class="icon-filter"></i>', 'icon-filter'),
(139, '<i class="icon-briefcase"></i>', 'icon-briefcase'),
(140, '<i class="icon-fullscreen"></i>', 'icon-fullscreen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_list`
--

CREATE TABLE IF NOT EXISTS `menu_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lft` int(10) DEFAULT NULL,
  `rgt` int(10) DEFAULT NULL,
  `level` smallint(5) DEFAULT NULL,
  `root` int(10) DEFAULT NULL,
  `create` datetime NOT NULL,
  `update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `menu_list`
--

INSERT INTO `menu_list` (`id`, `name`, `lft`, `rgt`, `level`, `root`, `create`, `update`) VALUES
(1, 'root', 1, 6, 1, 1, '2013-07-02 13:00:10', '2013-07-02 13:00:10'),
(2, 'User', 2, 3, 2, 1, '2013-07-02 13:01:29', '2013-07-02 13:01:29'),
(3, 'Test', 4, 5, 2, 1, '2013-07-02 13:02:04', '2013-07-02 13:02:04'),
(4, 'root', 1, 10, 1, 4, '2013-07-02 13:02:28', '2013-07-02 13:02:28'),
(5, 'Test-sub', 7, 8, 3, 4, '2013-07-02 13:02:59', '2013-07-02 13:02:59'),
(6, 'Hallo Welt', 6, 9, 2, 4, '2013-07-02 13:03:30', '2013-07-02 13:03:30'),
(7, 'Blubber', 4, 5, 2, 4, '2013-07-02 14:22:51', '2013-07-02 14:22:51'),
(8, 'Footer sitemap', 2, 3, 2, 4, '2013-07-02 14:31:32', '2013-07-02 14:31:32'),
(9, 'root', 1, 2, 1, 9, '2013-07-02 14:35:21', '2013-07-02 14:35:21');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_list_config`
--

CREATE TABLE IF NOT EXISTS `menu_list_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `menu_list_id` int(11) NOT NULL COMMENT 'Menu Liste',
  `menu_url` varchar(355) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Url',
  `visible_criteria` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Versteckt Rules',
  `use_visible` int(11) NOT NULL DEFAULT '0' COMMENT 'Versteckt nein / ja',
  `active` int(11) DEFAULT NULL COMMENT 'Aktiv nein/ja',
  `url_target` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '_self' COMMENT 'Im Fenster öffnen',
  `icon_id` int(11) DEFAULT NULL COMMENT 'Icons',
  PRIMARY KEY (`id`),
  KEY `menu_list_id` (`menu_list_id`),
  KEY `icon_id` (`icon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_list_tree`
--

CREATE TABLE IF NOT EXISTS `menu_list_tree` (
  `tree_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  KEY `tree_id` (`tree_id`),
  KEY `list_id` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Verbindet List mit Tree';

--
-- Daten für Tabelle `menu_list_tree`
--

INSERT INTO `menu_list_tree` (`tree_id`, `list_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(3, 9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_tree`
--

CREATE TABLE IF NOT EXISTS `menu_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `menu_tree`
--

INSERT INTO `menu_tree` (`id`, `title`, `info`) VALUES
(1, 'Backend Top Navigation', 'Test'),
(2, 'Frontend Top Navigation', 'Das ist die Navigation oben'),
(3, 'Front Footer Navigation', 'Das ist die Footer Navigation');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1372422172);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wr_user`
--

CREATE TABLE IF NOT EXISTS `wr_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `password_length` int(11) DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `password_hash` char(60) NOT NULL,
  `email` varchar(128) NOT NULL,
  `create` datetime NOT NULL,
  `update` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `wr_user`
--

INSERT INTO `wr_user` (`id`, `group_id`, `password_length`, `username`, `password_hash`, `email`, `create`, `update`, `status`) VALUES
(4, 6, NULL, 'brewing', '$2a$10$ySkqHme7eYA8jtFjv7s9o.f2gwvyOFhADwWSPKnoTETXh5OfOkxEG', 'pb@becklyn.com', '2012-03-16 00:17:38', '2012-03-16 00:17:38', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wr_user_group`
--

CREATE TABLE IF NOT EXISTS `wr_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `wr_user_group`
--

INSERT INTO `wr_user_group` (`id`, `name`, `level`) VALUES
(1, 'Guest', 0),
(2, 'Member', 1),
(3, 'Reporter', 10),
(4, 'Manager', 20),
(5, 'Admin', 70),
(6, 'SuperAdmin', 100);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wr_user_profiles`
--

CREATE TABLE IF NOT EXISTS `wr_user_profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `thumb` varchar(300) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `wr_user_profiles`
--

INSERT INTO `wr_user_profiles` (`user_id`, `lastname`, `firstname`, `thumb`, `birthday`) VALUES
(4, 'Brewing', 'Pascal', '/uploads/user_thumbs/4/important-meeting_4.png', '1977-04-26');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wr_user_status`
--

CREATE TABLE IF NOT EXISTS `wr_user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `wr_user_status`
--

INSERT INTO `wr_user_status` (`id`, `name`) VALUES
(1, 'activated'),
(2, 'banned'),
(3, 'new');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `YiiLog`
--

CREATE TABLE IF NOT EXISTS `YiiLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logtime` int(11) DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;




--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `authAssignment`
--
ALTER TABLE `authAssignment`
ADD CONSTRAINT `authAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `authItemChild`
--
ALTER TABLE `authItemChild`
ADD CONSTRAINT `authItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `authItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `menu_list_config`
--
ALTER TABLE `menu_list_config`
ADD CONSTRAINT `menu_list_config_ibfk_2` FOREIGN KEY (`icon_id`) REFERENCES `menu_icons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `menu_list_config_ibfk_1` FOREIGN KEY (`menu_list_id`) REFERENCES `menu_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `menu_list_tree`
--
ALTER TABLE `menu_list_tree`
ADD CONSTRAINT `menu_list` FOREIGN KEY (`list_id`) REFERENCES `menu_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `menu_tree` FOREIGN KEY (`tree_id`) REFERENCES `menu_tree` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `wr_user_profiles`
--
ALTER TABLE `wr_user_profiles`
ADD CONSTRAINT `wr_user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wr_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
