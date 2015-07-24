-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2015 at 02:34 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.23-1+deb.sury.org~trusty+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `c2experts_sys1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) NOT NULL,
  `createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`categoryId`),
  KEY `createdBy` (`createdBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `createdBy`) VALUES
(16, 'general', NULL),
(17, 'Video Training', 1),
(18, 'asdasd', 1),
(19, 'koipio', 1),
(24, 'fghtuytujhghjghjhjkuyiuykkghkhjkkhjkhjfhgj', 1),
(25, 'general', 1),
(26, 'errtr45r', 1),
(27, 'general', 1),
(29, 'Unified Communications', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classCat`
--

CREATE TABLE IF NOT EXISTS `classCat` (
  `ClassCatId` int(11) NOT NULL AUTO_INCREMENT,
  `classId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`ClassCatId`),
  KEY `ClassId` (`classId`),
  KEY `CategoryId` (`categoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `classCat`
--

INSERT INTO `classCat` (`ClassCatId`, `classId`, `categoryId`) VALUES
(1, 36, 16),
(4, 38, 16),
(6, 39, 16),
(8, 40, 16),
(10, 41, 16),
(12, 42, 16),
(13, 42, 17),
(14, 42, 18),
(15, 42, 24),
(16, 43, 19),
(17, 43, 25),
(18, 43, 27),
(19, 43, 29),
(30, 44, 24),
(32, 45, 16),
(33, 45, 17),
(34, 45, 27),
(35, 45, 29);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `classId` int(11) NOT NULL AUTO_INCREMENT,
  `className` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `classVideo` varchar(200) NOT NULL,
  `duration` int(11) NOT NULL,
  `time` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `attendee` int(11) NOT NULL,
  `classType` varchar(20) NOT NULL,
  `private` tinyint(4) NOT NULL,
  `privatePassCode` varchar(100) NOT NULL,
  `paymentType` varchar(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `courseId` int(11) NOT NULL,
  PRIMARY KEY (`classId`),
  KEY `createdBy` (`createdBy`,`courseId`),
  KEY `courseId` (`courseId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classId`, `className`, `startDate`, `endDate`, `classVideo`, `duration`, `time`, `price`, `attendee`, `classType`, `private`, `privatePassCode`, `paymentType`, `description`, `createdBy`, `status`, `courseId`) VALUES
(19, 'ghfgh', '0000-00-00', '0000-00-00', '', 1, '2:45 am', 1, 1, 'videoClass', 0, '', 'recuring', '', 1, 0, 18),
(24, 'Stest', '2015-05-08', '2015-05-08', '', 12, '12:15 am', 12, 12, 'classroomClass', 1, '49Rga5bLBiXAuvHf', 'recuring', '', 1, 0, 24),
(26, 'Class 1', '0000-00-00', '0000-00-00', '', 40, '12:45 am', 10, 77, 'videoClass', 1, 'vr5ekDh6DmFTpOoT', 'recuring', '', 1, 1, 16),
(27, 'Class 2', '2015-05-21', '2015-05-29', '', 40, '3:00 am', 20, 66, 'classroomClass', 0, '', 'recuring', '', 1, 0, 16),
(28, 'Class 3', '0000-00-00', '0000-00-00', '', 40, '12:15 am', 200, 20, 'videoClass', 0, '', 'fullpayment', '', 1, 1, 16),
(29, 'Class desc', '2015-06-22', '2015-06-23', '', 10, '4:15 am', 20, 2, 'classroomClass', 1, 'wGFKKCBFQZnI0VhA', 'recuring', 'asdas sad as das dsa dsa sad sa', 1, 0, 16),
(30, 'Video Test', '0000-00-00', '0000-00-00', 'https://s3.amazonaws.com/logicexperts/_fbalexander.mp4', 2, '2:00 am', 20, 5, 'videoClass', 1, 'eHU12DXwZAXO4SMN', 'fullpayment', 'This is class video test', 1, 1, 16),
(31, 'Video Test 2', '0000-00-00', '0000-00-00', 'http://stream.flowplayer.org/bauhaus/624x260.mp4', 10, '4:15 am', 200, 66, 'videoClass', 0, '', 'fullpayment', 'asdasd sd asd sad asd asd asd', 1, 1, 16),
(33, 'ClassRoom', '2015-06-17', '2015-06-26', '', 0, '12:15 am', 20, 20, 'classroomClass', 1, 'LKH8AaMyPd16ixai', 'recuring', 'This is classroom type class', 1, 0, 0),
(34, 'ClassRoom 2', '2015-06-18', '2015-06-25', '', 0, '12:30 am', 20, 200, 'classroomClass', 1, '01UwCqT7f53f1IuA', 'fullpayment', 'This is class room 2', 1, 0, 0),
(35, 'Video Class update', '0000-00-00', '0000-00-00', 'https://s3.amazonaws.com/logicexperts/_fbalexander.mp4', 3, '', 20, 0, 'videoClass', 1, 'b1m4QKnhc8X3rWq0', 'fullpayment', 'This is a video class update', 1, 1, 0),
(36, 'ClassRoom', '0000-00-00', '0000-00-00', 'sdf', 0, '', 20, 0, 'classroom', 1, 'o0lVIU0zpgcQ4ANQ', 'fullpayment', 'sdfsdfsdf', 1, 1, 0),
(37, 'ClassRoom', '0000-00-00', '0000-00-00', 'sdf', 0, '', 20, 0, 'classroom', 1, 'o0lVIU0zpgcQ4ANQ', 'fullpayment', 'sdfsdfsdf', 1, 1, 0),
(38, 'ClassRoom', '0000-00-00', '0000-00-00', 'sdf', 0, '', 20, 0, 'classroom', 1, 'o0lVIU0zpgcQ4ANQ', 'fullpayment', 'sdfsdfsdf', 1, 1, 0),
(39, 'ClassRoom', '0000-00-00', '0000-00-00', 'sdf', 0, '', 20, 0, 'classroom', 1, 'o0lVIU0zpgcQ4ANQ', 'fullpayment', 'sdfsdfsdf', 1, 1, 0),
(40, 'ClassRoom', '0000-00-00', '0000-00-00', 'sdf', 0, '', 20, 0, 'classroom', 1, 'o0lVIU0zpgcQ4ANQ', 'fullpayment', 'sdfsdfsdf', 1, 1, 0),
(41, 'ClassRoom', '0000-00-00', '0000-00-00', 'sdf', 0, '', 20, 0, 'classroom', 1, 'o0lVIU0zpgcQ4ANQ', 'fullpayment', 'sdfsdfsdf', 1, 1, 0),
(42, 'ClassRoom', '0000-00-00', '0000-00-00', 'sdf', 0, '', 20, 0, 'classroom', 1, 'o0lVIU0zpgcQ4ANQ', 'fullpayment', 'sdfsdfsdf', 1, 1, 0),
(43, 'video check', '0000-00-00', '0000-00-00', 'https://s3.amazonaws.com/logicexperts/_fbalexander.mp4', 3, '', 20, 0, 'videoClass', 1, 'a1uuKEiqloaA9DNy', 'recuring', 'This is testing', 1, 1, 0),
(44, 'Category Test', '0000-00-00', '0000-00-00', 'https://s3.amazonaws.com/logicexperts/_fbalexander.mp4', 3, '', 400, 0, 'videoClass', 0, '', 'fullpayment', 'testing', 1, 1, 0),
(45, 'testying', '0000-00-00', '0000-00-00', 'http://stream.flowplayer.org/bauhaus/624x260.mp4', 1, '', 400, 0, 'videoClass', 1, '2sl9RReoGSJs99hP', 'fullpayment', 'asdfasd', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `courseId` int(11) NOT NULL AUTO_INCREMENT,
  `courseName` varchar(100) NOT NULL,
  `courseDuration` int(11) NOT NULL,
  `courseDesc` varchar(500) NOT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `categoryId` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`courseId`),
  KEY `categoryId` (`categoryId`),
  KEY `createdBy` (`createdBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseId`, `courseName`, `courseDuration`, `courseDesc`, `createdBy`, `categoryId`) VALUES
(16, 'Course 3', 10, 'Hello Dolly', 1, '17'),
(17, 'course 4', 40, '', 1, 'a:2:{i:0;s:2:"10";i:1;s:2:"14";}'),
(18, 'test', 12, '', 1, 'a:1:{i:0;s:2:"14";}'),
(20, 'new Test', 40, '', 1, '10,14'),
(21, 'dbghhg', 2, '', 1, '10'),
(22, 'testing', 4324324, '', 1, '10'),
(23, 'qwqwqwq', 45435, '', 1, '14'),
(24, 'Stest', 30, '', 1, '10'),
(25, '.net', 1, '', 1, '16'),
(26, 'dotnet', 4, '', 1, '16'),
(27, 'CUCM', 10, '', 1, '29'),
(28, 'Courses', 40, 'Hello', 1, '16,17,18,25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `orderClassId` int(11) NOT NULL,
  `orderUserId` int(11) NOT NULL,
  `orderTime` varchar(100) NOT NULL,
  `orderDiscount` int(11) NOT NULL,
  `orderPaymentReciptId` varchar(100) NOT NULL,
  `orderStatus` varchar(50) NOT NULL,
  `orderClassPaymentCount` int(11) NOT NULL,
  PRIMARY KEY (`orderId`),
  KEY `orderClassId` (`orderClassId`,`orderUserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `orderClassId`, `orderUserId`, `orderTime`, `orderDiscount`, `orderPaymentReciptId`, `orderStatus`, `orderClassPaymentCount`) VALUES
(1, 16, 1, '2015-04-25 03:26:09', 5, '2121', 'Completed', 1),
(5, 19, 238, '2015-05-08 07:22:35', 2, '2121', 'Completed', 1),
(6, 19, 238, '2015-05-28 00:17:15', 4, '1211', 'pending', 1),
(7, 27, 230, '04:10:11 May 14, 2015 PDT', 0, '0', 'Pending', 1),
(8, 27, 230, '04:19:53 May 14, 2015 PDT', 0, '2', 'Pending', 1),
(9, 27, 230, '04:32:20 May 14, 2015 PDT', 0, '93U35758BM786742X', 'Pending', 1),
(10, 27, 230, '04:38:13 May 14, 2015 PDT', 0, '34K79629X4338332S', 'Pending', 1),
(11, 26, 230, '22:37:58 May 17, 2015 PDT', 0, '6KD48722HY531154R', 'Pending', 1),
(12, 26, 230, '02:23:51 May 18, 2015 PDT', 0, '9G083081RU183011D', 'Pending', 1),
(13, 27, 230, '02:26:02 May 18, 2015 PDT', 0, '4HT031637U823922B', 'Pending', 1),
(14, 27, 230, '2015-05-20T05:19:11Z', 0, '6TH64693T0295754H', 'Success', 1),
(15, 27, 230, '2015-05-20 02:24:05', 0, '2233893148', 'Success', 1),
(16, 27, 230, '2015-05-20T10:51:04Z', 0, '79T779841H117922T', 'Success', 1),
(17, 27, 230, '2015-05-20T10:52:33Z', 0, '3J442948U3687053B', 'Success', 1),
(18, 27, 230, '2015-05-20T10:56:40Z', 0, '66P61183PT762871S', 'Success', 1),
(19, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(20, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(21, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(22, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(23, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(24, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(25, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(26, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(27, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(28, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(29, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(30, 27, 230, '23:20:37 May 21, 2015 PDT', 0, '1EN20354JC970770D', 'Pending', 1),
(31, 27, 230, '01:58:49 May 22, 2015 PDT', 0, '2SX634003T507294F', 'Pending', 1),
(32, 28, 256, '02:42:15 May 22, 2015 PDT', 0, '96E98123B9182604R', 'Pending', 1),
(33, 26, 259, '00:07:01 May 25, 2015 PDT', 0, '6HS83132L0017434B', 'Pending', 1),
(34, 27, 259, '2015-05-25 03:16:17', 0, '2234098399', 'Success', 1),
(35, 27, 259, '2015-05-25T07:20:09Z', 0, '9TK30254ST741604S', 'Success', 1),
(36, 27, 259, '2015-05-25T07:24:10Z', 0, '77F56676FG7390839', 'Success', 1),
(37, 26, 259, '2015-05-25 03:56:02', 0, '2234099172', 'Success', 1),
(38, 26, 259, '01:04:58 May 25, 2015 PDT', 0, '81800870HF7602005', 'Pending', 1),
(39, 27, 259, '2015-05-25 04:08:47', 0, '2234099429', 'Success', 1),
(40, 27, 259, '01:32:55 May 25, 2015 PDT', 0, '830061433W6818207', 'Pending', 1),
(41, 26, 259, '2015-05-25 04:37:26', 0, '2234100732', 'Success', 1),
(42, 26, 259, '2015-05-25 04:42:07', 0, '2234101726', 'Success', 1),
(43, 27, 259, '01:43:08 May 25, 2015 PDT', 0, '2SF08714AP472664H', 'Pending', 1),
(44, 27, 288, '2015-05-26T07:01:04Z', 0, '14M721483H312453B', 'Success', 1),
(45, 27, 288, '2015-05-26T07:13:18Z', 0, '7W8531451X945292R', 'Success', 1),
(46, 27, 288, '2015-05-26T09:08:21Z', 0, '9RE976355Y062744L', 'Success', 1),
(47, 27, 259, '2015-05-28T05:25:45Z', 0, '82T7100344848315S', 'Success', 1),
(48, 27, 259, '22:33:35 May 27, 2015 PDT', 0, '2GX98428AP325083A', 'Pending', 1),
(49, 26, 259, '2015-05-28T07:04:19Z', 0, '6LU37115TG0183949', 'Success', 1),
(50, 26, 259, '2015-05-28T07:06:27Z', 0, '9FL99994G7314363V', 'Success', 1),
(51, 27, 259, '2015-05-28 03:16:54', 0, '2234239647', 'Success', 1),
(52, 27, 299, '2015-05-29T03:31:20Z', 0, '8T682123BE5247826', 'Success', 1),
(53, 27, 299, '2015-05-29T03:41:12Z', 0, '0TX13967HN927851J', 'Success', 1),
(54, 27, 299, '2015-05-29T03:43:18Z', 0, '1S8769888U751513M', 'Success', 1),
(55, 27, 300, '2015-05-29T04:14:03Z', 0, '2SL156664T861873Y', 'Success', 1),
(56, 27, 300, '2015-05-29T04:17:34Z', 0, '9UY4665411835831N', 'Success', 1),
(57, 27, 300, '2015-05-29T04:18:46Z', 0, '0572217879869690S', 'Success', 1),
(58, 27, 300, '2015-05-29T04:43:10Z', 0, '8HL57277MH067392W', 'Success', 1),
(59, 27, 300, '2015-05-29T04:46:06Z', 0, '24B81123U4687501T', 'Success', 1),
(60, 27, 300, '2015-05-29T04:56:47Z', 0, '3H682682CL074573V', 'Success', 1),
(61, 27, 300, '2015-05-29T04:59:07Z', 0, '7KS37691UW198490V', 'Success', 1),
(62, 27, 300, '2015-05-29T05:04:52Z', 0, '9U4710784R892005V', 'Success', 1),
(63, 27, 300, '2015-05-29T05:05:08Z', 0, '9P07249943472940R', 'Success', 1),
(64, 27, 300, '2015-05-29T05:07:21Z', 0, '3HW31754XU974282G', 'Success', 1),
(65, 27, 288, '2015-05-29T05:24:12Z', 0, '11T78286S7120673T', 'Success', 1),
(66, 27, 288, '2015-05-29T05:26:17Z', 0, '1SN00891CV225912W', 'Success', 1),
(67, 26, 300, '2015-05-29T05:31:17Z', 0, '2NA458568H2739318', 'Success', 1),
(68, 26, 300, '2015-05-29T05:35:45Z', 0, '09S34908HH254123B', 'Success', 1),
(69, 30, 288, '00:55:31 Jun 11, 2015 PDT', 0, '9ES47457ES094094A', 'Pending', 1),
(70, 30, 288, '01:00:24 Jun 11, 2015 PDT', 0, '09727369RF816562L', 'Pending', 1),
(71, 30, 288, '01:58:41 Jun 11, 2015 PDT', 0, '19248784RV9173224', 'Pending', 1),
(72, 30, 288, '02:16:21 Jun 11, 2015 PDT', 0, '5YH975154X034373Y', 'Pending', 1),
(73, 30, 288, '23:34:05 Jun 11, 2015 PDT', 0, '3J476506TP4412241', 'Pending', 1),
(74, 31, 288, '02:04:07 Jun 12, 2015 PDT', 0, '94H77293CA430261K', 'Pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pageId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `handle` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `parentId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `lastUpdated` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`pageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageId`, `title`, `handle`, `content`, `parentId`, `createdBy`, `lastUpdated`, `status`, `position`) VALUES
(1, 'home', 'home', '<p><img alt="img1" src="http://www.logicexpertsus.com/assets/front/images/instructions.png" /></p>\n\n<h2>Expert<br />\nInstructors</h2>\n\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since ining essentially unchanged.</p>\n\n<p>Learn More</p>\n', 9, 1, '2015-04-30', 0, 3),
(3, 'contact us', 'contactus', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque feugiat nulla sit amet nunc fermentum, id vehicula quam pharetra. Duis convallis vestibulum turpis id viverra. Integer maximus eget nulla vel sollicitudin. Etiam facilisis id sem ac bibendum. Ut sit amet efficitur urna. Vivamus sollicitudin elit pellentesque magna eleifend, vitae luctus felis ullamcorper. Nulla a mauris nec nulla cursus gravida. Aliquam condimentum diam a ante luctus, a finibus elit accumsan. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras ultricies tellus sem, a fringilla lectus malesuada ac. Phasellus sed libero pharetra, pretium odio sed, scelerisque lectus. Vestibulum vulputate mattis sapien quis tempor. Ut lorem enim, auctor in ligula sit amet, facilisis venenatis magna. Sed lacinia justo est, id mollis augue vulputate vitae.</p>\n\n<p>Morbi a pellentesque enim. Nunc eleifend sollicitudin dignissim. Nunc facilisis sit amet risus ac varius. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut sit amet metus laoreet erat auctor faucibus sit amet suscipit libero. In quis lacinia lectus. Vestibulum ac enim turpis. Fusce mattis fringilla odio rutrum tempor. Sed ut placerat odio. In hac habitasse platea dictumst. Donec vitae leo metus. Phasellus volutpat auctor ligula eget eleifend. Vivamus vestibulum sollicitudin urna, varius tincidunt lorem. Vestibulum eros turpis, mattis at neque ac, porta blandit dui.</p>\n\n<p>In dictum ipsum enim, eget hendrerit nunc semper eu. In hac habitasse platea dictumst. Morbi id consequat sapien. Mauris laoreet quam nec turpis scelerisque venenatis. Aliquam vestibulum quis velit vel interdum. Nam facilisis ipsum neque, sed placerat nunc viverra vitae. Donec non sagittis dui, vitae euismod quam. Donec lobortis lorem et libero efficitur ultrices.</p>\n\n<p>Vestibulum elementum quam a dapibus ultricies. Etiam convallis dui feugiat nisl tristique, vitae pulvinar tortor maximus. Curabitur feugiat quis ipsum cursus condimentum. Praesent nisl sem, lobortis id sem nec, ornare condimentum quam. Vestibulum non justo lorem. Praesent vel erat venenatis, pellentesque metus vitae, volutpat sem. Donec aliquam, ligula vitae varius vehicula, ligula dui suscipit eros, id eleifend neque sapien non nibh.</p>\n', 9, 1, '2015-05-01', 1, 2),
(6, 'Date Test', 'date', '<p>`</p>\n\n<p>sdfsdfsdf sdfsd fsdf<br />\nSdf</p>\n\n<p>sd f</p>\n\n<p>&nbsp;sdf sdfsd</p>', 8, 1, '0000-00-00', 0, 5),
(7, 'Date Test 2', 'sdfdsf', '<p>asda a sdf df sdaf</p>', 1, 2, '2015-04-24', 0, 2),
(8, 'asd', 'asdas', '<p>&nbsp;</p>\n\n<p>s</p>\n\n<p>df</p>\n\n<p>sdf</p>\n\n<p>sd</p>\n\n<p>fsd</p>\n\n<p>f</p>\n\n<p>sdf</p>\n\n<p>sdlkfnsdkfhkjsdhfkljnsdf</p>\n', 9, 1, '2015-04-24', 0, 2),
(9, 'Courses', 'courses', '<p><img alt="" src="https://networkinferno.net/wp-content/uploads/2013/12/ccie_rs.jpg" style="float:right; height:60px; width:60px" /></p>\n\n<p>Hi This is course section. In here you will find our available courses.</p>\n', 0, 1, '2015-06-02', 1, 1),
(10, 'test', 'test', '<p>sdgdf</p>', 0, 1, '2015-04-30', 0, 0),
(12, 'Classes', 'classes', '<h3>About Classes</h3>\n\n<p>Student Registration and Administration Nemo enim ipsam voluptatem quia voluptas sit atur aut odit aut fugit, sed quia consequuntur magni res eos qui ratione voluptatem sequi nesciunt.</p>\n\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised believable.</p>', 0, 1, '2015-05-01', 1, 3),
(14, 'abc', '1', '', 0, 1, '2015-05-08', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settingsId` int(11) NOT NULL AUTO_INCREMENT,
  `contactEmail` varchar(50) NOT NULL,
  `gatewayApi` varchar(100) NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `authorizeApiId` varchar(50) NOT NULL,
  `authorizeTransKey` varchar(100) NOT NULL,
  PRIMARY KEY (`settingsId`),
  KEY `updatedBy` (`updatedBy`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settingsId`, `contactEmail`, `gatewayApi`, `updatedBy`, `authorizeApiId`, `authorizeTransKey`) VALUES
(1, 'ankitphp@csgroupchd.com', 'ankitphp-seller@csgroupchd.com', 1, '8kK67CvDR', '24yRVX7j3vsy3M6X');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userFName` varchar(50) NOT NULL,
  `userLName` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userPhnNo` varchar(50) NOT NULL,
  `userAddress` varchar(100) NOT NULL,
  `userRegTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userStatus` tinyint(4) NOT NULL DEFAULT '1',
  `userType` char(20) NOT NULL,
  `userLastLogin` datetime NOT NULL,
  `userImage` varchar(50) NOT NULL,
  `activateCode` varchar(50) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=303 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userFName`, `userLName`, `userName`, `userEmail`, `userPass`, `userPhnNo`, `userAddress`, `userRegTime`, `userStatus`, `userType`, `userLastLogin`, `userImage`, `activateCode`) VALUES
(1, 'ankit', 'kamboj', 'admin', 'admin@gmail.com', 'YWRtaW5wYXNzd29yZGtleQ==', '1234567890', '123', '2015-04-02 10:34:16', 1, 'superadmin', '2015-06-17 02:23:21', '', ''),
(209, 'user', 'user', 'username', 'user@gmail.com', 'cGFzc3dvcmRrZXk=', '1234', '#1234', '2015-05-05 11:45:41', 1, 'user', '0000-00-00 00:00:00', '', ''),
(210, 'aki', 'aska', 'ankitkamboj', 'akki@gmail.com', 'dXNlcjEyMzRwYXNzd29yZGtleQ==', '0', '', '2015-05-06 04:27:15', 1, 'user', '2015-05-07 03:09:10', '', ''),
(212, 'admin', 'admin11', 'admin1sdsfsfsd', 'ankit@gmil.com', 'cGFzc3dvcmRrZXk=', '', '', '2015-05-06 11:56:06', 1, 'user', '0000-00-00 00:00:00', '', ''),
(213, 'admin1', 'admin1', 'editsss', 'user1@gm.co', 'cGFzc3dvcmRrZXk=', '', '', '2015-05-07 04:55:51', 1, 'user', '0000-00-00 00:00:00', 'logo.jpg', ''),
(214, 'admin1', '', 'admin1sxss', 'userss1testing@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-07 05:22:24', 1, 'user', '0000-00-00 00:00:00', 'admin1sxss.jpg', ''),
(215, 'ss', 'as', 'activate', 'asda@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-07 07:50:46', 0, 'user', '0000-00-00 00:00:00', 'activate.jpg', 'XDYufTEK4g'),
(217, 'admin1', 'admin1', 'adminankit', 'ankitphpa@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '123456', '@#da', '2015-05-07 09:28:13', 0, 'user', '0000-00-00 00:00:00', 'adminankit.jpg', '38shTUiFKG'),
(218, 'user2', 'admin1', 'admin5', 'ankitaphp@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-07 09:32:39', 1, 'user', '2015-05-07 05:34:30', 'admin5.jpg', 'iY7MeZwcbq'),
(220, 'admin', 'adsd', 'usernameaa', 'ankitphp@csgroupchd.comd', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-07 10:50:48', 1, 'user', '2015-05-07 06:51:32', 'usernameaa.jpg', '2Km8i7RO5H'),
(221, 'ff', 'hjk', 'dhruv', 'dhruv@gmail.com', 'cGFzc3dvcmRrZXk=', '', 'sdf', '2015-05-07 11:03:28', 1, 'admin', '0000-00-00 00:00:00', '', ''),
(222, 'aa', 'll', 'asd', 'asd@gmail.com', 'cGFzc3dvcmRrZXk=', '', 'guugui', '2015-05-07 12:03:18', 1, 'admin', '0000-00-00 00:00:00', '', ''),
(224, 'admin1', 'admin1', 'admin6aaaa', 'ankit@dfsd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-07 12:24:09', 0, 'user', '0000-00-00 00:00:00', 'admin6aaaa.jpg', 'M6sp4WSeEY'),
(225, 'akki', 'akki', 'aankitkamboj', 'hamender@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-07 12:29:18', 0, 'user', '0000-00-00 00:00:00', 'aankitkamboj.jpg', 'mg9VTKN3Oa'),
(226, 'sukhdev', 'aaa', 'sukhdev', 'sukhdev@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '123456', '', '2015-05-07 12:33:15', 1, 'user', '2015-05-07 08:36:25', 'sukhdev.jpg', 'NEsOo6DMcP'),
(227, 'aa', 'ss', 'jjj', 'dfg@gmail.com', 'MWFzZGZncGFzc3dvcmRrZXk=', '12345678', 'fbbb', '2015-05-08 03:38:02', 1, 'user', '0000-00-00 00:00:00', '', ''),
(229, 'admin1', 'admin1', 'admin1ddd', 'sfsdf@gmail.com', 'YXNkZmdocGFzc3dvcmRrZXk=', '', '', '2015-05-08 05:23:04', 1, 'admin', '0000-00-00 00:00:00', '', ''),
(230, 'admin1', 'admin1', 'akki_kamboj', 'ankitphrtyrtyrp@csgroupchd.com', 'cGFzc3dvcmRrZXk=', '', '', '2015-05-08 06:10:10', 1, 'user', '2015-05-26 01:25:27', 'akki_kamboj.jpg', 'Mvyncx92eB'),
(232, 'admin1', 'admin1', 'akki_kamboj1', 'aankitphp@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-08 06:12:58', 1, 'user', '0000-00-00 00:00:00', '', 'vSp4zVRi6F'),
(233, 'admin1', 'admin1', 'akki_kamboj2', 'accnkitphp@csgroupchd.com', 'dXNlcnVzZXJwYXNzd29yZGtleQ==', '', '', '2015-05-08 06:14:27', 1, 'user', '2015-05-08 02:16:51', 'akki_kamboj2.jpg', 'gF9TlIXnHY'),
(237, 'akki', 'aaa', 'sukhdev123', 'ansasdkitphp@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-08 06:34:39', 1, 'user', '2015-05-08 02:41:03', 'sukhdev123.jpg', 'fl8UQtOFyk'),
(238, 'sukhad', 'aaa', 'sukhdev11', 'ankitphp@as.com', 'cGFzc3dvcmRrZXk=', '123456789', '321231', '2015-05-08 06:41:54', 1, 'user', '2015-05-08 06:21:09', 'sukhdev11.jpg', 'ZtaOp6DgzM'),
(239, 'admin1', 'admin1', 'akki_kamboj123', 'ankitphp@csgroupchd.comx', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-08 06:45:09', 0, 'user', '0000-00-00 00:00:00', 'akki_kamboj123.jpg', 'XtG0s6NdQx'),
(241, 'chhabi', 'sharma', 'Rajat sharma', 'kritika@gmail.com', 'cGFzc3dvcmRrZXk=', '123455', 'pase5 mohali', '2015-05-08 08:00:17', 1, 'admin', '0000-00-00 00:00:00', '', ''),
(243, 'Sharma', 'Neha', 'SharmaNeha', '9646neha@gmail.com', 'bmVoYTEyM3Bhc3N3b3Jka2V5', '23234324', 'qwdfwef12123', '2015-05-08 09:36:05', 0, 'user', '0000-00-00 00:00:00', 'SharmaNeha.png', 'PqK0azhvTu'),
(244, 'user', 'admin1', 'admin9SDASDA', 'asda@sdfs.vo', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-08 13:08:36', 0, 'user', '0000-00-00 00:00:00', 'admin9SDASDA.jpg', 'ZMXPvLpUsd'),
(245, 'Ankit', 'Kamboj', 'akki_kamboj12', 'ankitpfffhp@csgroupchd.com', 'cGFzc3dvcmRrZXk=', '', '', '2015-05-11 04:59:22', 1, 'user', '2015-05-25 01:34:56', 'akki_kamboj12.jpg', '6Av5aDLEyX'),
(246, 'admin test', '', 'usernametest', 'jasxspreetphp@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-12 09:50:46', 0, 'user', '0000-00-00 00:00:00', 'usernametest.jpg', 'QaLKX8SDtk'),
(247, 'checkout', '', 'checkout test', 'jaspreetphp@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-12 10:14:41', 1, 'user', '0000-00-00 00:00:00', 'checkout_test.jpg', 'Z5PQCW1baz'),
(249, 'payement', '', 'payment', 'ankiqwqtphp@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-14 11:42:05', 1, 'user', '0000-00-00 00:00:00', 'payment.jpg', 'F9cxpDqKGy'),
(250, 'admin1', 'admin1', 'qblocksc_qblocks', 'ankitphpaa@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-18 04:48:57', 1, 'user', '0000-00-00 00:00:00', 'qblocksc_qblocks.jpg', 'KY7B2vN8FT'),
(251, 'asdasdasd', 'admin1', 'cueblocks', 'ankit@gmai.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-21 10:46:43', 0, 'user', '0000-00-00 00:00:00', 'cueblocks.jpg', '9YHM5wOKFE'),
(252, 'admin3', 'user', 'akki_kamboj1234565', 'samriti@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-22 09:25:48', 1, 'user', '0000-00-00 00:00:00', 'akki_kamboj1234565.jpg', 'y3cOpDaH9R'),
(253, 'admin1', 'asdaasd', 'sadasdaa', 'user1@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-22 09:35:01', 1, 'user', '0000-00-00 00:00:00', 'sadasdaa.jpg', 'c5OT8lP0d6'),
(254, 'admin1', 'asdaasd', 'sadasdaa123', 'user1111@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-22 09:36:39', 1, 'user', '0000-00-00 00:00:00', 'sadasdaa123.jpg', 'AqPueXkZMm'),
(255, 'admin1', 'admin1', 'admin11sdasd', 'user1asdasd@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-22 09:40:12', 1, 'user', '0000-00-00 00:00:00', 'admin11sdasd.jpg', 'hmHz2VPAWc'),
(256, 'admin1', 'admin1', 'admin11ssa', 'user1asdasdasd@gmail.comasd', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-22 09:41:01', 1, 'user', '0000-00-00 00:00:00', 'admin11ssa.jpg', 'Adv2kiSGz3'),
(257, 'admin1', 'admin1', 'sadasd', 'asdasd@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-22 09:45:12', 1, 'user', '2015-05-22 05:45:21', 'sadasd.jpg', 'hQiuDmzsnf'),
(258, 'admin1', 'asda', 'qwerty', 'aqwe@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-22 09:47:58', 1, 'user', '2015-05-22 05:48:15', 'qwerty.jpg', 'iNRM4QLIzW'),
(259, 'Sushma', 'Madam', 'sushma123', 'sushma@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 04:48:31', 1, 'user', '2015-05-28 01:13:49', 'sushma123.jpg', 'rEUvceGHtN'),
(260, 'hamender', 'sir', 'hamender12', 'hamender1@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 05:12:33', 0, 'user', '0000-00-00 00:00:00', 'hamender12.jpg', 'jFIJ5zT7Ee'),
(261, 'chhaya', 'sharma', 'chhaya sharma', 'chhaya@gmail.com', 'MTIzNDU2N3Bhc3N3b3Jka2V5', '123456789', 'ded', '2015-05-25 06:03:33', 0, 'user', '0000-00-00 00:00:00', 'chhaya_sharma.jpg', 'NA29cWjoar'),
(262, 'ppp', 'lll', 'rahul', 'rahul@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '123456789', 'gjhkhj', '2015-05-25 06:14:57', 0, 'user', '0000-00-00 00:00:00', 'rahul.png', 'SdTqkt8UZQ'),
(263, 'pp', 'll', 'rohan', 'rohan@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '5457687', 'dcdv', '2015-05-25 06:25:08', 0, 'user', '0000-00-00 00:00:00', 'rohan.png', '3qdJCH5krc'),
(264, 'admin1', 'admin1', 'cueblocksasdas', 'asdasd@dfgdf.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 09:10:12', 0, 'user', '0000-00-00 00:00:00', 'cueblocksasdas', 'EM7vdVir2t'),
(265, 'fgh', 'fgh', 'akki_kambojfghdfhfgh', 'asasd@gm.co', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 09:11:10', 0, 'user', '0000-00-00 00:00:00', '22-5-2015.zip', '57skRlL6S2'),
(266, 'admin1', 'admin5', 'cueblocksasdasd', 'samritiasdasd@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 09:12:49', 0, 'user', '0000-00-00 00:00:00', 'abkit.zip', 'RY2JD8wpbt'),
(267, 'bb', 'zz', 'bnm', 'chhabi@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '547689', 'gh', '2015-05-25 09:38:10', 1, 'user', '0000-00-00 00:00:00', '', '21tCYoNm3H'),
(268, 'ff', 'gg', 'zxc', 'zxc@gmail.com', 'YXNkZmdocGFzc3dvcmRrZXk=', '34567898', 'hjgkj', '2015-05-25 09:40:17', 0, 'user', '0000-00-00 00:00:00', '', 'dafWnqhs70'),
(269, 'test', 'cvvb', 'fgyhfujgh', 'testddfgf@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 09:42:56', 0, 'user', '0000-00-00 00:00:00', '', 'P1WKvQp3Uj'),
(270, 'bb', 'mm', 'cvb', 'cvb@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '689', 'vnm', '2015-05-25 09:43:35', 0, 'user', '0000-00-00 00:00:00', '', 'XwvyAo3NRZ'),
(271, 'vv', 'bb', 'lll', 'lll@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '6867', 'guytkj', '2015-05-25 09:49:52', 0, 'user', '0000-00-00 00:00:00', '', 'J0kM5SaeIu'),
(272, '', '', '', '', 'cGFzc3dvcmRrZXk=', '', '', '2015-05-25 09:55:05', 0, 'user', '0000-00-00 00:00:00', '', 'BLY3zPIX0r'),
(273, 'asd', 'sad', 'asdasdasd', 'dasdasd@dgfg.fghfg', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 10:00:27', 0, 'user', '0000-00-00 00:00:00', 'asdasdasd.jpg', 'X8xGAIdbFf'),
(274, 'gg', 'hh', 'kl', 'uu@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '54657', 'gngm', '2015-05-25 10:38:28', 0, 'user', '0000-00-00 00:00:00', '', 'MTAWh8Pp7R'),
(275, 'jj', 'kk', 'mm', 'mm@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '36465', 'bf', '2015-05-25 10:39:31', 0, 'user', '0000-00-00 00:00:00', '', 'VW5fNU1OC6'),
(276, 'xx', 'vv', 'nb', 'chhaya@csgroupchd.com', 'cGFzc3dvcmRrZXk=', '4676576', 'mhjm', '2015-05-25 10:41:07', 1, 'user', '2015-05-28 06:43:57', '', 'tCPvJcnjl5'),
(277, 'asd', 'aaa', 'asdasdasddfgdfg', 'asdasd@sdfas.ghhjgh', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 10:48:43', 0, 'user', '0000-00-00 00:00:00', '', 'xLk47A85Rf'),
(278, 'asd', 'aaa', 'ghj', 'dffdg@sgdfsd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 10:55:07', 0, 'user', '0000-00-00 00:00:00', '', 'JAujwiYq4Z'),
(279, 'cfgxfhfg', 'fghfgh', 'ghfgjf', 'sdgdf@gmail.com', 'cWF3c2VkcGFzc3dvcmRrZXk=', '', '', '2015-05-25 11:02:59', 0, 'user', '0000-00-00 00:00:00', '', 'cE2r19woZQ'),
(280, 'fghfhfg', 'fghfgh', 'fghfghfgj', 'fghfghfgdgdf@gmail.com', 'cWF3c2VkcGFzc3dvcmRrZXk=', '', '', '2015-05-25 11:04:01', 0, 'user', '0000-00-00 00:00:00', '', 'xGoytKU6nS'),
(281, 'asd', 'aaa', 'asdasdasdddddd', 'ddddd@fgdf.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 11:31:03', 0, 'user', '0000-00-00 00:00:00', '', 'putfhXWBrz'),
(282, 'asd', 'aaa', 'imagetestupload', 'imagetestupload@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 11:47:29', 0, 'user', '0000-00-00 00:00:00', '', 'YgIHXMPtfw'),
(283, 'asd', 'aaa', 'usernameimage', 'asdasd@sdfas.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 12:35:04', 0, 'user', '0000-00-00 00:00:00', '', 'N8jQ2C1Oos'),
(284, 'asd', 'aaa', 'image', 'asdasd@sdfas.in', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 12:38:00', 0, 'user', '0000-00-00 00:00:00', '', 'Qe9vcgJu6D'),
(285, 'asdasd', 'asdasd', 'asdasda', 'asadas@df.fgh', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 12:47:02', 0, 'user', '0000-00-00 00:00:00', '', 'MqCUnh4fNt'),
(286, 'asd', 'aaa', 'testingimage', 'testingimage@gmail.cvom', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 13:22:57', 0, 'user', '0000-00-00 00:00:00', '', 'KngVqZHWBb'),
(287, 'sukhdev', 'aaa', 'testimsage', 'testimsage@fgd.fgdf', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-25 13:24:15', 0, 'user', '0000-00-00 00:00:00', '', 'O1XkpKuF0o'),
(288, 'Ankit', 'Kamboj', 'tiknajobmak', 'ankitphp@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-26 04:49:34', 1, 'user', '2015-07-15 01:14:54', 'tiknajobmak.jpg', '5PlsofURAF'),
(289, 'xcg', 'fgdfgfg', 'dfg', 'hfhfg@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-28 06:17:46', 0, 'user', '0000-00-00 00:00:00', '', 'mjn5dXHro0'),
(290, 'cfhfgh', 'ghgj', 'fgjhfj', 'fdgdf@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-28 07:08:47', 0, 'user', '0000-00-00 00:00:00', '', 'sIX1N95OvU'),
(291, 'qq', 'ww', 'ee', 'chhay@gmail.com', 'YXNkZmdocGFzc3dvcmRrZXk=', '1234566', 'ee', '2015-05-28 09:47:57', 1, 'user', '0000-00-00 00:00:00', '', 'w05ZxgaJCq'),
(292, 'mm', 'nn', 'bb', 'bb@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '68782', 'ww', '2015-05-28 09:48:35', 1, 'user', '0000-00-00 00:00:00', '', '1gJ08GIQAu'),
(293, 'mm', 'nn', 'cc', 'santosh@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '6786', 'jy', '2015-05-28 09:50:22', 1, 'user', '0000-00-00 00:00:00', '', 'gORjqXK65v'),
(294, 'rr', 'tt', 'user', 'user12@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '34567', 'wws', '2015-05-28 10:27:17', 1, 'user', '0000-00-00 00:00:00', '', 'hYapgjtFZM'),
(295, 'aa', 'ss', 'test', 'test@gmail.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '5779', 'uku', '2015-05-28 10:29:16', 0, 'user', '0000-00-00 00:00:00', '', 'n6FqdG8Tim'),
(296, 'pp', 'oo', 'test1', 'Ram@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '6868', 'fh', '2015-05-28 10:31:51', 1, 'user', '0000-00-00 00:00:00', '', 'xgm8MJZuD2'),
(297, 'tets', 'test', 'test1sdfs2', 'sushmsfsdfsa@csgroupchd.com', 'cWF3c2VkcGFzc3dvcmRrZXk=', '', '', '2015-05-28 10:46:25', 0, 'user', '0000-00-00 00:00:00', '', 'z7DWN1Ojdl'),
(298, 'sushma', '', 'SChauhan', 'prince.dhiman@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-28 10:54:44', 0, 'user', '0000-00-00 00:00:00', '', 'uEx5Raovm2'),
(299, 'sushma', '', 'SChauhan1', 'princedhiman@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '', '', '2015-05-28 10:56:19', 1, 'user', '2015-05-28 11:44:20', '', '6yRc9UY3MD'),
(300, 'aa', 'dd', 'kk', 'narenderkumar@csgroupchd.com', 'MTIzNDU2cGFzc3dvcmRrZXk=', '5678', 'fhj', '2015-05-29 03:59:01', 1, 'user', '2015-05-29 12:40:21', '', 'SpTRVqWNPy'),
(301, 'Student', 'User', 'student1', 'sdavis@lynbrooksolutions.com', 'VHJAaW5pbmcxMjNwYXNzd29yZGtleQ==', '', '', '2015-05-29 14:35:58', 1, 'user', '2015-06-02 10:29:28', '', 'Puj3wmpUva'),
(302, 'akshay', 'ma', 'ak', 'test@test.com', 'MTIzNDU2Nzg5cGFzc3dvcmRrZXk=', '0987456123', '5551 pahst', '2015-06-26 14:42:14', 0, 'user', '0000-00-00 00:00:00', 'ak.png', 'u2VYMiNUnx');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `user_createdBy_relation` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `classCat`
--
ALTER TABLE `classCat`
  ADD CONSTRAINT `categoryId` FOREIGN KEY (`CategoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classId` FOREIGN KEY (`ClassId`) REFERENCES `classes` (`classId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `category_createdBy_relation` FOREIGN KEY (`createdBy`) REFERENCES `users` (`userId`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
