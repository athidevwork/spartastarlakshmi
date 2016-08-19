-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2015 at 01:22 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dps_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `billing` tinyint(4) NOT NULL,
  `editbilling` tinyint(4) NOT NULL,
  `reports` tinyint(4) NOT NULL,
  `print_bill` tinyint(4) NOT NULL,
  `print_lab` int(11) NOT NULL DEFAULT '1',
  `print_request` tinyint(4) NOT NULL,
  `masterentry` tinyint(4) NOT NULL,
  `registration` tinyint(4) NOT NULL,
  `clinicalhistory` tinyint(4) NOT NULL,
  `patientinfo` tinyint(4) NOT NULL,
  `communication` tinyint(4) NOT NULL,
  `prescription` tinyint(4) NOT NULL DEFAULT '0',
  `lab` int(11) NOT NULL DEFAULT '0',
  `pharmacy` tinyint(4) NOT NULL DEFAULT '0',
  `activitychart` int(11) NOT NULL,
  `activitycharticu` int(11) NOT NULL,
  `clinicalchart` int(11) NOT NULL,
  `chartot` int(11) NOT NULL,
  `billing_ip` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `role`, `billing`, `editbilling`, `reports`, `print_bill`, `print_lab`, `print_request`, `masterentry`, `registration`, `clinicalhistory`, `patientinfo`, `communication`, `prescription`, `lab`, `pharmacy`, `activitychart`, `activitycharticu`, `clinicalchart`, `chartot`, `billing_ip`) VALUES
(2, 2, 1, 0, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1),
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1),
(3, 3, 1, 0, 1, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 1),
(4, 4, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1),
(5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1),
(6, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1),
(7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
