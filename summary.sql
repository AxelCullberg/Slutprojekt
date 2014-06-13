-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 13 jun 2014 kl 12:06
-- Serverversion: 5.5.16
-- PHP-version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `summary`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `summary_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `summary_id` (`summary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumpning av Data i tabell `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Engelska'),
(21, 'Hemkunskap'),
(19, 'Idrott'),
(4, 'Matte'),
(2, 'Svenska'),
(17, 'Teknik'),
(20, 'WEB');

-- --------------------------------------------------------

--
-- Tabellstruktur `summaries`
--

CREATE TABLE IF NOT EXISTS `summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `author_name` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(32) NOT NULL,
  `date` datetime NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumpning av Data i tabell `summaries`
--

INSERT INTO `summaries` (`id`, `title`, `author_name`, `content`, `image`, `date`, `subject_id`) VALUES
(7, 'Grammatik', 'Bananas', 'Grammatik är skräp', '', '2014-05-27 12:38:03', 2),
(9, 'Teknik Ã¤r kul', 'Axel', 'hahahhahahah skoja bara', '', '2014-05-27 01:01:49', 17),
(10, 'Kost', 'Axel', 'Ã¤r gott', '', '2014-05-27 01:04:05', 19),
(11, 'Teknik Ã¤r kul v2', 'Axwell the giant', 'hejhejhej', '', '2014-05-27 01:05:07', 17),
(13, 'projekt', 'axek', 'hej', '', '2014-05-27 01:31:03', 20),
(14, 'Prepositioner', 'axl', 'Ã¤r jobbiga som faaaaaaaaaan', '', '2014-06-09 02:01:00', 1),
(15, 'GrÃ¶t', 'axl', 'Havre och gryn', '', '2014-06-09 02:02:28', 21);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
