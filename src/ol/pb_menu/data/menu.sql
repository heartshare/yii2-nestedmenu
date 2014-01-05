- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 17. Jul 2013 um 10:51
-- Server Version: 5.5.25
-- PHP-Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `db-rauschenberger`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_icons`
--

CREATE TABLE `menu_icons` (
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

CREATE TABLE `menu_list` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Daten für Tabelle `menu_list`
--

INSERT INTO `menu_list` (`id`, `name`, `lft`, `rgt`, `level`, `root`, `create`, `update`) VALUES
(12, 'root', 1, 40, 1, 12, '2013-07-03 20:05:57', '2013-07-03 20:05:57'),
(13, 'Admin', 4, 39, 2, 12, '2013-07-03 20:06:14', '2013-07-03 20:16:42'),
(14, 'User anlegen', 6, 7, 4, 12, '2013-07-03 20:06:31', '2013-07-03 20:06:31'),
(15, 'Auth', 11, 22, 3, 12, '2013-07-03 20:08:53', '2013-07-03 20:08:53'),
(16, 'User', 5, 10, 3, 12, '2013-07-03 20:17:03', '2013-07-03 20:17:03'),
(17, 'Menü Admin', 24, 25, 4, 12, '2013-07-03 20:36:10', '2013-07-04 06:52:33'),
(18, 'User Admin', 8, 9, 4, 12, '2013-07-03 21:39:00', '2013-07-03 21:39:00'),
(19, 'Zuordnungen', 12, 13, 4, 12, '2013-07-03 22:26:16', '2013-07-03 22:26:16'),
(20, 'Menü', 23, 26, 3, 12, '2013-07-03 22:27:23', '2013-07-04 06:51:59'),
(21, 'Rollen', 14, 15, 4, 12, '2013-07-03 22:39:00', '2013-07-03 22:39:00'),
(22, 'Home', 2, 3, 2, 12, '2013-07-03 22:41:45', '2013-07-03 22:41:45'),
(23, 'Operationen', 18, 19, 4, 12, '2013-07-04 06:49:33', '2013-07-04 06:49:33'),
(24, 'Aufgaben', 16, 17, 4, 12, '2013-07-04 06:50:40', '2013-07-04 06:50:40'),
(25, 'root', 1, 12, 1, 25, '2013-07-05 09:10:23', '2013-07-05 09:10:23'),
(26, 'Home', 2, 3, 2, 25, '2013-07-05 09:10:45', '2013-07-05 09:10:45'),
(27, 'Developer', 27, 36, 3, 12, '2013-07-05 09:17:52', '2013-07-05 09:17:52'),
(28, 'PHP-Info', 32, 33, 4, 12, '2013-07-05 09:18:05', '2013-07-05 09:18:05'),
(29, 'Class-Reference', 34, 35, 4, 12, '2013-07-05 09:28:02', '2013-07-05 09:28:02'),
(30, 'Yii Info', 28, 29, 4, 12, '2013-07-05 10:17:44', '2013-07-05 10:17:44'),
(31, 'Db-Admin', 30, 31, 4, 12, '2013-07-08 10:17:08', '2013-07-08 10:17:08'),
(32, 'Blog', 4, 7, 2, 25, '2013-07-15 09:09:25', '2013-07-15 09:09:25'),
(33, 'Blog Admin', 5, 6, 3, 25, '2013-07-15 09:09:37', '2013-07-15 09:09:37'),
(34, 'Job', 8, 11, 2, 25, '2013-07-15 09:21:01', '2013-07-15 09:21:01'),
(35, 'Job Angebot', 9, 10, 3, 25, '2013-07-15 09:21:15', '2013-07-15 09:21:15'),
(36, 'Import', 20, 21, 4, 12, '2013-07-15 10:11:15', '2013-07-15 10:11:15'),
(37, 'root', 1, 2, 1, 37, '2013-07-16 13:02:42', '2013-07-16 13:02:42'),
(38, 'App-Config', 37, 38, 3, 12, '2013-07-16 14:14:20', '2013-07-16 14:15:32');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_list_config`
--

