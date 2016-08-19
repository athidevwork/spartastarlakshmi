-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2015 at 01:15 PM
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
-- Table structure for table `lab_details`
--

CREATE TABLE IF NOT EXISTS `lab_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(100) NOT NULL,
  `patientname` varchar(100) NOT NULL,
  `investigation` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  `report` varchar(100) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lab_details`
--

INSERT INTO `lab_details` (`id`, `patient_id`, `patientname`, `investigation`, `details`, `report`, `notes`, `create_date`) VALUES
(1, '2/2015/tes', 'xxx', 'Blood', 'Potassium', 'ewrwer', 'rtyrtyrt', '2015-12-04'),
(2, '2/2015/tes', 'xxx', 'Blood', 'Phosphorus', 'hgghjgh', 'rtyrty', '2015-12-04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
