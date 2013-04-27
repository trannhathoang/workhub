-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2013 at 04:00 PM
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
  `UID` int(11) NOT NULL COMMENT 'Applicant ID',
  `Subject` varchar(128) NOT NULL COMMENT 'Subject helps applicant organize CVs. This field should not be shown to employers',
  `Status` int(2) NOT NULL DEFAULT '1',
  `Category` varchar(255) NOT NULL,
  `EduLev` varchar(50) DEFAULT NULL,
  `Skill` varchar(255) DEFAULT NULL,
  `Language` varchar(255) DEFAULT NULL,
  `Exp` int(11) DEFAULT NULL,
  `AddInfo` varchar(255) DEFAULT NULL,
  `RID` int(11) DEFAULT NULL COMMENT 'Region ID',
  PRIMARY KEY (`CID`),
  KEY `CV_Region_idx` (`RID`),
  KEY `CV_Applicant1_idx` (`UID`),
  KEY `UID` (`UID`),
  KEY `RID` (`RID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `CV`
--

INSERT INTO `CV` (`CID`, `UID`, `Subject`, `Status`, `Category`, `EduLev`, `Skill`, `Language`, `Exp`, `AddInfo`, `RID`) VALUES
(1, 11, 'cv1', -1, 'IT', 'master', 'ultimate', 'English', 0, 'too proo', 24);

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
  `UID` int(11) NOT NULL COMMENT 'Employer ID',
  `Name` varchar(128) NOT NULL,
  `Status` int(2) NOT NULL DEFAULT '1' COMMENT '-1 = disabled; 0 = inactive; 1 = active',
  `Category` varchar(255) DEFAULT NULL,
  `MinSalary` int(11) DEFAULT NULL,
  `MaxSalary` int(11) DEFAULT NULL,
  `EduReq` varchar(50) DEFAULT NULL,
  `SkillReq` varchar(255) DEFAULT NULL,
  `LangReq` varchar(255) DEFAULT NULL,
  `ExpReq` int(11) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `ExpiredDate` date DEFAULT NULL,
  `RID` int(11) NOT NULL DEFAULT '0' COMMENT 'Region ID',
  `Address` varchar(256) DEFAULT NULL,
  `Description` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`JID`),
  KEY `Job_Region_idx` (`RID`),
  KEY `Job_Company1_idx` (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `Job`
--

INSERT INTO `Job` (`JID`, `UID`, `Name`, `Status`, `Category`, `MinSalary`, `MaxSalary`, `EduReq`, `SkillReq`, `LangReq`, `ExpReq`, `Location`, `ExpiredDate`, `RID`, `Address`, `Description`) VALUES
(1, 12, 'Tester', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-06-01', 24, '', ''),
(2, 12, 'Manager', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL, NULL),
(3, 12, 'Field runner', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', ''),
(4, 12, 'Bao ve', -1, 'Security', 2000000, 5000000, NULL, NULL, NULL, NULL, NULL, NULL, 16, '', ''),
(5, 12, 'Gate Guard', 1, 'Security', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 20, '', ''),
(6, 12, 'Body guard', 1, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 19, '', ''),
(7, 12, 'Safe guard', -1, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', ''),
(8, 12, 'Safe guard', -1, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', ''),
(9, 12, 'Safe guard', 1, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', ''),
(10, 12, 'Saleman', -1, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 18, '', ''),
(11, 12, 'Clerk', 1, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, '', ''),
(12, 12, 'Writer', 1, 'IT', 1000000, 5000000, NULL, NULL, NULL, NULL, NULL, '2014-04-14', 1, 'address job 6', 'desc'),
(13, 14, 'Guard', 1, '', 3000000, 6000000, NULL, NULL, NULL, NULL, NULL, '2014-05-10', 39, '', '');

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
  `Category` varchar(50) DEFAULT NULL COMMENT 'Employer',
  `Size` int(11) DEFAULT NULL COMMENT 'Employer',
  PRIMARY KEY (`UID`),
  UNIQUE KEY `username` (`Username`),
  KEY `RID` (`RID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UID`, `Username`, `Password`, `Type`, `Status`, `Email`, `Name`, `RID`, `Address`, `Description`, `Sex`, `Birthday`, `Category`, `Size`) VALUES
(11, 'user1', 'e10adc3949ba59abbe56e057f20f883e', 0, 1, 'user1new@example.com', 'User Mot', 1, 'user 1 address', 'user 1 description', 1, '2012-12-12', NULL, NULL),
(12, 'user2', 'c33367701511b4f6020ec61ded352059', 1, 1, 'user2new@example.com', 'User 2', 24, 'user 2 address', 'user 2 description new', 0, NULL, 'IT', 1),
(13, 'user3', 'e10adc3949ba59abbe56e057f20f883e', 0, 1, 'user3@example.com', 'Nguyen Van Ba', 19, 'user 3 address', 'user 3 desc', 0, '0000-00-00', NULL, NULL),
(14, 'user4', 'c33367701511b4f6020ec61ded352059', 1, 1, 'user4@example.com', 'cty tnhh 4`', 18, 'address 4', 'user 4 desc', 0, NULL, 'IT', 2),
(15, 'user5', 'e10adc3949ba59abbe56e057f20f883e', 0, 1, 'user5@example.com', 'Thím N', 52, 'address 5', 'desc 5', 1, '0000-00-00', NULL, NULL),
(16, 'user6', 'c33367701511b4f6020ec61ded352059', 1, 1, 'user6@example.com', 'Six Coporation', 7, 'address 6', 'desc 6', 0, NULL, 'Banking', 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CV`
--
ALTER TABLE `CV`
  ADD CONSTRAINT `CV_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `User` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CV_ibfk_2` FOREIGN KEY (`RID`) REFERENCES `Region` (`RID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `Job`
--
ALTER TABLE `Job`
  ADD CONSTRAINT `Job_ibfk_1` FOREIGN KEY (`RID`) REFERENCES `Region` (`RID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Job_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `User` (`UID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`RID`) REFERENCES `Region` (`RID`) ON DELETE SET NULL ON UPDATE CASCADE;
