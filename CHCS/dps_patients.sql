-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2016 at 06:08 PM
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `ip_id` varchar(20) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `advance_amount` varchar(10) NOT NULL,
  `old_balance` varchar(10) NOT NULL,
  `fees` varchar(20) NOT NULL,
  `pay` varchar(20) NOT NULL,
  `bal_amt` double(10,2) NOT NULL,
  `advance_balance` varchar(10) NOT NULL,
  `return_amt` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `balance` tinyint(4) NOT NULL COMMENT '0 for no balance 1 for balance',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active 0 for non active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `patientid` (`patientid`),
  KEY `bill_no` (`bill_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `billing_content_ip`
--

CREATE TABLE IF NOT EXISTS `billing_content_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `ip_id` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `fees` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_status` int(11) NOT NULL,
  `lab_details` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bill_no` (`bill_no`),
  KEY `patientid` (`patientid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `billing_content_patient`
--

CREATE TABLE IF NOT EXISTS `billing_content_patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `fees` varchar(20) NOT NULL,
  `lab` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `balance_amt` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(30) NOT NULL,
  `balance` tinyint(4) NOT NULL COMMENT '0 for no balance 1 for balance',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for active 0 for non active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `patientid` (`patientid`),
  KEY `bill_no` (`bill_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bill_patient_ip`
--

CREATE TABLE IF NOT EXISTS `bill_patient_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(50) NOT NULL,
  `fees` varchar(20) NOT NULL,
  `lab` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chart_ot`
--

CREATE TABLE IF NOT EXISTS `chart_ot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(11) NOT NULL,
  `patientid` varchar(15) NOT NULL,
  `ip_no` varchar(50) NOT NULL,
  `insert_from` varchar(50) NOT NULL,
  `room_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `doa` varchar(50) NOT NULL,
  `cons` varchar(50) NOT NULL,
  `intimedate` datetime NOT NULL,
  `vacant_chk` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `shift_patient` varchar(50) NOT NULL,
  `outtime` datetime NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clinical_history`
--

CREATE TABLE IF NOT EXISTS `clinical_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_no` varchar(100) NOT NULL,
  `complaints` varchar(100) NOT NULL,
  `dm` varchar(100) NOT NULL,
  `cad` varchar(100) NOT NULL,
  `asthma` varchar(100) NOT NULL,
  `seizure` varchar(100) NOT NULL,
  `diagnosis` varchar(100) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clinical_others`
--

CREATE TABLE IF NOT EXISTS `clinical_others` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` int(11) NOT NULL,
  `consultant` varchar(100) NOT NULL,
  `complaint_no` varchar(100) NOT NULL,
  `others` varchar(100) NOT NULL,
  `createdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `consultant_details`
--

CREATE TABLE IF NOT EXISTS `consultant_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` int(11) NOT NULL,
  `insert_from` varchar(50) NOT NULL,
  `bill_number` varchar(100) NOT NULL,
  `patient_id` varchar(50) NOT NULL,
  `ip_no` varchar(50) NOT NULL,
  `department` int(11) NOT NULL,
  `consultant` int(11) NOT NULL,
  `visit` int(11) NOT NULL,
  `fee` varchar(20) NOT NULL,
  `intime` datetime NOT NULL,
  `bill_queue` varchar(5) NOT NULL DEFAULT '0',
  `paid_status` int(11) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `family_history`
--

CREATE TABLE IF NOT EXISTS `family_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` int(11) NOT NULL,
  `consultant` varchar(100) NOT NULL,
  `complaint_no` varchar(100) NOT NULL,
  `family_history` varchar(100) NOT NULL,
  `createdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `bill_queue` varchar(5) NOT NULL DEFAULT '0',
  `paid_status` int(11) NOT NULL,
  `insert_id` int(11) NOT NULL,
  `insert_from` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `bill_queue` varchar(5) NOT NULL DEFAULT '0',
  `paid_status` int(11) NOT NULL,
  `insert_id` int(11) NOT NULL,
  `insert_from` varchar(100) NOT NULL,
  `created_date` date NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_patient`
--

CREATE TABLE IF NOT EXISTS `inv_patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_pat_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `branch` varchar(100) CHARACTER SET utf8 NOT NULL,
  `patientid` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ward` varchar(100) NOT NULL,
  `room` varchar(100) NOT NULL,
  `room_alloc_date` varchar(50) NOT NULL,
  `consultant` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `source` varchar(100) NOT NULL,
  `depart` varchar(100) NOT NULL,
  `patientsalutation` varchar(100) CHARACTER SET utf8 NOT NULL,
  `patientname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `guardiansalutation` varchar(100) CHARACTER SET utf8 NOT NULL,
  `age` varchar(100) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(100) CHARACTER SET utf8 NOT NULL,
  `contactno` varchar(100) CHARACTER SET utf8 NOT NULL,
  `occupation` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  `create_date` datetime NOT NULL,
  `pat_ip_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ip_patientadv`
--

CREATE TABLE IF NOT EXISTS `ip_patientadv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` varchar(100) NOT NULL,
  `bill_number` varchar(100) CHARACTER SET utf8 NOT NULL,
  `paid_status` int(11) NOT NULL,
  `pat_name` varchar(100) NOT NULL,
  `ip_no` varchar(100) NOT NULL,
  `advance_amt` double(10,2) NOT NULL,
  `Return_amt` double NOT NULL,
  `description` varchar(100) NOT NULL,
  `active` int(2) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lab_details_ip`
--

CREATE TABLE IF NOT EXISTS `lab_details_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(50) NOT NULL,
  `bill_number` varchar(100) NOT NULL,
  `labsampleno` varchar(25) NOT NULL,
  `lab_id` int(50) NOT NULL,
  `lab_sub_id` varchar(50) NOT NULL,
  `reports` text NOT NULL,
  `notes` text NOT NULL,
  `fees` double(10,2) NOT NULL,
  `bill_queue` varchar(5) NOT NULL DEFAULT '0',
  `created_date` varchar(25) NOT NULL,
  `lab_full_det_name` varchar(100) NOT NULL,
  `paid_status` int(11) NOT NULL DEFAULT '0',
  `createdby` varchar(25) NOT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lab_testsample_ip`
--

CREATE TABLE IF NOT EXISTS `lab_testsample_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(20) NOT NULL,
  `ip_id` varchar(20) NOT NULL,
  `bill_number` varchar(25) NOT NULL,
  `labsampleno` varchar(25) NOT NULL,
  `sampletesttitle` text NOT NULL,
  `sampletestsubtitle` text NOT NULL,
  `sampleapprover` text NOT NULL,
  `sampleapproverdesign` text NOT NULL,
  `datereq` datetime DEFAULT NULL,
  `datecollect` datetime DEFAULT NULL,
  `datereportgen` datetime DEFAULT NULL,
  `paid_status` varchar(2) NOT NULL,
  `bill_queue` varchar(2) NOT NULL DEFAULT '0',
  `testtotalamt` varchar(15) NOT NULL,
  `createby` varchar(30) NOT NULL,
  `createon` varchar(30) NOT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patientdetails`
--

CREATE TABLE IF NOT EXISTS `patientdetails` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `branch` varchar(50) NOT NULL,
  `patientid` varchar(50) NOT NULL,
  `ip_id` varchar(20) NOT NULL,
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
  `time` datetime NOT NULL,
  `hold` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'o for non hold 1 for hold',
  `holdby` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patientid` (`patientid`),
  KEY `patientname` (`patientname`),
  KEY `contactno` (`contactno`),
  KEY `hold` (`hold`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patientlabdetails`
--

CREATE TABLE IF NOT EXISTS `patientlabdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(50) NOT NULL,
  `bill_number` varchar(100) NOT NULL,
  `lab_id` int(50) NOT NULL,
  `lab_det` varchar(50) NOT NULL,
  `lab_full_det` varchar(50) NOT NULL,
  `lab_full_det_name` varchar(100) NOT NULL,
  `fees` double(10,2) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `personal_history`
--

CREATE TABLE IF NOT EXISTS `personal_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` int(11) NOT NULL,
  `consultant` varchar(100) NOT NULL,
  `complaint_no` varchar(100) NOT NULL,
  `personal_hist` varchar(100) NOT NULL,
  `createdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `procedure_details`
--

CREATE TABLE IF NOT EXISTS `procedure_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(50) NOT NULL,
  `insert_from` varchar(50) NOT NULL,
  `bill_number` varchar(100) NOT NULL,
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
  `bill_queue` varchar(5) NOT NULL DEFAULT '0',
  `paid_status` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `room_bill_details`
--

CREATE TABLE IF NOT EXISTS `room_bill_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(50) NOT NULL,
  `insert_from` varchar(50) NOT NULL,
  `bill_number` varchar(100) NOT NULL,
  `room_id` varchar(50) NOT NULL,
  `ip_no` varchar(100) CHARACTER SET utf8 NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `patient_id` varchar(100) CHARACTER SET utf8 NOT NULL,
  `from_time` varchar(50) NOT NULL,
  `to_time` varchar(50) NOT NULL,
  `vacate` varchar(11) NOT NULL,
  `given_details` varchar(50) NOT NULL,
  `fees_amount` double(10,2) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `services_details`
--

CREATE TABLE IF NOT EXISTS `services_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(50) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `insert_from` varchar(50) NOT NULL,
  `bill_number` varchar(100) NOT NULL,
  `ip_no` varchar(100) CHARACTER SET utf8 NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `given_details` varchar(50) NOT NULL,
  `total_count` int(11) NOT NULL,
  `bill_queue` varchar(5) NOT NULL DEFAULT '0',
  `paid_status` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sitting_details`
--

CREATE TABLE IF NOT EXISTS `sitting_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(50) NOT NULL,
  `patient_id` varchar(20) NOT NULL,
  `insert_from` varchar(20) NOT NULL,
  `ip_no` varchar(20) NOT NULL,
  `bill_number` varchar(20) NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `sitting` varchar(50) NOT NULL,
  `total_count` int(11) NOT NULL,
  `bill_queue` varchar(5) NOT NULL DEFAULT '0',
  `paid_status` int(11) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activitychart`
--

CREATE TABLE IF NOT EXISTS `tbl_activitychart` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT,
  `uhid` varchar(10) NOT NULL,
  `ipno` varchar(10) NOT NULL,
  `awdate_in` datetime NOT NULL COMMENT 'patient received date & time',
  `aicu_datein` datetime NOT NULL,
  `aot_datein` datetime NOT NULL,
  `received_by` varchar(20) NOT NULL COMMENT 'received by who',
  `w_bp` varchar(50) NOT NULL COMMENT 'blood pressure of patient',
  `w_temp` float NOT NULL COMMENT 'temperature',
  `w_wt` float NOT NULL COMMENT 'weight',
  `service` varchar(2) NOT NULL COMMENT 'type of service',
  `ser_no` int(10) NOT NULL COMMENT 'quantity',
  `sw_fee` float NOT NULL COMMENT 'ward service fee',
  `wprocedure` varchar(20) NOT NULL COMMENT 'ward procedure fee',
  `pro_no` int(20) NOT NULL COMMENT 'procedure quantity',
  `p_consultant` varchar(20) NOT NULL COMMENT 'procedure by which consultant',
  `pw_fee` double NOT NULL COMMENT 'ward procedure fee',
  `physio_status` tinyint(4) NOT NULL COMMENT 'physiotheraphy',
  `physio_type` varchar(20) NOT NULL COMMENT 'physiotherapy type',
  `physio_sitting` varchar(10) NOT NULL,
  `vcons_name` varchar(10) NOT NULL COMMENT 'ward visiting consultant',
  `vcons_no` int(10) NOT NULL COMMENT 'no of visit',
  `vcon_fee` float NOT NULL COMMENT 'visiting consultant fees',
  `ward_notes` longtext NOT NULL,
  `wshift_status` tinyint(4) NOT NULL COMMENT 'ward shift status',
  `wshift_ward` varchar(10) NOT NULL COMMENT 'shifted to which ward',
  `wshift_roomno` varchar(10) NOT NULL COMMENT 'shifted to which room no',
  `shift_datetime` datetime NOT NULL,
  `vacateroom_status` tinyint(4) NOT NULL,
  `vacateroom_time` datetime NOT NULL,
  `username` varchar(20) NOT NULL,
  `discharge_status` tinyint(20) NOT NULL,
  `dodtime` datetime NOT NULL COMMENT 'date of discharge time',
  `wstatus` tinyint(4) NOT NULL,
  `icua_status` tinyint(4) NOT NULL,
  `ota_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`ac_id`)
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tempimg`
--

CREATE TABLE IF NOT EXISTS `tempimg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` longblob NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
