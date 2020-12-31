-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2020 at 02:17 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `firewall`
--

DROP TABLE IF EXISTS `firewall`;
CREATE TABLE `firewall` (
  `ip` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `port` int(10) NOT NULL,
  `is_vdom` tinyint(1) NOT NULL,
  `vdom` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `setup_command` tinytext COLLATE latin1_general_ci NOT NULL,
  `spesial_address_command` tinytext COLLATE latin1_general_ci NOT NULL,
  `spesial_port_command` tinytext COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `firewall`
--

INSERT INTO `firewall` (`ip`, `port`, `is_vdom`, `vdom`, `setup_command`, `spesial_address_command`, `spesial_port_command`) VALUES
('10.35.65.50', 22, 1, 'WAN', 'set command {#REQNUM}\r\n\r\nset source IP {#IPSRC}\r\nset destination IP {#IPDEST}\r\nset service {#PORTTCP} {#PORTUDP}', 'config firewall address\r\nedit {#IPNAME}\r\nset subnet {#IPNEW}\r\nnext~~config firewall address\r\nedit {#IPNAME}\r\nset subnet {#IPNEW}\r\nnext~~config firewall address\r\nedit {#IPNAME}\r\nset type iprange\r\nset start-ip {#IPSTART}\r\nset end-ip {#IPEND}\r\nnext', 'edit {#PORTNAME}\r\nset tcp-portrange {#PORTNEW}\r\nnext~~edit {#PORTNAME}\r\nset udp-portrange {#PORTNEW}\r\nnext');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_object_addresses`
--

DROP TABLE IF EXISTS `firewall_object_addresses`;
CREATE TABLE `firewall_object_addresses` (
  `ip` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `ipname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `type` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `firewall_object_addresses`
--

INSERT INTO `firewall_object_addresses` (`ip`, `ipname`, `type`, `address`) VALUES
('10.35.65.50', '1.1.1.1_32', 'IP Netmask', '1.1.1.1'),
('10.35.65.50', '10.0.0.0_8', 'IP Netmask', '10.0.0.0/8'),
('10.35.65.50', '10.1.0.0_16', 'IP Netmask', '10.1.0.0/16'),
('10.35.65.50', '10.1.0.0_24', 'IP Netmask', '10.1.0.0/24'),
('10.35.65.50', '10.1.0.11', 'IP Netmask', '10.1.0.11'),
('10.35.65.50', '10.1.0.27', 'IP Netmask', '10.1.0.27'),
('10.35.65.50', '10.1.0.41-44', 'IP Range', '10.1.0.41-44'),
('10.35.65.50', '10.1.0.52-53', 'IP Range', '10.1.0.52-53'),
('10.35.65.50', '10.1.10.39', 'IP Netmask', '10.1.10.39'),
('10.35.65.50', '10.100.0.0_16', 'IP Netmask', '10.100.0.0/16'),
('10.35.65.50', '10.100.1.43', 'IP Netmask', '10.100.1.43/32'),
('10.35.65.50', '10.100.10.0_24', 'IP Netmask', '10.100.10.0/24'),
('10.35.65.50', '10.100.10.202', 'IP Netmask', '10.100.10.202'),
('10.35.65.50', '10.100.10.204', 'IP Netmask', '10.100.10.204'),
('10.35.65.50', '10.100.10.205', 'IP Netmask', '10.100.10.205'),
('10.35.65.50', '10.100.10.237-240', 'IP Range', '10.100.10.237-240'),
('10.35.65.50', '10.100.10.243', 'IP Netmask', '10.100.10.243'),
('10.35.65.50', '10.100.11.0-24', 'IP Netmask', '10.100.11.0/24'),
('10.35.65.50', '10.100.11.16', 'IP Netmask', '10.100.11.16'),
('10.35.65.50', '10.100.13.15-32', 'IP Netmask', '10.100.13.15/32'),
('10.35.65.50', '10.100.14.0_25', 'IP Netmask', '10.100.14.0/25'),
('10.35.65.50', '10.100.14.9', 'IP Netmask', '10.100.14.9/32'),
('10.35.65.50', '10.100.15.0-24', 'IP Netmask', '10.100.15.0/24'),
('10.35.65.50', '10.100.23.1', 'IP Netmask', '10.100.23.1/32'),
('10.35.65.50', '10.100.23.4', 'IP Netmask', '10.100.23.4/32'),
('10.35.65.50', '10.101.0.0_16', 'IP Netmask', '10.101.0.0/16'),
('10.35.65.50', '10.102.0.0_16', 'IP Netmask', '10.102.0.0/16'),
('10.35.65.50', '10.102.1.0', 'IP Netmask', '10.102.1.0/24'),
('10.35.65.50', '10.102.1.1-254', 'IP Range', '10.102.1.1-254'),
('10.35.65.50', '10.102.1.102', 'IP Netmask', '10.102.1.102/32'),
('10.35.65.50', '10.102.1.108', 'IP Netmask', '10.102.1.108/32'),
('10.35.65.50', '10.102.1.113-117', 'IP Range', '10.102.1.113-117'),
('10.35.65.50', '10.102.1.121', 'IP Netmask', '10.102.1.121/32'),
('10.35.65.50', '10.102.1.125', 'IP Netmask', '10.102.1.125/32'),
('10.35.65.50', '10.102.1.200', 'IP Netmask', '10.102.1.200'),
('10.35.65.50', '10.102.1.209', 'IP Netmask', '10.102.1.209'),
('10.35.65.50', '10.102.1.45-220', 'IP Range', '10.102.1.45-220'),
('10.35.65.50', '10.102.14.0_24', 'IP Netmask', '10.102.14.0/24'),
('10.35.65.50', '10.102.14.70-71', 'IP Range', '10.102.14.70-71'),
('10.35.65.50', '10.102.20.0_24', 'IP Netmask', '10.102.20.0/24'),
('10.35.65.50', '10.102.20.11', 'IP Netmask', '10.102.20.11'),
('10.35.65.50', '10.102.21.0_24', 'IP Netmask', '10.102.21.0/24'),
('10.35.65.50', '10.102.22.0_24', 'IP Netmask', '10.102.22.0/24'),
('10.35.65.50', '10.102.23.0_24', 'IP Netmask', '10.102.23.0/24'),
('10.35.65.50', '10.102.3.0_24', 'IP Netmask', '10.102.3.0/24'),
('10.35.65.50', '10.102.3.10-150', 'IP Range', '10.102.3.10-150'),
('10.35.65.50', '10.102.3.121', 'IP Netmask', '10.102.3.121'),
('10.35.65.50', '10.102.3.18', 'IP Netmask', '10.102.3.18'),
('10.35.65.50', '10.102.3.233', 'IP Netmask', '10.102.3.233'),
('10.35.65.50', '10.102.3.235', 'IP Netmask', '10.102.3.235');

-- --------------------------------------------------------

--
-- Table structure for table `firewall_object_services`
--

DROP TABLE IF EXISTS `firewall_object_services`;
CREATE TABLE `firewall_object_services` (
  `ip` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `portname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `protocol` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `portaddress` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `firewall_object_services`
--

INSERT INTO `firewall_object_services` (`ip`, `portname`, `protocol`, `portaddress`) VALUES
('10.35.65.50', '1-19-tcp', 'TCP', '1-19'),
('10.35.65.50', '1-500-tcp', 'TCP', '1-500'),
('10.35.65.50', '1-500-udp', 'UDP', '1-500'),
('10.35.65.50', '1-65000-tcp', 'TCP', '1-65000'),
('10.35.65.50', '1-65000-udp', 'UDP', '1-65000'),
('10.35.65.50', '1-65535-tcp', 'TCP', '1-65535'),
('10.35.65.50', '1-65535-udp', 'UDP', '1-65535'),
('10.35.65.50', '1-8-TCP', 'TCP', '1-8'),
('10.35.65.50', '1-tcp', 'TCP', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `firewall`
--
ALTER TABLE `firewall`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `firewall_object_addresses`
--
ALTER TABLE `firewall_object_addresses`
  ADD KEY `select_idx` (`ip`,`address`) USING BTREE;

--
-- Indexes for table `firewall_object_services`
--
ALTER TABLE `firewall_object_services`
  ADD KEY `select_idx` (`ip`,`portaddress`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
