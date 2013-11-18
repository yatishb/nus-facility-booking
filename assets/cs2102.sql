-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 166.62.8.77
-- Generation Time: Nov 17, 2013 at 08:39 PM
-- Server version: 5.0.96
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `dbcs2102`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic`
--

CREATE TABLE `academic` (
  `fac_id` bigint(20) NOT NULL default '0',
  `reg_id` bigint(20) NOT NULL default '0',
  `whiteboard` tinyint(1) default '0',
  `audio_system` tinyint(1) default '0',
  `projector` tinyint(1) default '0',
  PRIMARY KEY  (`fac_id`,`reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic`
--

INSERT INTO `academic` VALUES(1, 6, 1, 0, 0);
INSERT INTO `academic` VALUES(2, 6, 1, 0, 0);
INSERT INTO `academic` VALUES(3, 6, 1, 0, 0);
INSERT INTO `academic` VALUES(4, 6, 1, 0, 0);
INSERT INTO `academic` VALUES(5, 6, 1, 1, 1);
INSERT INTO `academic` VALUES(6, 6, 1, 1, 1);
INSERT INTO `academic` VALUES(16, 1, 1, 0, 1);
INSERT INTO `academic` VALUES(17, 1, 1, 0, 1);
INSERT INTO `academic` VALUES(18, 1, 1, 1, 1);
INSERT INTO `academic` VALUES(22, 1, 1, 0, 1);
INSERT INTO `academic` VALUES(23, 1, 1, 0, 0);
INSERT INTO `academic` VALUES(24, 8, 1, 1, 1);
INSERT INTO `academic` VALUES(25, 8, 1, 1, 1);
INSERT INTO `academic` VALUES(26, 8, 1, 1, 1);
INSERT INTO `academic` VALUES(27, 8, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` bigint(20) NOT NULL default '0',
  `fac_id` bigint(20) default NULL,
  `reg_id` bigint(20) default NULL,
  `user_id` char(10) default NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY  (`book_id`),
  KEY `fac_id` (`fac_id`,`reg_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--


-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `fac_id` bigint(20) NOT NULL default '0',
  `reg_id` bigint(20) NOT NULL default '0',
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `capacity` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY  (`fac_id`,`reg_id`),
  KEY `reg_id` (`reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` VALUES(1, 6, '08:00:00', '20:59:59', 10, 'CL Discussion Room 1', 'academic');
INSERT INTO `facility` VALUES(2, 6, '08:00:00', '20:59:59', 6, 'CL Discussion Room 2', 'academic');
INSERT INTO `facility` VALUES(3, 6, '08:00:00', '20:59:59', 12, 'CL Discussion Room 3', 'academic');
INSERT INTO `facility` VALUES(4, 6, '08:00:00', '20:59:59', 10, 'CL Discussion Room 4', 'academic');
INSERT INTO `facility` VALUES(5, 6, '09:00:00', '17:59:59', 50, 'CL Theater 1', 'academic');
INSERT INTO `facility` VALUES(6, 6, '09:00:00', '17:59:59', 30, 'CL Theater 2', 'academic');
INSERT INTO `facility` VALUES(7, 12, '06:00:00', '20:59:59', 4, 'Tennis Court 1', 'sports');
INSERT INTO `facility` VALUES(8, 12, '06:00:00', '20:59:59', 4, 'Tennis Court 2', 'sports');
INSERT INTO `facility` VALUES(9, 12, '06:00:00', '20:59:59', 4, 'Tennis Court 3', 'sports');
INSERT INTO `facility` VALUES(10, 12, '06:00:00', '19:59:59', 12, 'Basketball Court 1', 'sports');
INSERT INTO `facility` VALUES(11, 12, '06:00:00', '19:59:59', 12, 'Basketball Court 2', 'sports');
INSERT INTO `facility` VALUES(12, 12, '09:00:00', '19:59:59', 2, 'Squash Court 1', 'sports');
INSERT INTO `facility` VALUES(13, 12, '08:00:00', '19:59:59', 2, 'Squash Court 2', 'sports');
INSERT INTO `facility` VALUES(14, 12, '06:00:00', '21:59:59', 1000, 'MPSH 1', 'sports');
INSERT INTO `facility` VALUES(15, 12, '08:00:00', '20:59:59', 300, 'MPSH 2', 'sports');
INSERT INTO `facility` VALUES(16, 1, '00:00:00', '23:59:59', 6, 'ERC Study Room 1', 'academic');
INSERT INTO `facility` VALUES(17, 1, '00:00:00', '23:59:59', 8, 'ERC Study Room 2', 'academic');
INSERT INTO `facility` VALUES(18, 1, '08:00:00', '22:59:59', 20, 'ERC Art Room 1', 'academic');
INSERT INTO `facility` VALUES(19, 1, '06:00:00', '21:59:59', 30, 'Tembusu MPH', 'sports');
INSERT INTO `facility` VALUES(20, 1, '06:00:00', '22:59:59', 30, 'Cinnamon MPH', 'sports');
INSERT INTO `facility` VALUES(21, 1, '08:00:00', '21:00:00', 40, 'Swimming Pool', 'sports');
INSERT INTO `facility` VALUES(22, 1, '00:00:00', '23:59:00', 8, 'Mac Commons Discussion Room 1', 'academic');
INSERT INTO `facility` VALUES(23, 1, '00:00:00', '23:59:00', 5, 'Mac Commons Discussion Room 2', 'academic');
INSERT INTO `facility` VALUES(24, 8, '08:00:00', '21:00:00', 100, 'Seminar Room 1', 'academic');
INSERT INTO `facility` VALUES(25, 8, '08:00:00', '21:00:00', 300, 'Seminar Room 2', 'academic');
INSERT INTO `facility` VALUES(26, 8, '08:00:00', '21:00:00', 200, 'Seminar Room 3', 'academic');
INSERT INTO `facility` VALUES(27, 8, '08:00:00', '21:00:00', 100, 'Seminar Room 4', 'academic');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `reg_id` bigint(20) NOT NULL,
  `name` varchar(256) NOT NULL,
  `location` varchar(256) default NULL,
  PRIMARY KEY  (`reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` VALUES(1, 'University Town', 'College Avenue, NUS');
INSERT INTO `region` VALUES(2, 'University Cultural Centre', 'Upper Kent Ridge Dr, NUS');
INSERT INTO `region` VALUES(3, 'Engineering', '10, Engineering Dr, NUS');
INSERT INTO `region` VALUES(4, 'School of Design', '22, Lower Kent Ridge Dr, NUS');
INSERT INTO `region` VALUES(5, 'Yousof Ishak House', '15, Kent Ridge Crescent, NUS');
INSERT INTO `region` VALUES(6, 'Central Library', '16, Kent Ridge Crescent, NUS');
INSERT INTO `region` VALUES(7, 'Faculty of Arts and Social Sciences', '13, Kent Ridge Crescent, NUS');
INSERT INTO `region` VALUES(8, 'School of Computing', '12, Computing Dr, NUS');
INSERT INTO `region` VALUES(9, 'School of Business', '15, Lower Kent Ridge Dr, NUS');
INSERT INTO `region` VALUES(10, 'NEC House', '22, Prince George''s Park, NUS');
INSERT INTO `region` VALUES(11, 'Prince George''s Park', '32, Prince George''s Park, NUS');
INSERT INTO `region` VALUES(12, 'Sports and Recreational Centre', '10, Upper Kent Ridge Dr, NUS');
INSERT INTO `region` VALUES(13, 'Faculty of Science', '40, Upper Kent Ridge Dr, NUS');
INSERT INTO `region` VALUES(14, 'School of Medicine', '42, Upper Kent Ridge Dr, NUS');
INSERT INTO `region` VALUES(15, 'National University Hospital', '10, Ayer Rajah Expressway');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `fac_id` bigint(20) NOT NULL default '0',
  `reg_id` bigint(20) NOT NULL default '0',
  `scoreboard` tinyint(1) default '0',
  `spectator_area` tinyint(1) default '0',
  PRIMARY KEY  (`fac_id`,`reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` VALUES(7, 12, 1, 1);
INSERT INTO `sports` VALUES(8, 12, 1, 1);
INSERT INTO `sports` VALUES(9, 12, 1, 0);
INSERT INTO `sports` VALUES(10, 12, 1, 1);
INSERT INTO `sports` VALUES(11, 12, 1, 1);
INSERT INTO `sports` VALUES(12, 12, 0, 1);
INSERT INTO `sports` VALUES(13, 12, 0, 1);
INSERT INTO `sports` VALUES(14, 12, 1, 1);
INSERT INTO `sports` VALUES(15, 12, 1, 1);
INSERT INTO `sports` VALUES(19, 1, 0, 1);
INSERT INTO `sports` VALUES(20, 1, 1, 1);
INSERT INTO `sports` VALUES(21, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `start` time NOT NULL default '00:00:00',
  `end` time default NULL,
  PRIMARY KEY  (`start`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` VALUES('00:00:00', '00:59:59');
INSERT INTO `timeslot` VALUES('01:00:00', '01:59:59');
INSERT INTO `timeslot` VALUES('02:00:00', '02:59:59');
INSERT INTO `timeslot` VALUES('03:00:00', '03:59:59');
INSERT INTO `timeslot` VALUES('04:00:00', '04:59:59');
INSERT INTO `timeslot` VALUES('05:00:00', '05:59:59');
INSERT INTO `timeslot` VALUES('06:00:00', '06:59:59');
INSERT INTO `timeslot` VALUES('07:00:00', '07:59:59');
INSERT INTO `timeslot` VALUES('08:00:00', '08:59:59');
INSERT INTO `timeslot` VALUES('09:00:00', '09:59:59');
INSERT INTO `timeslot` VALUES('10:00:00', '10:59:59');
INSERT INTO `timeslot` VALUES('11:00:00', '11:59:59');
INSERT INTO `timeslot` VALUES('12:00:00', '12:59:59');
INSERT INTO `timeslot` VALUES('13:00:00', '13:59:59');
INSERT INTO `timeslot` VALUES('14:00:00', '14:59:59');
INSERT INTO `timeslot` VALUES('15:00:00', '15:59:59');
INSERT INTO `timeslot` VALUES('16:00:00', '16:59:59');
INSERT INTO `timeslot` VALUES('17:00:00', '17:59:59');
INSERT INTO `timeslot` VALUES('18:00:00', '18:59:59');
INSERT INTO `timeslot` VALUES('19:00:00', '19:59:59');
INSERT INTO `timeslot` VALUES('20:00:00', '20:59:59');
INSERT INTO `timeslot` VALUES('21:00:00', '21:59:59');
INSERT INTO `timeslot` VALUES('22:00:00', '22:59:59');
INSERT INTO `timeslot` VALUES('23:00:00', '23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` char(8) NOT NULL,
  `name` varchar(32) NOT NULL,
  `password` char(32) NOT NULL,
  `is_admin` tinyint(1) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES('A0088669', 'Shekhar', '5f4dcc3b5aa765d61d8327deb882cf99', 1);
INSERT INTO `user` VALUES('A0091545', 'Yats', '5f4dcc3b5aa765d61d8327deb882cf99', 1);
INSERT INTO `user` VALUES('A0123456', 'Jack', '5f4dcc3b5aa765d61d8327deb882cf99', 0);
INSERT INTO `user` VALUES('A1234567', 'John', '5f4dcc3b5aa765d61d8327deb882cf99', 0);
INSERT INTO `user` VALUES('admin', 'admin', '6eea9b7ef19179a06954edd0f6c05ceb', 1);
