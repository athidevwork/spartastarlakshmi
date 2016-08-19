-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2015 at 11:07 AM
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
-- Table structure for table `fees_detailsip`
--

CREATE TABLE IF NOT EXISTS `fees_detailsip` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `fees_detailsip`
--

INSERT INTO `fees_detailsip` (`id`, `bill_number`, `patient_id`, `pat_name`, `ip_id`, `description`, `fees`, `paid_status`, `insert_id`, `insert_from`, `created_date`) VALUES
(9, '-1449580706', '2/2015/tes', 'xxx', 'MHIP-00002', 'dasdas', 2323.00, 1, 0, '', '2015-12-08'),
(10, '-1449580710', '2/2015/tes', 'xxx', 'MHIP-00002', 'dsads', 2323.00, 1, 0, '', '2015-12-08'),
(8, '-1449580351', '2/2015/tes', 'xxx', 'MHIP-00002', 'dsdfds', 200.00, 1, 0, '', '2015-12-08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
