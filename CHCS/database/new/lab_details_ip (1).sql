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
-- Table structure for table `lab_details_ip`
--

CREATE TABLE IF NOT EXISTS `lab_details_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(50) NOT NULL,
  `bill_number` varchar(100) NOT NULL,
  `lab_id` int(50) NOT NULL,
  `lab_det` varchar(50) NOT NULL,
  `lab_full_det` varchar(50) NOT NULL,
  `fees` double(10,2) NOT NULL,
  `created_date` date NOT NULL,
  `paid_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lab_details_ip`
--

INSERT INTO `lab_details_ip` (`id`, `patient_id`, `bill_number`, `lab_id`, `lab_det`, `lab_full_det`, `fees`, `created_date`, `paid_status`) VALUES
(6, '2/2015/tes', '-1449580763', 0, 'Blood', '48', 1212.00, '2015-12-08', 1),
(7, '2/2015/tes', '-1449580763', 0, 'Blood', '48', 3434.00, '2015-12-08', 1),
(4, '2/2015/tes', '-1449580763', 0, 'Blood', '3', 500.00, '2015-12-08', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