CREATE TABLE `menu_list_config` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Daten für Tabelle `menu_list_config`
--

INSERT INTO `menu_list_config` (`id`, `menu_list_id`, `menu_url`, `visible_criteria`, `use_visible`, `active`, `url_target`, `icon_id`) VALUES
(4, 13, '', '', 0, 1, '_self', 19),
(5, 14, '/wr_user/user/register', 'wr_user.user.register', 1, 1, '_self', 81),
(6, 15, '', '', 0, 1, '_self', 137),
(7, 16, '', 'wr_user.user.*', 1, 1, '_self', 8),
(8, 17, '/menu/menuTree/admin', 'menu.menuTree.admin', 1, 1, '_self', 124),
(9, 18, '/wr_user/user/admin', 'wr_user.user.admin', 1, 1, '_self', 19),
(10, 19, '/auth/assignment/index', '', 0, 1, '_self', 30),
(11, 20, '', 'menu.menuTree.*', 1, 1, '_self', 56),
(12, 21, '/auth/role/index', '', 0, 1, '_self', 110),
(13, 22, '/', '', 0, 1, '_self', 21),
(14, 23, '/auth/operation/index', '', 0, 1, '_self', 115),
(15, 24, '/auth/task/index', '', 0, 1, '_self', 28),
(16, 26, '/', '', 0, 1, '_self', 21),
(17, 28, '/site/phpinfo', 'site.phpinfo', 1, 1, '_self', 121),
(18, 29, '/site/doc', 'site.doc', 1, 1, '_top', 43),
(19, 30, '/site/yii', 'site.yii', 1, 1, '_self', 101),
(20, 27, '', '', 0, 1, '_self', 104),
(21, 31, '/site/adminer', '', 0, 1, '_self', 107),
(22, 32, '', '', 0, 1, '_self', 43),
(23, 33, '/blog/blogadmin', '', 0, 1, '_self', 42),
(24, 35, '/job/jobangebot/admin', '', 0, 1, '_self', 86),
(25, 34, '', '', 0, 1, '_self', 28),
(26, 36, '/auth/service/import', 'auth.service.importModule', 1, 1, '_self', 95),
(27, 38, '/configapp/admin', '', 0, 1, '_self', 19);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_list_tree`
--

CREATE TABLE `menu_list_tree` (
  `tree_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  KEY `tree_id` (`tree_id`),
  KEY `list_id` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Verbindet List mit Tree';

--
-- Daten für Tabelle `menu_list_tree`
--

INSERT INTO `menu_list_tree` (`tree_id`, `list_id`) VALUES
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(5, 25),
(5, 26),
(4, 27),
(4, 28),
(4, 29),
(4, 30),
(4, 31),
(5, 32),
(5, 33),
(5, 34),
(5, 35),
(4, 36),
(6, 37),
(4, 38);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu_tree`
--

CREATE TABLE `menu_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `menu_tree`
--

INSERT INTO `menu_tree` (`id`, `title`, `info`) VALUES
(4, 'Backend Rollout Navi', 'Backend Rollout'),
(5, 'Backend Top Navigation', 'Top Nav'),
(6, 'Frontend Top Navigation', 'Die Navigation im Header');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `menu_list_config`
--
ALTER TABLE `menu_list_config`
  ADD CONSTRAINT `menu_list_config_ibfk_1` FOREIGN KEY (`menu_list_id`) REFERENCES `menu_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_list_config_ibfk_2` FOREIGN KEY (`icon_id`) REFERENCES `menu_icons` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `menu_list_tree`
--
ALTER TABLE `menu_list_tree`
  ADD CONSTRAINT `menu_list` FOREIGN KEY (`list_id`) REFERENCES `menu_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_tree` FOREIGN KEY (`tree_id`) REFERENCES `menu_tree` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
