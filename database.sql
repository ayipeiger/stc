-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2020 at 12:43 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stc`
--
CREATE DATABASE IF NOT EXISTS `stc` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `stc`;

-- --------------------------------------------------------

--
-- Table structure for table `firewall`
--

DROP TABLE IF EXISTS `firewall`;
CREATE TABLE IF NOT EXISTS `firewall` (
  `ip` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `port` int(10) NOT NULL,
  `is_vdom` tinyint(1) NOT NULL,
  `vdom` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `setup_command` tinytext COLLATE latin1_general_ci NOT NULL,
  `spesial_command` tinytext COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncate table before insert `firewall`
--

TRUNCATE TABLE `firewall`;
--
-- Dumping data for table `firewall`
--

INSERT INTO `firewall` (`ip`, `port`, `is_vdom`, `vdom`, `setup_command`, `spesial_command`) VALUES('10.35.65.151', 30, 1, 'WAN', 'configure\r\n\r\nset source ip {#IPSRC}\r\nset destination ip {#IPDEST}\r\nset service {#PORTTCP} {#PORTUDP}\r\n\r\nsave', 'edit {#IPSRC}\r\nconfigure subnet {#IPSRC}');
INSERT INTO `firewall` (`ip`, `port`, `is_vdom`, `vdom`, `setup_command`, `spesial_command`) VALUES('172.18.44.157', 25, 1, 'WAN', 'Template {#IPSRC}\r\nTemplate {#IPDEST}\r\nTemplate {#PORTTCP}\r\nTemplate {#PORTUDP}', 'Template {#IPSRC}\r\nTemplate {#IPDEST}\r\nTemplate {#PORTTCP}\r\nTemplate {#PORTUDP}');
INSERT INTO `firewall` (`ip`, `port`, `is_vdom`, `vdom`, `setup_command`, `spesial_command`) VALUES('172.18.44.160', 8080, 1, 'LAN', 'Template {#IPSRC}\r\nTemplate {#IPDEST}\r\nTemplate {#PORTTCP}\r\nTemplate {#PORTUDP}', 'Template {#IPSRC}\r\nTemplate {#IPDEST}\r\nTemplate {#PORTTCP}\r\nTemplate {#PORTUDP}');
INSERT INTO `firewall` (`ip`, `port`, `is_vdom`, `vdom`, `setup_command`, `spesial_command`) VALUES('192.168.6.1', 25, 1, 'WAN', 'Template 1\r\nTemplate 2\r\nTemplate 3', 'Template 4\r\nTemplate 5\r\nTemplate 6');
INSERT INTO `firewall` (`ip`, `port`, `is_vdom`, `vdom`, `setup_command`, `spesial_command`) VALUES('192.168.76.14', 30, 1, 'LAN', 'Testing A\r\nTesting B\r\nTesting C', 'Testing D\r\nTesting E\r\nTesting F');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_object_addresses`
--

DROP TABLE IF EXISTS `firewall_object_addresses`;
CREATE TABLE IF NOT EXISTS `firewall_object_addresses` (
  `ip` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `ipname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `type` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(50) COLLATE latin1_general_ci NOT NULL,
  KEY `select_idx` (`ip`,`address`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncate table before insert `firewall_object_addresses`
--

TRUNCATE TABLE `firewall_object_addresses`;
-- --------------------------------------------------------

--
-- Table structure for table `firewall_object_services`
--

DROP TABLE IF EXISTS `firewall_object_services`;
CREATE TABLE IF NOT EXISTS `firewall_object_services` (
  `ip` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `portname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `protocol` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `portaddress` varchar(50) COLLATE latin1_general_ci NOT NULL,
  KEY `select_idx` (`ip`,`portaddress`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncate table before insert `firewall_object_services`
--

TRUNCATE TABLE `firewall_object_services`;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
