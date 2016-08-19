-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2015 at 06:26 PM
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
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch` int(11) NOT NULL,
  `doctor` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phono` varchar(25) NOT NULL,
  `patientid` varchar(30) NOT NULL,
  `time` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `appointby` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active 0 for non active',
  PRIMARY KEY (`id`),
  KEY `phno` (`phono`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `branch`, `doctor`, `name`, `phono`, `patientid`, `time`, `date`, `appointby`, `status`) VALUES
(2, 0, 'Dr.Arun', 'Test', '1/2015/mh', '1/2015/mh', '8:00:PM', '2015-11-26', 'chitra', 0),
(3, 0, 'dr.S.Ram', 'Magesh', '9789060461', '', '11:00:AM', '2015-11-26', 'chitra', 1),
(4, 0, 'Dr.S.Ram', 'NIRMALA', '9840053473', '', '11:00:AM', '2015-11-26', 'chitra', 1),
(5, 0, 'Dr.Arun', 'Samsuden', '9952096227', '', '11:00:AM', '2015-11-26', 'chitra', 1),
(6, 0, 'Dr.S.Ram', 'Haridoss', '9444469981', '', '12:00:PM', '2015-11-26', 'chitra', 1),
(8, 0, 'Dr.Arun', 'mary', '9176537103', '', '11:00:AM', '2015-11-26', 'chitra', 1),
(9, 0, 'Dr.S.Ram', 'prabha devi', '9840970436', '', '12:00:PM', '2015-11-26', 'chitra', 1),
(10, 0, 'Dr.S.Ram', 'jitendran', '9841800240', '', '12:00:PM', '2015-11-26', 'chitra', 1),
(11, 0, 'dr.Ram', 'aaa', '2222222224', '', '2:00:PM', '2015-11-26', 'admin', 1),
(12, 0, 'Dr.Bhavana', 'Mrs. Pavithra', '9176682171', '', '11:00:AM', '2015-11-27', 'chitra', 1),
(13, 0, 'Dr .S.Ram', 'Mrs.Kasuthri', '9790966095', '', '12:00:PM', '2015-11-27', 'chitra', 1),
(14, 0, 'Dr.Arun', 'Mrs.Mayilla', '9841617387', '', '12:00:PM', '2015-11-27', 'chitra', 1),
(15, 0, 'Dr.S.Ram', 'MrPrasanth', '9840790740', '', '12:00:PM', '2015-11-27', 'chitra', 1),
(16, 0, 'Dr.S.Ram', 'Mr.Kartthikayan', '9790705532', '', '12:00:PM', '2015-11-27', 'chitra', 1),
(17, 0, 'Dr.S.Ram', 'Mrs.Prabhadevi', '9840970436', '', '1:00:PM', '2015-11-27', 'chitra', 1),
(18, 0, 'Dr.S.Ram', 'Mrs.beelina', '600005520', '', '1:00:PM', '2015-11-27', 'chitra', 1),
(19, 0, 'Dr.S.Ram', 'sandeepgupta', '9841556648', '', '12:00:PM', '2015-11-28', 'nandhini', 1),
(20, 0, 'Dr.Arun', 'Final test', '14/2015/mh', '14/2015/mh', '10:00:PM', '2015-11-28', 'chitra', 0),
(21, 0, 'DR.s.RAM', 'navarathinam', '9840959577', '', '11:00:AM', '2015-11-29', 'nandhini', 1);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `patientid`, `bill_no`, `fees`, `pay`, `created_at`, `created_by`, `balance`, `status`) VALUES
(1, '1/2015/tes', '-1442903609', '1520', '1520', '2015-09-22 12:03:29', 'admin', 0, 1),
(2, '1/2015/tes', '-1443001639', '1550', '1550', '2015-09-23 15:17:19', 'admin', 0, 1),
(8, '5/2015/mh', '-1448530954', '100', '100', '2015-11-26 15:12:10', 'admin', 0, 1),
(7, '4/2015/mh', '-1448521700', '900', '900', '2015-11-26 12:37:56', 'admin', 0, 1),
(6, '3/2015/mh', '-1448520939', '1000', '1000', '2015-11-26 12:25:15', 'admin', 0, 1),
(9, '5/2015/mh', '-1448615978', '100', '100', '2015-11-27 14:49:14', 'admin', 0, 1),
(10, '5/2015/mh', '-1448622470', '100', '100', '2015-11-27 16:37:26', 'admin', 0, 1),
(11, '5/2015/mh', '-1448622689', '500', '500', '2015-11-27 16:41:05', 'admin', 0, 1),
(12, '1/2015/mh', '-1448622878', '100', '100', '2015-11-27 16:44:14', 'admin', 0, 1),
(13, '1/2015/mh', '-1448622904', '500', '500', '2015-11-27 16:44:40', 'admin', 0, 1),
(14, '1/2015/mh', '-1448622929', '500', '200', '2015-11-27 16:45:05', 'admin', 1, 1),
(15, '8/2015/mh', '-1448689114', '50', '50', '2015-11-28 11:08:10', 'admin', 0, 1),
(16, '9/2015/mh', '-1448689991', '100', '100', '2015-11-28 11:22:47', 'admin', 0, 1),
(17, '9/2015/mh', '-1448690007', '350', '0', '2015-11-28 11:23:03', 'admin', 0, 1),
(18, '9/2015/mh', '-1448690863', '0', '350', '2015-11-28 11:37:19', 'admin', 0, 1),
(19, '10/2015/mh', '-1448692103', '100', '100', '2015-11-28 11:57:59', 'admin', 0, 1),
(20, '10/2015/mh', '-1448692142', '100', '100', '2015-11-28 11:58:38', 'admin', 0, 1),
(21, '11/2015/mh', '-1448693358', '100', '100', '2015-11-28 12:18:54', 'admin', 0, 1),
(22, '12/2015/mh', '-1448694009', '195', '195', '2015-11-28 12:29:45', 'admin', 0, 1),
(23, '11/2015/mh', '-1448694680', '300', '300', '2015-11-28 12:40:56', 'admin', 0, 1),
(24, '14/2015/mh', '-1448723011', '800', '800', '2015-11-28 20:33:07', 'admin', 0, 1),
(25, '15/2015/mh', '-1448777517', '100', '100', '2015-11-29 11:41:33', 'admin', 0, 1),
(26, '16/2015/mh', '-1448785474', '100', '100', '2015-11-29 13:54:10', 'admin', 0, 1),
(27, '16/2015/mh', '-1448788518', '400', '400', '2015-11-29 14:44:54', 'admin', 0, 1),
(28, '16/2015/mh', '-1448788604', '100', '100', '2015-11-29 14:46:20', 'admin', 0, 1),
(29, '17/2015/mh', '-1448789200', '100', '100', '2015-11-29 14:56:16', 'admin', 0, 1),
(30, '17/2015/mh', '-1448789677', '300', '300', '2015-11-29 15:04:13', 'admin', 0, 1),
(31, '19/2015/mh', '-1448854690', '344', '344', '2015-11-30 09:07:46', 'admin', 0, 1),
(32, '20/2015/mh', '-1448862463', '100', '100', '2015-11-30 11:17:19', 'admin', 0, 1),
(33, '21/2015/mh', '-1448863258', '1470', '1470', '2015-11-30 11:30:34', 'admin', 0, 1),
(34, '20/2015/mh', '-1448864113', '300', '300', '2015-11-30 11:44:49', 'admin', 0, 1),
(35, '22/2015/mh', '-1448866306', '100', '100', '2015-11-30 12:21:22', 'admin', 0, 1),
(36, '22/2015/mh', '-1448870202', '109', '109', '2015-11-30 13:26:18', 'admin', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `billing_content`
--

CREATE TABLE IF NOT EXISTS `billing_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `fees` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bill_no` (`bill_no`),
  KEY `patientid` (`patientid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `billing_content`
--

INSERT INTO `billing_content` (`id`, `patientid`, `fees`, `description`, `bill_no`, `created_by`, `created_at`) VALUES
(1, '1/2015/tes', '520', 'Erythrocyte sedimentation rate (ESR)', '-1442903609', 'admin', '2015-09-22 12:03:29'),
(2, '1/2015/tes', '500', 'Blood Sugar', '-1442903609', 'admin', '2015-09-22 12:03:29'),
(3, '1/2015/tes', '500', 'l', '-1442903609', 'admin', '2015-09-22 12:03:30'),
(4, '1/2015/tes', '1550', 'Carboxyhemoglobin (carbon monoxide in hemoglobin)', '-1443001639', 'admin', '2015-09-23 15:17:19'),
(11, '4/2015/mh', '500', 'X-ray', '-1448521700', 'admin', '2015-11-26 12:37:56'),
(10, '4/2015/mh', '200', 'Iron', '-1448521700', 'admin', '2015-11-26 12:37:56'),
(8, '3/2015/mh', '700', 'X-ray', '-1448520939', 'admin', '2015-11-26 12:25:15'),
(9, '3/2015/mh', '300', 'consulting', '-1448520939', 'admin', '2015-11-26 12:25:15'),
(12, '4/2015/mh', '200', 'fee', '-1448521700', 'admin', '2015-11-26 12:37:56'),
(13, '5/2015/mh', '100', 'POTASSIUM', '-1448530954', 'admin', '2015-11-26 15:12:10'),
(14, '5/2015/mh', '100', 'x-ray', '-1448615978', 'admin', '2015-11-27 14:49:14'),
(15, '5/2015/mh', '100', 'register fees', '-1448622470', 'admin', '2015-11-27 16:37:26'),
(16, '5/2015/mh', '500', 'x-ray', '-1448622689', 'admin', '2015-11-27 16:41:05'),
(17, '1/2015/mh', '100', 'registration ', '-1448622878', 'admin', '2015-11-27 16:44:14'),
(18, '1/2015/mh', '500', 'lab', '-1448622904', 'admin', '2015-11-27 16:44:40'),
(19, '1/2015/mh', '500', 'physio', '-1448622929', 'admin', '2015-11-27 16:45:05'),
(20, '8/2015/mh', '50', 'Walk in - IV Injection', '-1448689114', 'admin', '2015-11-28 11:08:10'),
(21, '4/2015/mh', '100', 'lab', '-1448521700', 'admin', '2015-11-28 11:09:07'),
(22, '4/2015/mh', '100', 'reg fees', '-1448521700', 'admin', '2015-11-28 11:11:34'),
(23, '9/2015/mh', '100', 'Registration', '-1448689991', 'admin', '2015-11-28 11:22:47'),
(24, '9/2015/mh', '350', 'X-RAY', '-1448690007', 'admin', '2015-11-28 11:23:03'),
(25, '9/2015/mh', '0', 'old balance', '-1448690863', 'admin', '2015-11-28 11:37:19'),
(26, '10/2015/mh', '100', 'Registration', '-1448692103', 'admin', '2015-11-28 11:57:59'),
(27, '10/2015/mh', '100', 'Small Dressing Tray', '-1448692142', 'admin', '2015-11-28 11:58:38'),
(28, '11/2015/mh', '100', 'Registration ', '-1448693358', 'admin', '2015-11-28 12:18:54'),
(29, '12/2015/mh', '195', 'Pharmacy', '-1448694009', 'admin', '2015-11-28 12:29:45'),
(30, '11/2015/mh', '300', 'X-Ray Hand -AP / Obli', '-1448694680', 'admin', '2015-11-28 12:40:56'),
(31, '14/2015/mh', '500', 'X-ray', '-1448723011', 'admin', '2015-11-28 20:33:07'),
(32, '14/2015/mh', '300', 'cervical spine Ap lateral', '-1448723011', 'admin', '2015-11-28 20:33:07'),
(33, '15/2015/mh', '100', 'Registration ', '-1448777517', 'admin', '2015-11-29 11:41:33'),
(34, '16/2015/mh', '100', 'Registration Fee', '-1448785474', 'admin', '2015-11-29 13:54:10'),
(35, '16/2015/mh', '350', 'X-Ray Humer - AP / Lat', '-1448788518', 'admin', '2015-11-29 14:44:54'),
(36, '16/2015/mh', '50', 'Casuality (SDT + Gl)', '-1448788518', 'admin', '2015-11-29 14:44:54'),
(37, '16/2015/mh', '100', 'Small Dressing Tray', '-1448788604', 'admin', '2015-11-29 14:46:20'),
(38, '17/2015/mh', '100', 'Registration Fee', '-1448789200', 'admin', '2015-11-29 14:56:16'),
(39, '17/2015/mh', '300', 'X-Ray Foot AP/Lat', '-1448789677', 'admin', '2015-11-29 15:04:13'),
(40, '19/2015/mh', '100', 'Registration', '-1448854690', 'admin', '2015-11-30 09:07:46'),
(41, '19/2015/mh', '200', 'Observation', '-1448854690', 'admin', '2015-11-30 09:07:46'),
(42, '19/2015/mh', '44', 'Disposable', '-1448854690', 'admin', '2015-11-30 09:07:46'),
(43, '20/2015/mh', '100', 'Registration Fee', '-1448862463', 'admin', '2015-11-30 11:17:19'),
(44, '21/2015/mh', '100', 'Registration Fee', '-1448863258', 'admin', '2015-11-30 11:30:34'),
(45, '21/2015/mh', '1370', 'Lab - CBC, Uric Acid, RBS, HbA1c, CRP', '-1448863258', 'admin', '2015-11-30 11:30:34'),
(46, '20/2015/mh', '300', 'X-Ray - Foot AP / OBLI', '-1448864113', 'admin', '2015-11-30 11:44:49'),
(47, '22/2015/mh', '100', 'Registration Fee', '-1448866306', 'admin', '2015-11-30 12:21:22'),
(48, '22/2015/mh', '109', 'Casualty - Small Dressing + 100 Ml NS', '-1448870202', 'admin', '2015-11-30 13:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE IF NOT EXISTS `complaints` (
  `complaintid` bigint(20) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `symptoms` varchar(5000) NOT NULL,
  `maxid` int(11) NOT NULL,
  `prescribed_by` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`complaintid`),
  KEY `patientid` (`patientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaintid`, `patientid`, `symptoms`, `maxid`, `prescribed_by`, `datetime`) VALUES
(1, '1/2015/tes', 'nil', 1, 'admin', '2015-09-11 10:34:33'),
(2, '1/2015/tes', '<br />', 0, 'admin', '2015-09-22 11:56:25'),
(3, '', '<br />', 0, 'admin', '2015-09-22 15:19:22'),
(4, '1/2015/tes', '<br />', 0, 'admin', '2015-09-23 10:43:36'),
(5, '1/2015/tes', '<br />', 0, 'admin', '2015-09-23 14:03:37'),
(6, '3/2015/tes', 'loose stools<br />', 0, 'admin', '2015-10-05 13:17:06'),
(7, '4/2015/mh', '<br />', 0, 'admin', '2015-11-26 12:37:28'),
(8, '6/2015/mh', '<br />', 0, 'admin', '2015-11-26 15:05:35'),
(9, '14/2015/mh', '<br />', 0, 'admin', '2015-11-28 20:25:15'),
(10, '14/2015/mh', '<br />', 0, 'admin', '2015-11-28 20:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

CREATE TABLE IF NOT EXISTS `description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `pay` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `description`
--


-- --------------------------------------------------------

--
-- Table structure for table `due`
--

CREATE TABLE IF NOT EXISTS `due` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `billingid` varchar(20) NOT NULL,
  `payment` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active ',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `due`
--


-- --------------------------------------------------------

--
-- Table structure for table `investigationreport`
--

CREATE TABLE IF NOT EXISTS `investigationreport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `test` varchar(250) NOT NULL,
  `image` blob NOT NULL,
  `comment` varchar(5000) DEFAULT NULL,
  `complaint` varchar(5000) NOT NULL,
  `notes` varchar(5000) NOT NULL,
  `sub` int(11) NOT NULL DEFAULT '0' COMMENT '0 for no 1 for yes',
  `category` int(11) NOT NULL,
  `sendlab` int(11) NOT NULL,
  `bill_no` varchar(150) NOT NULL,
  `lab_atten_by` varchar(250) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL,
  `lab_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sendlab` (`sendlab`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `investigationreport`
--

INSERT INTO `investigationreport` (`id`, `patientid`, `test`, `image`, `comment`, `complaint`, `notes`, `sub`, `category`, `sendlab`, `bill_no`, `lab_atten_by`, `datetime`, `created_by`, `lab_date`) VALUES
(3, '1/2015/tes', '11', '', NULL, 'Something', '', 0, 2, 1, '-144568923', '', '2015-09-23 14:51:08', 'admin', '0000-00-00 00:00:00'),
(4, '1/2015/tes', '13', '', NULL, 'Pending', '', 1, 2, 1, '-1443001639', 'admin', '2015-09-23 14:55:07', 'admin', '2015-09-25 10:24:02'),
(5, '3/2015/tes', 'Ammonia', '', NULL, 'Pending', '', 0, 2, 0, '', '', '2015-10-05 13:17:07', 'admin', '0000-00-00 00:00:00'),
(6, '4/2015/mh', '29', '', NULL, 'Pending', '', 0, 2, 1, '-1448521700', '', '2015-11-26 12:37:28', 'admin', '0000-00-00 00:00:00'),
(7, '4/2015/mh', '13', '', NULL, 'Pending', '', 1, 3, 1, '-1448521700', '', '2015-11-26 12:37:28', 'admin', '0000-00-00 00:00:00'),
(8, '6/2015/mh', '50', '', NULL, 'Pending', '', 0, 2, 0, '', '', '2015-11-26 15:05:35', 'admin', '0000-00-00 00:00:00'),
(9, '6/2015/mh', '47', '', NULL, 'Pending', '', 0, 2, 0, '', '', '2015-11-26 15:05:36', 'admin', '0000-00-00 00:00:00'),
(10, '14/2015/mh', '13', '', NULL, 'Pending', '', 1, 3, 1, '-1448723011', '', '2015-11-28 20:25:15', 'admin', '0000-00-00 00:00:00'),
(11, '14/2015/mh', '14', '', NULL, 'Pending', '', 1, 3, 1, '-1448723011', '', '2015-11-28 20:27:21', 'admin', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `investigationsub`
--

CREATE TABLE IF NOT EXISTS `investigationsub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inves_id` int(11) NOT NULL,
  `sym_id` int(11) NOT NULL,
  `sub_cat` int(11) NOT NULL,
  `result` varchar(900) NOT NULL,
  `category` int(11) NOT NULL COMMENT '3 for sub cat 1 for no sub',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `investigationsub`
--

INSERT INTO `investigationsub` (`id`, `inves_id`, `sym_id`, `sub_cat`, `result`, `category`) VALUES
(1, 4, 24, 5, '15mm', 3),
(2, 4, 24, 6, '90mm', 3),
(3, 4, 27, 0, 'normal', 1),
(4, 4, 47, 0, '255cm', 1),
(5, 4, 51, 1, 'normal', 3),
(6, 4, 51, 2, '', 3),
(7, 4, 51, 3, '', 3),
(8, 4, 51, 4, '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `medicalhistory`
--

CREATE TABLE IF NOT EXISTS `medicalhistory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `diabetes` varchar(10) NOT NULL,
  `hypertension` varchar(10) NOT NULL,
  `coronary` varchar(10) NOT NULL,
  `asthma` varchar(10) NOT NULL,
  `cad` varchar(20) NOT NULL,
  `bloodgroup` varchar(25) NOT NULL,
  `medicalhistory` varchar(5000) NOT NULL,
  `familyhistory` varchar(5000) NOT NULL,
  `personalhistory` varchar(5000) NOT NULL,
  `psychiatrichistory` varchar(5000) NOT NULL,
  `allergies` varchar(250) NOT NULL,
  `prescribed_by` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patientid_2` (`patientid`),
  KEY `patientid` (`patientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `medicalhistory`
--

INSERT INTO `medicalhistory` (`id`, `patientid`, `diabetes`, `hypertension`, `coronary`, `asthma`, `cad`, `bloodgroup`, `medicalhistory`, `familyhistory`, `personalhistory`, `psychiatrichistory`, `allergies`, `prescribed_by`, `datetime`) VALUES
(1, '1/2015/tes', 'No', 'No', 'No', 'Yes', 'No', '', '', '', '', '', '', 'admin', '2015-09-23 00:00:00'),
(3, '', 'No', 'No', 'No', 'No', 'No', '', '', '', '', '', '', 'admin', '2015-09-22 00:00:00'),
(4, '3/2015/tes', 'Yes', 'No', 'Yes', 'No', 'No', '', '', '', '', '', '', 'admin', '2015-10-05 00:00:00'),
(5, '4/2015/mh', 'No', 'No', 'No', 'No', 'No', '', '', '', '', '', '', 'admin', '2015-11-26 00:00:00'),
(6, '6/2015/mh', 'No', 'No', 'No', 'No', 'No', '', '', '', '', '', '', 'admin', '2015-11-26 00:00:00'),
(7, '14/2015/mh', 'No', 'No', 'No', 'No', 'No', '', '', '', '', '', '', 'admin', '2015-11-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patientdetails`
--

CREATE TABLE IF NOT EXISTS `patientdetails` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `branch` varchar(50) NOT NULL,
  `patientid` varchar(50) NOT NULL,
  `patientsalutation` varchar(10) NOT NULL,
  `patientname` varchar(100) NOT NULL,
  `guardiansalutation` varchar(10) NOT NULL,
  `guardianname` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contactno` bigint(20) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` longblob,
  `reference` varchar(50) DEFAULT NULL,
  `time` date NOT NULL,
  `hold` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'o for non hold 1 for hold',
  `holdby` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patientid` (`patientid`),
  KEY `patientname` (`patientname`),
  KEY `contactno` (`contactno`),
  KEY `hold` (`hold`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `patientdetails`
--

INSERT INTO `patientdetails` (`id`, `branch`, `patientid`, `patientsalutation`, `patientname`, `guardiansalutation`, `guardianname`, `age`, `gender`, `contactno`, `occupation`, `address`, `email`, `image`, `reference`, `time`, `hold`, `holdby`) VALUES
(1, 'test', '1/2015/tes', 'Baby', 'test', 'Mr.', 'test', 1, 'Male', 1234567890, 'businessman', '', 'a@gmail.com', '', '', '2015-09-11', 0, ''),
(2, 'test', '2/2015/tes', 'Baby', 'xxx', 'Mr.', 'yyy', 25, 'Male', 9962002177, 'Employee', 'jj', 'mmm@gmail.com', '', 'jjj', '2015-10-05', 0, ''),
(3, 'test', '3/2015/tes', 'Baby', 'ts', 'Mr.', 'x', 3, 'Female', 7896541230, 'Employee', 'hhhg', '', '', '', '2015-10-05', 0, ''),
(4, 'test', '4/2015/tes', 'Miss.', 'xxx', 'Mr.', 'ccc', 21, 'Female', 26472695, 'Student', '32 new street,\r\nayanavaram,\r\nch - 23', 'ffff@gmail.com', '', '', '2015-10-12', 0, ''),
(5, 'test', '5/2015/tes', 'Baby', 'nn', 'Mr.', 'mm', 5, 'Female', 9176692193, 'business', 'no 32 new street,\r\nayanavaram''\r\nch - 23', 'ffff@gmail.com', '', 'aa', '2015-10-12', 0, ''),
(6, 'test', '6/2015/tes', 'Baby', 'vino', 'Mr.', 'raja', 4, 'Female', 9999999999, 'Others', 'aaaaa', 'vino@gmail.com', '', '', '2015-11-25', 0, ''),
(7, 'MH', '1/2015/mh', 'Mr.', 'Test', 'Mr.', 'xxx', 32, 'Male', 9884123456, 'Employee', 'Kilpauk', 'xxx@gmail.com', '', '', '2015-11-25', 0, ''),
(8, 'MH', '2/2015/mh', 'Mrs.', 'anitha', 'Mr.', 'raja', 23, 'Male', 1111111111, 'Engineer', 'trt55t', 'z@gmail.com', '', '', '2015-11-26', 0, ''),
(9, 'MH', '3/2015/mh', 'Mr.', 'samsuden', 'Mr.', 'shahul', 20, 'Male', 9952096227, '', 'no.165,7th st,new nagar,vyasarpadi,ch-39', '', '', '', '2015-11-26', 0, 'chitra'),
(10, 'MH', '4/2015/mh', 'Mr.', 'admin test', 'Mrs.', 'vvv', 32, 'Male', 1234567891, 'Engineer', 'njhh', 'jjj@gmail.com', '', '', '2015-11-26', 0, ''),
(11, 'MH', '5/2015/mh', 'Miss.', 'aaa', 'Mr.', 'ssss', 34, 'Male', 223455656, 'Employee', 'fgfgffg', '', '', 'ff', '2015-11-26', 0, ''),
(12, 'MH', '6/2015/mh', 'Mr.', 'Arun', 'Mrs.', 'Arun', 34, 'Male', 9840717032, 'Others', 'kilpauk', '', '', '', '2015-11-26', 0, ''),
(13, 'MH', '7/2015/mh', 'Miss.', 'iiii', 'Mr.', 'nnnn', 34, 'Female', 65352522, '', 'fgg', '', '', '', '2015-11-27', 0, 'chitra'),
(14, 'MH', '8/2015/mh', 'Mr.', 'Ayueesh', 'Mr.', 'Ayueesh', 25, 'Male', 1111111111, 'self', 'chennai', '0', '', '', '2015-11-28', 0, ''),
(15, 'MH', '9/2015/mh', 'Miss.', 'hemalatha', 'Mr.', 'murukesh', 16, 'Female', 9003176145, 'business', 'no.45,southmada st,\r\nvillivakkam,chennai-49', '', '', '', '2015-11-28', 0, 'nandhini'),
(16, 'MH', '10/2015/mh', 'Master', 'praveen', 'Mr.', 'venkateshan', 5, 'Male', 9940959853, 'farmer', 'no.180,periyaobulapuram post,\r\ngummidipoondi,\r\nthiruvallur dt-6001 201.\r\n', '', '', 'DR.ARUN', '2015-11-28', 0, 'nandhini'),
(17, 'MH', '11/2015/mh', 'Mr.', 'rajesh', 'Mr.', 'vartharajan', 26, 'Male', 9952014459, 'Employee', 'no.36, balaammal st,\r\nbavani nagar,iappaakam,\r\nchennai-77.', '', '', 'DR.Ram', '2015-11-28', 0, 'nandhini'),
(18, 'MH', '12/2015/mh', 'Mr.', 'Sandeep', 'Mr.', 'Sandeep', 40, 'Male', 111111111111, 'Business', 'Chennai', '', '', '', '2015-11-28', 0, ''),
(19, 'MH', '13/2015/mh', 'Mrs.', 'hraaa', 'Mr.', 'drsss', 26, 'Female', 996204072, 'House Wife', 'nghrftrsdsfhhjy', '', '', 'DR.ram', '2015-11-28', 0, 'nandhini'),
(20, 'MH', '14/2015/mh', 'Mrs.', 'Final test', 'Mr.', 'dddd', 56, 'Female', 9962002188, 'Employee', 'xxxx', 'll@gmail.com', '', '', '2015-11-28', 0, 'chitra'),
(21, 'MH', '15/2015/mh', 'Mrs.', 'navarathinam', 'Mr.', 'sureshbabu', 65, 'Female', 9840959577, '', 'no.2,sylvan lodge colony,\r\n1st st kilpauk ,\r\nch-10', '', '', 'DR.ram', '2015-11-29', 10, 'nandhini'),
(22, 'MH', '16/2015/mh', 'Mrs.', 'jhansi rani', 'Mr.', 'runish', 22, 'Female', 9677139621, '', 'no.5113,h block ,\r\n1st st,12th main raod,\r\nanna nagar,\r\nch-40.', '', '', 'DR.ARUN', '2015-11-29', 10, 'nandhini'),
(23, 'MH', '17/2015/mh', 'Mr.', 'anand sha', 'Mrs.', 'sherya', 30, 'Male', 9840829779, '', 'no.6a,harlis road,kilpaukraod,\r\nch-10.', '', '', 'DR.ram', '2015-11-29', 10, 'nandhini'),
(24, 'MH', '18/2015/mh', 'Mr.', 'Software Testing', 'Mr.', 'Software Testing', 25, 'Male', 8888888888, 'Testing', 'test', '', '', '', '2015-11-29', 0, ''),
(25, 'MH', '19/2015/mh', 'Baby', 'SHRUTHI', 'Mr.', 'VETRISELVAN', 2, 'Male', 9941575116, 'Others', '31, vellivetti thali, Kilpauk garden road, chennai 600 010', '', '', '', '2015-11-30', 0, ''),
(26, 'MH', '20/2015/mh', 'Mrs.', 'HARSHA', 'Mr.', 'MITESH', 52, 'Male', 9884099021, '', 'no.7,arvamuthu garden st,\r\nch-8', '', '', 'DR.ARUN', '2015-11-30', 10, 'nandhini'),
(27, 'MH', '21/2015/mh', 'Mr.', 'MAGAL JAIN', 'Mrs.', 'KAVITHA', 40, 'Male', 7871153959, '', 'NO.16/13-NANCY ST,\r\nPURASIWALKAM,\r\nCH-7.', '', '', 'DR.ram', '2015-11-30', 10, 'nandhini'),
(28, 'MH', '22/2015/mh', 'Mrs.', 'MARY', 'Mr.', 'NATARAJAN', 47, 'Male', 9841189770, '', 'NO.5,KANDHASWAMY ST,\r\nMANALI,\r\nCH-68.', '', '', 'DR.ARUN', '2015-11-30', 10, 'nandhini');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptiondetail`
--

CREATE TABLE IF NOT EXISTS `prescriptiondetail` (
  `slno` int(11) NOT NULL AUTO_INCREMENT,
  `id` bigint(20) NOT NULL,
  `patientid` varchar(50) NOT NULL,
  `drugname` varchar(500) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prescriptiondetail`
--

INSERT INTO `prescriptiondetail` (`slno`, `id`, `patientid`, `drugname`, `dosage`, `specification`, `frequency`, `duration`, `route`, `prescribed_by`, `datetime`) VALUES
(1, 1, '1/2015/tes', 'Cap. 108', '100', 'After food', '1-0-0', '1 days', 'Oral', 'admin', '2015-09-11 10:27:36'),
(2, 1, '1/2015/tes', 'Tab. ABATE', '100', 'After food', '1-0-1', '1 days', 'Oral', 'admin', '2015-09-11 10:27:36'),
(3, 2, '3/2015/tes', 'Tab. 108', '50', 'After food', '0-0-1', '5 days', 'Oral"', 'admin', '2015-10-05 13:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(25) NOT NULL,
  `scan_image` blob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `record`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_diagnosis`
--

CREATE TABLE IF NOT EXISTS `tbl_diagnosis` (
  `complaintid` bigint(20) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `provisionaldiagnosis` varchar(5000) NOT NULL,
  `diagnosis` varchar(5000) NOT NULL,
  `prescribed_by` varchar(50) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`complaintid`),
  KEY `patientid` (`patientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_diagnosis`
--

INSERT INTO `tbl_diagnosis` (`complaintid`, `patientid`, `provisionaldiagnosis`, `diagnosis`, `prescribed_by`, `datetime`) VALUES
(1, '1/2015/tes', 'fever<br />', '<br />', 'admin', '2015-09-11 00:00:00'),
(2, '3/2015/tes', 'cdced<br />', '<br />', 'admin', '2015-10-05 00:00:00'),
(3, '6/2015/mh', 'TYPHOID<br />', '<br />', 'admin', '2015-11-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tempimg`
--

CREATE TABLE IF NOT EXISTS `tempimg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` longblob NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tempimg`
--

INSERT INTO `tempimg` (`id`, `image`, `status`) VALUES
(1, 0x89504e470d0a1a0a0000000d4948445200000212000002120803000000aee3d68d0000001974455874536f6674776172650041646f626520496d616765526561647971c9653c0000032269545874584d4c3a636f6d2e61646f62652e786d7000000000003c3f787061636b657420626567696e3d22efbbbf222069643d2257354d304d7043656869487a7265537a4e54637a6b633964223f3e203c783a786d706d65746120786d6c6e733a783d2261646f62653a6e733a6d6574612f2220783a786d70746b3d2241646f626520584d5020436f726520352e302d633036302036312e3133343737372c20323031302f30322f31322d31373a33323a30302020202020202020223e203c7264663a52444620786d6c6e733a7264663d22687474703a2f2f7777772e77332e6f72672f313939392f30322f32322d7264662d73796e7461782d6e7323223e203c7264663a4465736372697074696f6e207264663a61626f75743d222220786d6c6e733a786d703d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f2220786d6c6e733a786d704d4d3d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f6d6d2f2220786d6c6e733a73745265663d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f73547970652f5265736f75726365526566232220786d703a43726561746f72546f6f6c3d2241646f62652050686f746f73686f7020435335204d6163696e746f73682220786d704d4d3a496e7374616e636549443d22786d702e6969643a30443243334444313441383331314531423437414343453934383341323634462220786d704d4d3a446f63756d656e7449443d22786d702e6469643a3044324333444432344138333131453142343741434345393438334132363446223e203c786d704d4d3a4465726976656446726f6d2073745265663a696e7374616e636549443d22786d702e6969643a3044324333444346344138333131453142343741434345393438334132363446222073745265663a646f63756d656e7449443d22786d702e6469643a3044324333444430344138333131453142343741434345393438334132363446222f3e203c2f7264663a4465736372697074696f6e3e203c2f7264663a5244463e203c2f783a786d706d6574613e203c3f787061636b657420656e643d2272223f3e6636984700000180504c5445ebebec9c9d9f999a9c9b9c9ee3e3e498999bdbdbdcf4f4f4cbcbccc2c2c3919294fafafaa7a8a9d5d5d6d1d1d2b5b5b6b5b6b8abacadb8b8bab3b4b4bababca8aaabb7b8b8b5b6b6a1a2a4b9bababcbcbebebebebfbfc0bbbcbccececed0d0d1c8c9cad8d8d9d4d4d5a8a9aaaaabacc5c6c6a6a7a8a9aaaba5a6a7d2d3d3adaeb0a4a5a6b4b4b5adadaeb6b6b7acadaea5a6a8adaeafaeafb0aeaeafb0b0b1b3b3b4afafb0afb0b1b2b2b3b1b1b2a3a4a6a3a4a59e9fa1a9a9abaaaaac9d9ea0a7a7a9acacada2a3a59a9b9db8b8b9a2a3a4a4a5a797989aa8a8aaababaca0a1a2bcbcbca1a2a3a6a6a8a0a1a3b1b2b3b0b1b2b1b2b2b2b3b39fa0a29fa0a1b4b5b5bababbb7b7b8b0b1b1b2b3b4b8b8b8959698969799b6b7b7b8b9b9bdbdbd959799949698bababa939597949597b9b9ba9e9fa0babbbbbbbbbc9a9c9d93949697999b96989a929496bcbcbd929396919395909194909193acadafd6d7d7dededeafafb1bdbebfc0c0c1e0e1e1b3b3b5e6e6e6e8e9e9efefef9e9ea0ffffffdfdbd1a0000013824944415478daecdded7b13c7b980f1a5d5d14aac6da06e4d2958968c65e2229b5a36762124400f254d69023d8d93505204e52da5c5d053294895b7f3af77b5926cadb1bd6bbdedcc3ef7fd2d5f722df877cd3c332b644b1105b2f82b204810240812040982044182204190204810240812040982044182204190a0bd1cd72b95ee948284c86cd76da6d3854c26f3e2c5e35677bafdf9cff5b4030939ab41a356cb648a2f7adb2fc2eb5ef25158e22178ebc1f9bf7a9df37a112662666626f128c49268ce65bfeef4d7e3889899f926e12804af126e21db9708af44a3903d4bd89e8a3e4478d5539030f6a7deacb56b7ac7c98355f421c22b6f41c2bce9d1aae5ee797ddf533133e9e1082efb3bf37d88f0aa3a90306a71982cde6bf77da057adbe3e9f2934bc35c375bd35642e93e94bc4377f99dd818429ab43a1cbe11011fd9e358222bcf23624f45f1e52b97bbd8d54c4cacaf73b90d0fb4f53286edf1ba708af9c03096db78bc9faf6f6d845acac5cb020a1a387e652657b3b16115e354868f787a8562a318a48d8e6613e09b75aafc42c626525eb424297f345ad58a9c42fe2ecd9571624b4182072958a1e22bc5290887d81686f18ba8838752a05897817887ca5a2978853a7a62011df0291ae57f41391141306927073958a96221262c23812cd62455b11c930611609a796ade82c221133a64924ecea07207413910413964120ce57f417b1b5e542626c20cc10b175ce86c498401822626b2b0b89d10f95e9f31d11f95cba66b9babcd7385844a93409891157cb7a2072d59adb5e91dd62456f11a5d20e2446fa80995ccdb20fb8a7d25744e9850389518e1181ff58aa1820a254ca40625c3345c50c11666f1d069168d68d1151aa389018fd0692ab9823a2544a43628c7b8609224a8f1d488c34b7689888d274779970ad4227cb82c468960833444c7bcb84d39ccf5e6df5d0ebff5a6dcfd55c480c7b893044c4f4f45ce66aa75d11bf6eb53dd784c48097971523455cbd7ab088567f997721d1ffa6914b9e88fb5ec51424fadc34b2c91471ff8f7f9c4d4162f04d234922bcbe4f41e2b89bc652a2455cbb76ad6841e258f795f9a48bf0d2f0df9ceb4bc2ce0a1071edda4a1312116bca1071edc1030b12d14454a488789083042202221e3cb021115e5592886f0b90404440c4b76721818880886fbf6d40e2e852d244ac5f8004936540c4faba0b09440444ac2f41e2883b4b8922d64f4142fa2df63e11ebeb0d481cf6ee332f53c47a1e1287b42454c4faba0d8948c74f392236d39088325a0a12b1790e12070d1245b92236375d48840e12b2446c2e41e2c327112d42a39d431b124e5db488cd4d0b12fb4a0b17b19983443057ba888d122482e5a48bd8d86842e2d0f79f32456ce420d15b1111daec1c96768b845411daec1c966e8b845c11baec1c96668b844c11b9528bc434240e582484ae1169f7fcc646b9dc8444a79af85d23ab9c5cb95cce41a2539d39a2757d5b2e3f864427446cb47e0c8de9b20b890009c12236fc57e3eef414247a2fb3258b2897fd8f68bbef21d14342b688f2b4bf67b8362476490817d135c12ab14b42bc8872f9bd03891e1288f0ca43628f04225aad552111208188b5350b123d2410e175c781c42e0944f81521d179c78188b54e1624fc10d115b136e340a21522baadae5621f10109d922561fda90d84742b888d5d534248224c48b58cd42422917117b22561f4242a92622f644acae4242a91a227a442cdb90509388e811b16c4142e510d1230212bb2410d1160109af3c227a4440a2732d8188ae88e52a2414227a4540c22781883d1190689140448f08487821a2570424f693102fe20a24948d885e119050ca4544af08480448200212411288804490042220112481084804492002124112888044900422badd86847f5585885d1190f02fb411b127e27603120a11bd226ef3a92aa510d12b02121d1288e88a3803099f0422764540c22781883d1190689140448f08487821a25704247a482002129d3288e81171c681448704223a2948b449200212411288804490042220112481084804aa21a2a71548744820a2531d126d12888044900422ba7d0e09af0622f64440a2958b883d119f1721d12681888e88cf2721e193404457c402247c1288d81501093f44ec8980c48724848b586840621f09e922162c48044988170189f6ab5044ec8a804490042220112481082f0509af25442c4022501a11903880042220d1f3761c11bbd521e1bfe4400424f6934044b70b90f04920a2dba74548f821a22be2d34948744920c21701895d1288688b8044f7461b111d119fa6201124215ec4250b127e3944744440a27ba38d888e884b36247a4820c24b41c22f85888e084874af2f11d1115186c42e0944f85d804427445c8244304474ca43a2531d11ed2621d1bdbe440424f65d5f22a25d0a12ddbb2a44b4b320d1a98188762e24ba4f81884bba5c5e6a42c24684df2790d80d11be880b90d8ed1e223c1190e8298f084fc427f390d8ad8a884f20113c8522a2d50e24f61e03115e176d48ece620c213b1aa20b1571111172f6621f1c19143b6888bf390e8798c22222e5ecc335e766eb3abec1abe88568fe75de9249c749dc9724f44abe99a68128d7b9c3ef789b878f177ff4e8925e1e4b9a13a408457d69149c2be878883454c4cdc71249240c4e122e234111f09a78e88c3457826e491c821e228111313396924761071b48889095718893a2242444cbc97452285883011712d137191c8232254c4445e12091b11e1226e2d3b82483410112ee2d6ad94201279444410712b2f880422a288b8755f0e090b1151442c2eda624834101149c4e28e181255444412b1b82486441e1191442ce6c590a823229288c58a181288882662f1be14120e22a289585c9442c242444411924820229288382e26622281886822e2b8988885440a11114588219146444411324920e208115f48248188a3444824818823457c5110470211478bf862491a09448488f8481a0944848990460211a12284914044b808592410114184281288882242120944441221880422a289904302111145c822818808224491404414119248202292888f52624820229a888fa4bc1cb710115184501288385cc45d47080907111145dc55424828444414715a0c893c222289b85b17436212119144dc95f3fd12294444127157ceb7d0b8888824e2b21243427d8d8828224e0b2231858808222e6704914821228288cb3b82483888882062410922a13288081571b9288a440a11a1222ea744917010112a62538922a1e6101122e2f2923012162242445cb685915059441c2da2aea4914821e24811f15c4ac44a42551071948859258f440a114788886d91889344679940c48122625b2462259142c4a122e25b246225d13a7420e2601175259384858843442cd84249a849441c2822ae8b4b0d48388f11719088d34a2c09b5838803445c76059350f388f85044414926e16411b15fc4ac124d42b977101114b1e90827a12c4404442cb84a3a099542446f2905095540c45e350509af3944e823420f12aa86086d44684242a510d19a2c771424f6cea2df20e2b4ab20d17b6795912e22e32848046b6e4b16b1b9a3cbcf412312ca296cef895829ac24fc9bc9967a446cd6f4f931e844a2b552e4667d11f582a38ac95e238acace6cb63d647674fa196846a2b5565856fba10ac9de35fc75c1d9d9d9d1ed07a01f89bd474bf61c616bfbf7ae2f09b59264119b0a12c72f9fe4b3460612fd5c7327f9f49982443f379a49be8f7020d14faf922b625641a29f72c9bdb32c40a2bf8babe4de62bb90e82fbe990c12fb8fa1497dd39581449f3592faee730712fdbeef48a88805058901778ea47d3ea2088901778ec47d62260589c1768ec489d07adfd09d446be748dea7ea32901868e748e0e72c5d480cd256023f79ab2031d07b8ee47d3a7f0912833d60f2fe959f0d89c13a973411750589c14a274cc4e51a2406bd9a4898884b0a12030f988912717d0a12833f62a2445cb7213178e79324a2ae2031841bcc0489b8be038961544a8e88530a12c3a89a1811d76b9018ce39b49414113f28480ce91c9a1011d7ab9018527642445c722031e465c27011fa5f531944c24e84082316095348f8cb84e922cc58248c2161274084198b84312454ce7811862c12e690b08d1761c822610e0955355c84091797869170ae9a2de20705896197365ac4c729480cbf3b268b78a52031fc9a068bf8d885c428ca9a2b22a320319283a8b1224c39801a4742550d15f1714d41624407d1193345bc529018d9e31a29c2a0d9d23c12aa68a288290589116e1dbf364fc49682c4482f278c1361d6b6612089f6d6619288290589d16f1d2689d8529018f9231b25e2920b89d1376590888fab0a126368db1c117505897164df3745c4860389319d440d11f1b1ab2031b671c20811550589b175cf041145058931de4e5cd35fc496038971e66a2fe292ad2031d61a9a8b3072b4349b849ad45b444d4162ec65741691519088a1597d45141524623976ccea2ae29582448c26341461e8f13309245a23a686228cfbd44cb248e82802127192d052c46f20112f09fd4440225e121a8a8044ac2474140189384968290212da90d04504247421a18d08486842421f1190d08384462220a105099d44fc16121a90d04a04243420a1970848c44f42331190889d846e2220113709ed4440226612fa898044bc24341401895849e82802127192d052c4cf21113309ed4440226612fa898044bc24341401895849e82802127192d0520424b421a18b0848e842421b1190d084843e2220a107098d4440420b123a89f803243420a19508486840422f1190889f84662220113b09dd4440226e12da898044cc24f4130189784968280212b192d051c41fe620115bf35a8af812123193d04e04246226a19f0848c44b4243119088292735f7424f115f7ef930d380c4b89f7bf29c9e9365b7dffffef1dc0e24c6949bbea0e70d554044abc5f3932e24469c9d2e96f57caf718088567ffa55366d4362541c6af92d3d3f1f718408bf33d9860389e1cf92e7f4fc9c6504115e5f7d753f6f080b234858735febf9ef358e21c26f66ae0989c167c9c90b7afebbcf3e447cf5d58d1b372a93162406385a1437f5fcb680fe45b4ba5bd179e2d49684ddc89cd5f35b870616e1b7904d3b90883e4b36e7ceeaf9ed85431371e3c6cb972f1f683971ea47c29a7ba5e7b7200f5dc4cb97376fde5cc9352171e42c59d7f3b7298c4c84df2fb49a38f579166f965cd7f377f08c5a44abebbf98b421119c25d7f5fc5d7e6312e1f7333daebee327e134332b7afe4ee0318bb879f3c489133fc43f71c64ca239a7ed6f928f4584df0ff14e9c3192b026eb673a21a24784dfe9794b18096f967c70e60c220e13d1eab7afe66d2124bc59b28703220e1171e2c75ebf8b61e21c3389d62c79fbf619444413e1572e8e77e2b4c6c9616afb762b441c47449bc51827ce7191b0aad92b57ae20a23f117f6b55ca598921e1cd9257fc10318088fff5faf2a74b96f124ec46f1fe952b88188a08bf89fa8827ce5192701a996f9697af20629822da2c4639715a239c25975b2162f822fcfe556c1a44c29b25973b216244227ed4eadfa39838ade1cf92d9d5e565448c4344ab3f9d1bf6c439d4ff9d9d2e3e5c5d45c41845f82dd60bb68624ec466666d50f116316d1ea7f7e55ac391a91f066c9ca6a3744c421c2ef4cb1a60509ab5a595b5b4344fc22fc1e669a7192709bd5ec9a1f223411e1f5f71b8f33353b0612de41737aad1b223412d1eab3cffef3937e970babbf9345beec85087d45f8fde727fd9c44ac3e3cbc2f9711618008bfcf0bce884934f3e53222cc11f1d967fff8c7fbe6e84838e9c765449826c2eb7a6134249c6aa98c0813457cf7dd77c740119d44e3c506224c15d142d11c320937bb8108934578cdd8c32451dd4084e9229e3cb959181a09278b880488f09a718643c22d212219229e3c59b08641a2b18188a48878f2e484353809442449c4a3478f0a83924044c244849ab010214dc4a347b541483411913c118f8e9e272cce1ae24478269c7e4938e7119144114f9ffeac5f1239442453c4d3a799fe4834119154114f9f36fb21e194109158114f7fd30f891c22922be288ade370121622922ce2f98fed6393c82222c9229e3faf1c97848588648b78fedc3e26892c22122ee2b065e230121622922ee2b065c20a5d2410915411872c138790b011917c11cffee61c83c41422922fe2d9b3a963909846840011cf2e4627d144840411cf9e599149e4102142c4b36c6412d3881021e2d9cfa392682242868803770eebd07d03110244bcce4724f118114244bc9e8846c245841411af5f3b9148a4112146c4eb5a241279448811f13a1b8904df672947c401c3c401246c44c811f1fa7514120d440812f1261581c4142204897833178104df942e49c49bd90824102149c49b8970123622248978f3269c8485085122de58a124aa881025e24d2d94c41422448978930f2591458428116f674349dc418428116f7f194a0211b244bcfd5118091711b244bc7d1b46c2428430116fad10120d440813f1361542a28a086122de5643484c21429888b7f910125944081311850422448978f7cb10123388102622940422a489082581086922debd8b4a021152448490b010214e444412889023e29d13850422048978978a40021192449c3c9a441511e244442081085922c249204298889373212410214dc4c9fcd12410214e4408890c22c48908219145843811d148204290884824102149441412881025e2e4ab5012889025e2e4bfc248204298885012889026228c0422c48988420211a244442081085922c249204298881012889027228c0422c489f8e7d12410214fc4714820428488639040840c11ffbc129504228488f8ffa824102145440889078810272284441d11e24444db38102148c43e12ff1560007b0adf6d9782bae50000000049454e44ae426082, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
