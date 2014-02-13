-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 09. Jan 2014 um 20:26
-- Server Version: 5.6.15
-- PHP-Version: 5.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_nested_menu_tree`
--

CREATE TABLE IF NOT EXISTS `tbl_nested_menu_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `root` int(11) NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `tbl_nested_menu_tree`
--

INSERT INTO `tbl_nested_menu_tree` (`id`, `title`, `root`, `lft`, `rgt`, `level`) VALUES
(5, 'frontend-footer-menue', 5, 1, 2, 1);

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
  KEY `tree_id` (`tree_id`),
  KEY `tree_id_2` (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tbl_nested_menu_tree_config`
--

INSERT INTO `tbl_nested_menu_tree_config` (`id`, `tree_id`, `url_shema`, `url_relative`, `url_absolute`, `use_visible`, `active`, `url_target`, `icon_id`) VALUES
(3, 5, NULL, NULL, NULL, 0, NULL, '_self', NULL);

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
  KEY `tree_id` (`tree_id`),
  KEY `tree_id_2` (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `tbl_nested_menu_tree_profile`
--

INSERT INTO `tbl_nested_menu_tree_profile` (`id`, `tree_id`, `title`, `slug`, `description`) VALUES
(4, 5, 'Frontend Footer Menue', 'frontend-footer-menue', '');

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
