-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 13, 2015 at 11:31 AM
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
CREATE DATABASE `dps_patients` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dps_patients`;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
