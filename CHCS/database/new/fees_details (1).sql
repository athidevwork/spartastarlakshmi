-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2015 at 11:08 AM
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
-- Table structure for table `fees_details`
--

CREATE TABLE IF NOT EXISTS `fees_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_number` varchar(100) NOT NULL,
  `patient_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pat_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ip_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `fees` double(10,2) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `insert_id` int(11) NOT NULL,
  `insert_from` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fees_details`
--

INSERT INTO `fees_details` (`id`, `bill_number`, `patient_id`, `pat_name`, `ip_id`, `description`, `fees`, `paid_status`, `insert_id`, `insert_from`, `created_date`) VALUES
(1, '', '3/2015/tes', 'ts', 'MHIP-00003', 'fesss', 145.00, 0, 0, '', '2015-12-09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
