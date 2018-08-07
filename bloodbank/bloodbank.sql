-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2014 at 11:01 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminUsers`
--

CREATE TABLE IF NOT EXISTS `adminUsers` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `adminUsers`
--

INSERT INTO `adminUsers` (`uid`, `username`, `password`) VALUES
(2, 'admin@gmail.com', '0b79a4f05fb3b54bde0ed4d631f5fc63ef4c989e');

-- --------------------------------------------------------

--
-- Table structure for table `AskBlood_Request`
--

CREATE TABLE IF NOT EXISTS `AskBlood_Request` (
  `requestID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberOfDonorsRequired` int(11) NOT NULL,
  PRIMARY KEY (`requestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `AskBlood_Request`
--

INSERT INTO `AskBlood_Request` (`requestID`, `username`, `timestamp`, `numberOfDonorsRequired`) VALUES
(15, 'ashish.fagna@gmail.com', '2014-11-23 16:19:23', 331),
(16, 'rahul@gmail.com', '2014-11-26 04:25:55', 2);

-- --------------------------------------------------------

--
-- Table structure for table `DonateBlood_Request`
--

CREATE TABLE IF NOT EXISTS `DonateBlood_Request` (
  `requestID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`requestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `DonateBlood_Request`
--

INSERT INTO `DonateBlood_Request` (`requestID`, `username`, `timestamp`) VALUES
(7, 'ashish.fagna@gmail.com', '2014-11-23 16:18:43'),
(8, 'rahul@gmail.com', '2014-11-26 04:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_from` varchar(2000) NOT NULL,
  `_to` varchar(2000) NOT NULL,
  `msg` varchar(8000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `_from`, `_to`, `msg`, `timestamp`) VALUES
(1, 'ashish.fagna@gmail.com', 'rahul@gmail.com', 'ashish.fagna@gmail.com wants your donation  - donate blood - if you want to donate', '2014-11-26 08:38:14'),
(2, 'ashish.fagna@gmail.com', 'rahul@gmail.com', 'ashish.fagna@gmail.com wants your donation  - donate blood - if you want to donate', '2014-11-26 08:39:11'),
(3, 'ashish.fagna@gmail.com', 'rahul@gmail.com', 'ashish.fagna@gmail.com wants your donation  - donate blood - if you want to donate', '2014-11-26 08:39:25'),
(4, 'ashish.fagna@gmail.com', 'rahul@gmail.com', 'ashish.fagna@gmail.com wants your donation  - donate blood - if you want to donate', '2014-11-26 08:41:09'),
(5, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants your donation  - donate blood - if you want to donate', '2014-11-26 08:42:33'),
(6, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-26 08:42:37'),
(7, 'ashish.fagna@gmail.com', 'rahul@gmail.com', 'ashish.fagna@gmail.com wants your donation  - donate blood - if you want to donate', '2014-11-26 09:00:58'),
(8, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-26 09:08:36'),
(9, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants your donation  - donate blood - if you want to donate', '2014-11-27 09:49:58'),
(10, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants your donation  - donate blood - if you want to donate', '2014-11-27 09:50:57'),
(11, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-27 09:51:07'),
(12, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-27 09:52:03'),
(13, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-27 09:52:31'),
(14, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-27 09:52:59'),
(15, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-27 09:53:30'),
(16, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-27 09:54:09'),
(17, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-27 09:55:21'),
(18, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-27 09:55:49'),
(19, 'rahul@gmail.com', 'ashish.fagna@gmail.com', 'rahul@gmail.com wants to donate to you - Ask request - if you need blood', '2014-11-27 09:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) CHARACTER SET utf8 NOT NULL,
  `password` char(100) CHARACTER SET utf8 NOT NULL,
  `firstname` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `bloodtype` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `city` varchar(200) CHARACTER SET utf8 NOT NULL,
  `state` varchar(200) CHARACTER SET utf8 NOT NULL,
  `zipcode` varchar(20) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `firstname`, `lastname`, `bloodtype`, `address`, `city`, `state`, `zipcode`, `phone`) VALUES
(12, 'ashish.fagna@gmail.com', '10de6e741b14a3b820c0d2a6413006e1f7cac48c', 'Ashish', 'Kumar', 'AB+', 'GGN', 'GGN', 'HARYANA', '302029', '9889889889'),
(13, 'rahul@gmail.com', '74585126865f2f3a533fb50bbfeef8c047943a98', 'Rahul', 'K', 'AB+', 'GGN', 'GGN', 'HARYANA', '302029', '8989898989');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
