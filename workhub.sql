-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2013 at 04:30 AM
-- Server version: 5.5.30-log
-- PHP Version: 5.4.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `workhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `Application`
--

CREATE TABLE IF NOT EXISTS `Application` (
  `CID` int(11) NOT NULL,
  `JID` int(11) NOT NULL,
  `ApplyDate` date NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Note` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CID`,`JID`),
  KEY `ApplyToJob_idx` (`JID`),
  KEY `ApplyByCV_idx` (`CID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `CV`
--

CREATE TABLE IF NOT EXISTS `CV` (
  `CID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `EduLev` varchar(50) DEFAULT NULL,
  `Skill` varchar(255) DEFAULT NULL,
  `Language` varchar(255) DEFAULT NULL,
  `Exp` int(11) DEFAULT NULL,
  `AddInfo` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `Region` varchar(45) DEFAULT NULL,
  `BroadRegion` varchar(45) NOT NULL,
  PRIMARY KEY (`CID`),
  KEY `CV_Region_idx` (`Region`),
  KEY `CV_Applicant1_idx` (`UID`),
  KEY `CV_BroadRegion_idx` (`BroadRegion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Invitation`
--

CREATE TABLE IF NOT EXISTS `Invitation` (
  `CID` int(11) NOT NULL,
  `JID` int(11) NOT NULL,
  `ApplyDate` date NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Note` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CID`,`JID`),
  KEY `fk_Invitation_Job1_idx` (`JID`),
  KEY `fk_Invitation_CV_idx` (`CID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Job`
--

CREATE TABLE IF NOT EXISTS `Job` (
  `JID` int(11) NOT NULL AUTO_INCREMENT,
  `CID` int(11) NOT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `EduReq` varchar(50) DEFAULT NULL,
  `SkillReq` varchar(255) DEFAULT NULL,
  `LangReq` varchar(255) DEFAULT NULL,
  `ExpReq` int(11) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `ExpiredDate` date DEFAULT NULL,
  `Region` varchar(45) DEFAULT NULL,
  `BroadRegion` varchar(45) NOT NULL,
  PRIMARY KEY (`JID`),
  KEY `Job_Region_idx` (`Region`),
  KEY `Job_Company1_idx` (`CID`),
  KEY `Job_BroadRegion_idx` (`BroadRegion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Type` int(11) NOT NULL DEFAULT '0',
  `Status` int(2) NOT NULL DEFAULT '1' COMMENT '0 = Inactive; 1 = Active',
  `Email` varchar(50) NOT NULL,
  `Name` varchar(256) NOT NULL,
  `RID` int(11) DEFAULT NULL COMMENT 'Region ID',
  `Address` varchar(256) DEFAULT NULL,
  `Description` text,
  `Sex` int(2) NOT NULL DEFAULT '0' COMMENT 'Applicant',
  `Birthday` date DEFAULT NULL COMMENT 'Applicant',
  `Category` varchar(50) DEFAULT NULL COMMENT 'Employer',
  `Size` int(11) DEFAULT NULL COMMENT 'Employer',
  PRIMARY KEY (`UID`),
  UNIQUE KEY `username` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;
