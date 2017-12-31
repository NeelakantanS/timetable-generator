-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2015 at 12:58 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_full_name` varchar(60) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `section` varchar(20) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `faculty_id` varchar(20) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `user_id`, `course_name`, `course_full_name`, `semester`, `section`, `subject_id`, `faculty_id`) VALUES
(49, 24, 'BBA', 'Bachelor of Business Application', 'one', 'a', '24', '24');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `faculty_code` varchar(30) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `designation` varchar(60) NOT NULL,
  `qualification` varchar(60) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `user_id`, `faculty_code`, `faculty_name`, `designation`, `qualification`) VALUES
(24, 24, '435', 'bbbbb', 'bbbbbb', 'bbbbb');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `subject_code` varchar(30) NOT NULL,
  `subject_name` varchar(60) NOT NULL,
  `l` varchar(15) NOT NULL,
  `t` varchar(15) NOT NULL,
  `p` varchar(15) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `user_id`, `subject_code`, `subject_name`, `l`, `t`, `p`) VALUES
(24, 24, '123', 'aaaaa', '2', '1', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tablesheet`
--

CREATE TABLE IF NOT EXISTS `tablesheet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cell` varchar(4) NOT NULL,
  `data` varchar(10) NOT NULL,
  `faculty_name` varchar(20) NOT NULL,
  `timetable_id` varchar(20) NOT NULL,
  `user_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `tablesheet`
--

INSERT INTO `tablesheet` (`id`, `cell`, `data`, `faculty_name`, `timetable_id`, `user_id`) VALUES
(85, '10', '123', 'bbbbb', '18', 24),
(86, '19', '123', 'bbbbb', '18', 24),
(87, '27', '123', 'bbbbb', '18', 24),
(89, '37', '123', 'bbbbb', '18', 24),
(90, '8', '123', 'bbbbb', '18', 24),
(91, '40', '123', 'bbbbb', '18', 24),
(92, '9', '123', 'bbbbb', '18', 24);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `timetable_id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `course_full_name` varchar(40) NOT NULL,
  `year` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  PRIMARY KEY (`timetable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`timetable_id`, `user_id`, `course_full_name`, `year`, `semester`, `course`) VALUES
(18, 24, 'Bachelor of Business Application', '2014-2015', 'one', 'BBA');

-- --------------------------------------------------------

--
-- Table structure for table `timing`
--

CREATE TABLE IF NOT EXISTS `timing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `first` varchar(20) NOT NULL,
  `second` varchar(20) NOT NULL,
  `third` varchar(20) NOT NULL,
  `fourth` varchar(20) NOT NULL,
  `fifth` varchar(20) NOT NULL,
  `sixth` varchar(20) NOT NULL,
  `seventh` varchar(20) NOT NULL,
  `eight` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `timing`
--

INSERT INTO `timing` (`id`, `user_id`, `first`, `second`, `third`, `fourth`, `fifth`, `sixth`, `seventh`, `eight`) VALUES
(3, '24', '8 -9', '9-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(50) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `uname` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `ip_address`, `date`, `time`, `username`, `email`, `uname`) VALUES
(24, '123', '::1', '2015-05-25', '12:49:04', 'anurag', 'anuragambraham@gmail.com', 'Sharda University');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
