-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2013 at 10:32 AM
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
  `AUID` int(11) NOT NULL COMMENT 'Applicant UID',
  `EUID` int(11) NOT NULL COMMENT 'Employer ID',
  `Status` int(2) NOT NULL DEFAULT '0' COMMENT '-1 = refused; 0 = waiting; 1 = accepted',
  `ApplyDate` date DEFAULT NULL,
  `Note` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CID`,`JID`),
  KEY `ApplyToJob_idx` (`JID`),
  KEY `ApplyByCV_idx` (`CID`),
  KEY `AUID` (`AUID`),
  KEY `EUID` (`EUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Application`
--

INSERT INTO `Application` (`CID`, `JID`, `AUID`, `EUID`, `Status`, `ApplyDate`, `Note`) VALUES
(1, 1, 11, 12, 1, NULL, NULL),
(2, 1, 11, 12, 0, NULL, NULL),
(2, 3, 11, 14, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `CAID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`CAID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`CAID`, `Name`) VALUES
(1, 'Other'),
(2, 'Accounting/Auditing'),
(3, 'Accounting/Finance'),
(4, 'Administrative/Clerical'),
(5, 'Advertising/Promotion/PR'),
(6, 'Agriculture/Forestry'),
(7, 'Airlines/Tourism/Hotel'),
(8, 'Architecture/Interior Design'),
(9, 'Arts/Design'),
(10, 'Automotive'),
(11, 'Banking');

-- --------------------------------------------------------

--
-- Table structure for table `CV`
--

CREATE TABLE IF NOT EXISTS `CV` (
  `CID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL COMMENT 'Applicant ID',
  `Subject` varchar(128) NOT NULL COMMENT 'Subject helps applicant organize CVs. This field should not be shown to employers',
  `Status` int(2) NOT NULL DEFAULT '1',
  `EduLev` varchar(256) DEFAULT NULL,
  `Skill` varchar(256) DEFAULT NULL,
  `Language` varchar(256) DEFAULT NULL,
  `Exp` varchar(256) DEFAULT NULL,
  `AddInfo` varchar(256) DEFAULT NULL,
  `RID` int(11) DEFAULT NULL COMMENT 'Region ID',
  PRIMARY KEY (`CID`),
  KEY `CV_Region_idx` (`RID`),
  KEY `CV_Applicant1_idx` (`UID`),
  KEY `UID` (`UID`),
  KEY `RID` (`RID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `CV`
--

INSERT INTO `CV` (`CID`, `UID`, `Subject`, `Status`, `EduLev`, `Skill`, `Language`, `Exp`, `AddInfo`, `RID`) VALUES
(1, 11, 'cv1', 1, '12', 'ultimate', 'English', 'pro', 'Too pro', 24),
(2, 11, 'cv2', 1, '', '', '', '', '', 24),
(3, 13, 'cv1', 1, '', '', '', '', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `Invitation`
--

CREATE TABLE IF NOT EXISTS `Invitation` (
  `CID` int(11) NOT NULL,
  `JID` int(11) NOT NULL,
  `AUID` int(11) NOT NULL COMMENT 'Applicant UID',
  `EUID` int(11) NOT NULL COMMENT 'Employer UID',
  `Status` int(2) NOT NULL DEFAULT '1',
  `ApplyDate` date DEFAULT NULL,
  `Note` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CID`,`JID`),
  KEY `fk_Invitation_Job1_idx` (`JID`),
  KEY `fk_Invitation_CV_idx` (`CID`),
  KEY `AUID` (`AUID`,`EUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Job`
--

CREATE TABLE IF NOT EXISTS `Job` (
  `JID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL COMMENT 'Employer ID',
  `Name` varchar(128) NOT NULL,
  `Status` int(2) NOT NULL DEFAULT '1' COMMENT '-1 = disabled; 0 = inactive; 1 = active',
  `JLID` int(11) NOT NULL DEFAULT '1',
  `CAID` int(11) NOT NULL DEFAULT '1',
  `MinSalary` int(11) DEFAULT NULL,
  `MaxSalary` int(11) DEFAULT NULL,
  `EduReq` varchar(256) DEFAULT NULL,
  `SkillReq` varchar(256) DEFAULT NULL,
  `LangReq` varchar(256) DEFAULT NULL,
  `ExpReq` varchar(256) DEFAULT NULL,
  `ExpiredDate` date DEFAULT NULL,
  `RID` int(11) NOT NULL DEFAULT '1' COMMENT 'Region ID',
  `Address` varchar(256) DEFAULT NULL,
  `Description` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`JID`),
  KEY `Job_Region_idx` (`RID`),
  KEY `Job_Company1_idx` (`UID`),
  KEY `JLID` (`JLID`),
  KEY `CAID` (`CAID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Job`
--

INSERT INTO `Job` (`JID`, `UID`, `Name`, `Status`, `JLID`, `CAID`, `MinSalary`, `MaxSalary`, `EduReq`, `SkillReq`, `LangReq`, `ExpReq`, `ExpiredDate`, `RID`, `Address`, `Description`) VALUES
(1, 12, 'Job 1', 1, 2, 11, 1000000, 3000000, '', '', '', '', NULL, 24, '', ''),
(2, 12, 'Job 2', 1, 2, 1, NULL, NULL, '', '', '', '', NULL, 24, '', ''),
(3, 14, 'Job 1', 1, 3, 11, NULL, NULL, '', '', '', '', NULL, 24, '', ''),
(4, 14, 'Job 2', 1, 3, 1, NULL, NULL, '', '', '', '', NULL, 30, '', ''),
(5, 12, 'Job 3', 1, 10, 11, 20000000, 40000000, '', '', '', '', NULL, 24, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `JobLevel`
--

CREATE TABLE IF NOT EXISTS `JobLevel` (
  `JLID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`JLID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `JobLevel`
--

INSERT INTO `JobLevel` (`JLID`, `Name`) VALUES
(1, 'Other'),
(2, 'New grad / Entry level / Internship'),
(3, 'Experienced (non-manager)'),
(4, 'Leader / Supervisor'),
(5, 'Manager'),
(6, 'Vice Director'),
(7, 'Director'),
(8, 'CEO'),
(9, 'Vice President'),
(10, 'President');

-- --------------------------------------------------------

--
-- Table structure for table `Region`
--

CREATE TABLE IF NOT EXISTS `Region` (
  `RID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`RID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `Region`
--

INSERT INTO `Region` (`RID`, `Name`) VALUES
(1, 'An Giang'),
(2, 'Bà Rịa - Vũng Tàu'),
(3, 'Bạc Liêu'),
(4, 'Bắc Kạn'),
(5, 'Bắc Giang'),
(6, 'Bắc Ninh'),
(7, 'Bến Tre'),
(8, 'Bình Dương'),
(9, 'Bình Định'),
(10, 'Bình Phước'),
(11, 'Bình Thuận'),
(12, 'Cà Mau'),
(13, 'Cao Bằng'),
(14, 'Cần Thơ'),
(15, 'Đà Nẵng'),
(16, 'Đắk Lắk'),
(17, 'Đắk Nông'),
(18, 'Điện Biên'),
(19, 'Đồng Nai'),
(20, 'Đồng Tháp'),
(21, 'Gia Lai'),
(22, 'Hà Giang'),
(23, 'Hà Nam'),
(24, 'Hà Nội'),
(25, 'Hà Tây'),
(26, 'Hà Tĩnh'),
(27, 'Hải Dương'),
(28, 'Hải Phòng'),
(29, 'Hòa Bình'),
(30, 'Hồ Chí Minh'),
(31, 'Hậu Giang'),
(32, 'Hưng Yên'),
(33, 'Khánh Hòa'),
(34, 'Kiên Giang'),
(35, 'Kon Tum'),
(36, 'Lai Châu'),
(37, 'Lào Cai'),
(38, 'Lạng Sơn'),
(39, 'Lâm Đồng'),
(40, 'Long An'),
(41, 'Nam Định'),
(42, 'Nghệ An'),
(43, 'Ninh Bình'),
(44, 'Ninh Thuận'),
(45, 'Phú Thọ'),
(46, 'Phú Yên'),
(47, 'Quảng Bình'),
(48, 'Quảng Nam'),
(49, 'Quảng Ngãi'),
(50, 'Quảng Ninh'),
(51, 'Quảng Trị'),
(52, 'Sóc Trăng'),
(53, 'Sơn La'),
(54, 'Tây Ninh'),
(55, 'Thái Bình'),
(56, 'Thái Nguyên'),
(57, 'Thanh Hóa'),
(58, 'Thừa Thiên - Huế'),
(59, 'Tiền Giang'),
(60, 'Trà Vinh'),
(61, 'Tuyên Quang'),
(62, 'Vĩnh Long'),
(63, 'Vĩnh Phúc'),
(64, 'Yên Bái');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Type` int(11) NOT NULL DEFAULT '0' COMMENT 'Account type',
  `Status` int(2) NOT NULL DEFAULT '1' COMMENT '0 = Inactive; 1 = Active',
  `Email` varchar(50) NOT NULL,
  `Name` varchar(256) NOT NULL,
  `RID` int(11) DEFAULT NULL COMMENT 'Region ID',
  `Address` varchar(256) DEFAULT NULL,
  `Description` text,
  `Sex` int(2) NOT NULL DEFAULT '0' COMMENT 'Applicant',
  `Birthday` date DEFAULT NULL COMMENT 'Applicant',
  `Size` int(11) DEFAULT NULL COMMENT 'Employer',
  PRIMARY KEY (`UID`),
  UNIQUE KEY `username` (`Username`),
  KEY `RID` (`RID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UID`, `Username`, `Password`, `Type`, `Status`, `Email`, `Name`, `RID`, `Address`, `Description`, `Sex`, `Birthday`, `Size`) VALUES
(11, 'user1', 'e10adc3949ba59abbe56e057f20f883e', 0, 1, 'user1new@example.com', 'User Mot', 1, 'user 1 address', 'user 1 description', 1, '2012-12-12', NULL),
(12, 'user2', 'c33367701511b4f6020ec61ded352059', 1, 1, 'user2new@example.com', 'User 2', 24, 'user 2 address', 'user 2 description new', 0, NULL, 1),
(13, 'user3', 'e10adc3949ba59abbe56e057f20f883e', 0, 1, 'user3@example.com', 'Nguyen Van Ba', 19, 'user 3 address', 'user 3 desc', 0, '0000-00-00', NULL),
(14, 'user4', 'c33367701511b4f6020ec61ded352059', 1, 1, 'user4@example.com', 'cty tnhh 4`', 18, 'address 4', 'user 4 description', 0, NULL, 2),
(15, 'user5', 'e10adc3949ba59abbe56e057f20f883e', 0, 1, 'user5@example.com', 'Thím N', 52, 'address 5', 'desc 5', 1, '0000-00-00', NULL),
(16, 'user6', 'c33367701511b4f6020ec61ded352059', 1, 1, 'user6@example.com', 'Six Coporation', 7, 'address 6', 'desc 6', 0, NULL, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Application`
--
ALTER TABLE `Application`
  ADD CONSTRAINT `Application_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `CV` (`CID`),
  ADD CONSTRAINT `Application_ibfk_2` FOREIGN KEY (`JID`) REFERENCES `Job` (`JID`),
  ADD CONSTRAINT `Application_ibfk_3` FOREIGN KEY (`AUID`) REFERENCES `User` (`UID`),
  ADD CONSTRAINT `Application_ibfk_4` FOREIGN KEY (`EUID`) REFERENCES `User` (`UID`);

--
-- Constraints for table `CV`
--
ALTER TABLE `CV`
  ADD CONSTRAINT `CV_ibfk_3` FOREIGN KEY (`UID`) REFERENCES `User` (`UID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `CV_ibfk_4` FOREIGN KEY (`RID`) REFERENCES `Region` (`RID`) ON UPDATE CASCADE;

--
-- Constraints for table `Job`
--
ALTER TABLE `Job`
  ADD CONSTRAINT `Job_ibfk_1` FOREIGN KEY (`RID`) REFERENCES `Region` (`RID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Job_ibfk_5` FOREIGN KEY (`JLID`) REFERENCES `JobLevel` (`JLID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Job_ibfk_6` FOREIGN KEY (`CAID`) REFERENCES `Category` (`CAID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Job_ibfk_7` FOREIGN KEY (`UID`) REFERENCES `User` (`UID`) ON UPDATE CASCADE;

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_2` FOREIGN KEY (`RID`) REFERENCES `Region` (`RID`) ON UPDATE CASCADE;
