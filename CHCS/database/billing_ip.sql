-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2015 at 12:48 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dps_patients`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_ip`
--

CREATE TABLE IF NOT EXISTS `billing_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `fees` varchar(20) NOT NULL,
  `pay` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `balance` tinyint(4) NOT NULL COMMENT '0 for no balance 1 for balance',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active 0 for non active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `patientid` (`patientid`),
  KEY `bill_no` (`bill_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `billing_ip`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
