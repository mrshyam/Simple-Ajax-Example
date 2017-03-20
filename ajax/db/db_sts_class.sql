-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2017 at 07:33 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_sts_class`
--

-- --------------------------------------------------------

--
-- Table structure for table `noreload`
--

CREATE TABLE IF NOT EXISTS `noreload` (
  `id` int(11) NOT NULL,
  `fName` varchar(100) NOT NULL,
  `lName` varchar(100) NOT NULL,
  `uName` varchar(100) NOT NULL,
  `state` varchar(10) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `disc` varchar(10000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `noreload`
--

INSERT INTO `noreload` (`id`, `fName`, `lName`, `uName`, `state`, `title`, `disc`) VALUES
(88, 'Mr', 'ShyAm', 'mrshyam.in', '1', 'Title', 'Description'),
(89, 'Sunil', 'Bhatia', 'sbsunil9', '1', 'News Title', 'News Description');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `noreload`
--
ALTER TABLE `noreload`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `noreload`
--
ALTER TABLE `noreload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=90;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
