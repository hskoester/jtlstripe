-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Apr 2019 um 15:20
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


--
-- Tabellenstruktur für Tabelle `cc_details`
--

DROP TABLE IF EXISTS `cc_details`;
CREATE TABLE IF NOT EXISTS `cc_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_holder` text NOT NULL,
  `cc_no` text NOT NULL,
  `cc_month` text NOT NULL,
  `cc_year` text NOT NULL,
  `cc_cvc` text NOT NULL,
  `customer_no` text NOT NULL,
  `source_id` text NOT NULL,
  `creation_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dd_details`
--

DROP TABLE IF EXISTS `dd_details`;
CREATE TABLE IF NOT EXISTS `dd_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dd_holder` text NOT NULL,
  `dd_iban` text NOT NULL,
  `dd_bic` text NOT NULL,
  `dd_customerno` text NOT NULL,
  `source_id` text NOT NULL,
  `creationtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
