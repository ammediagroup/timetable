-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2013 at 11:17 PM
-- Server version: 5.1.40
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `journal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--



-- --------------------------------------------------------

--
-- Table structure for table `date`
--

CREATE TABLE IF NOT EXISTS `date` (
  `date` date NOT NULL,
  `less_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `notice` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Dumping data for table `date`
--

INSERT INTO `date` (`date`, `less_id`, `group_id`, `student_id`, `notice`, `active`) VALUES
('2013-03-11', 1, 1, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group`) VALUES
(1, 'П1-09'),
(2, 'П2-09');

-- --------------------------------------------------------

--
-- Table structure for table `less`
--

CREATE TABLE IF NOT EXISTS `less` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `less` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `less`
--

INSERT INTO `less` (`id`, `less`) VALUES
(1, 'Визуальные Среды');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student`, `comment`, `group_id`) VALUES
(1, 'Гузун Дмитрий Витальевич', '123233\r\n\r\n', 1),
(3, 'Егоров Денис Геннадьевич', '', 1),
(4, 'Скворцов Никита Валерьевич', '', 2);
