-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2015 at 06:53 PM
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
-- Table structure for table `procedure_details`
--

CREATE TABLE IF NOT EXISTS `procedure_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(50) NOT NULL,
  `insert_from` varchar(50) NOT NULL,
  `procedure_id` varchar(50) NOT NULL,
  `ip_no` varchar(100) CHARACTER SET utf8 NOT NULL,
  `procedure_name` varchar(50) NOT NULL,
  `patient_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `duration` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `given_details` varchar(50) NOT NULL,
  `total_count` int(11) NOT NULL,
  `consultant` varchar(100) CHARACTER SET utf8 NOT NULL,
  `fees_amount` double(10,2) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `procedure_details`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
