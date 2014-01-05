-- phpMyAdmin SQL Dump
-- version 4.1.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 05. Jan 2014 um 01:06
-- Server Version: 5.6.15
-- PHP Version: 5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `yiipress`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_nested_menu_tree`
--

CREATE TABLE IF NOT EXISTS `tbl_nested_menu_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `root` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `tbl_nested_menu_tree`
--

INSERT INTO `tbl_nested_menu_tree` (`id`, `title`, `root`, `lft`, `rgt`, `level`) VALUES
(1, 'frontend-top-menue', 1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_nested_menu_tree_config`
--

CREATE TABLE IF NOT EXISTS `tbl_nested_menu_tree_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tree_id` int(11) NOT NULL COMMENT 'Menu Liste',
  `url_shema` varchar(355) DEFAULT NULL COMMENT 'Url Shema Yii',
  `url_relative` varchar(255) DEFAULT NULL COMMENT 'createUrl',
  `url_absolute` varchar(255) DEFAULT NULL COMMENT 'createAbsoluteUrl',
  `use_visible` int(11) NOT NULL DEFAULT '0' COMMENT 'Versteckt nein / ja',
  `active` int(11) DEFAULT NULL COMMENT 'Aktiv nein/ja',
  `url_target` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '_self' COMMENT 'Im Fenster öffnen',
  `icon_id` int(11) DEFAULT NULL COMMENT 'Icons',
  PRIMARY KEY (`id`),
  KEY `tree_id` (`tree_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_nested_menu_tree_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_nested_menu_tree_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tree_id` int(11) NOT NULL,
  `title` varchar(355) DEFAULT NULL COMMENT 'Titel',
  `slug` varchar(125) DEFAULT NULL COMMENT 'Intern Slug',
  `description` text COMMENT 'Beschreibung',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `tree_id` (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(32) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '10',
  `status` tinyint(4) NOT NULL DEFAULT '10',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `create_time`, `update_time`) VALUES
(1, 'admin', 'SOvs3AwDy-IyMo2Mei4L9lS0MGS3Y4i5', '$2y$13$q6Zzfc.w5W4QCbvn.P6ViuyfjQu6O86ei0ZknD8l0u9GNkAZn0r2K', 'C3S69gENY82S8LIKbgxYPHT5kl8ZKefA', 'pascalbrewing@gmail.com', 10, 10, 1388843313, 1388868535);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_nested_menu_tree_config`
--
ALTER TABLE `tbl_nested_menu_tree_config`
  ADD CONSTRAINT `tbl_nested_menu_tree_config_ibfk_1` FOREIGN KEY (`tree_id`) REFERENCES `tbl_nested_menu_tree` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tbl_nested_menu_tree_profile`
--
ALTER TABLE `tbl_nested_menu_tree_profile`
  ADD CONSTRAINT `tbl_nested_menu_tree_profile_ibfk_1` FOREIGN KEY (`tree_id`) REFERENCES `tbl_nested_menu_tree` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
