-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2016 at 10:00 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dps_patients`
--

-- --------------------------------------------------------

--
-- Table structure for table `prescriptiondetail`
--

CREATE TABLE IF NOT EXISTS `prescriptiondetail` (
  `slno` bigint(20) NOT NULL AUTO_INCREMENT,
  `id` bigint(20) NOT NULL,
  `patientid` varchar(50) NOT NULL,
  `ip_id` varchar(20) NOT NULL,
  `drugid` bigint(20) NOT NULL,
  `drugname` varchar(500) NOT NULL,
  `type` varchar(30) NOT NULL,
  `tablet` varchar(30) NOT NULL,
  `generic` varchar(30) NOT NULL,
  `brands` varchar(20) NOT NULL,
  `avail_quantity` varchar(20) NOT NULL,
  `order_quantity` varchar(20) NOT NULL,
  `dosage` varchar(25) NOT NULL,
  `specification` varchar(25) NOT NULL,
  `frequency` varchar(25) NOT NULL,
  `duration` varchar(25) NOT NULL,
  `route` varchar(25) NOT NULL,
  `prescribed_by` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`slno`),
  KEY `id` (`id`),
  KEY `patientid` (`patientid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
