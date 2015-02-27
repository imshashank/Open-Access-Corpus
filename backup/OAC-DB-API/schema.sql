-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2014 at 10:44 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

--
-- Database: `corpus`
--
CREATE DATABASE IF NOT EXISTS `corpus`;
USE corpus;
-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` int(10) NOT NULL AUTO_INCREMENT,
  `alternate_id` varchar(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `abstract` varchar(5000) NOT NULL,
  `url` varchar(300) NOT NULL,
  `doi` varchar(100) NOT NULL,
  `language` varchar(20) NOT NULL,
  `year` int(5) NOT NULL,
  `page` varchar(20) NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `alts` varchar(10000) NOT NULL,
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

ALTER TABLE articles MODIFY COLUMN title VARCHAR(255)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE articles MODIFY COLUMN abstract VARCHAR(5000)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

-- --------------------------------------------------------

--
-- Table structure for table `article_concept`
--

CREATE TABLE IF NOT EXISTS `article_concept` (
  `alternate_id` varchar(20) NOT NULL,
  `concept_id` int(20) NOT NULL,
  `score` double NOT NULL,
  UNIQUE KEY `unique_index` (`alternate_id`,`concept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `article_journal`
--

CREATE TABLE IF NOT EXISTS `article_journal` (
  `article_id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  UNIQUE KEY `unique_journal` (`article_id`,`journal_id`),
  KEY `article_id_f` (`article_id`),
  KEY `journal_id_fk` (`journal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `article_tags`
--

CREATE TABLE IF NOT EXISTS `article_tags` (
  `tag_id` int(10) NOT NULL,
  `article_id` int(11) NOT NULL,
  UNIQUE KEY `unique_tag` (`article_id`,`tag_id`),
  KEY `article_id_fk` (`article_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(10) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(100) NOT NULL,
  PRIMARY KEY (`author_id`),
  UNIQUE KEY `author_name` (`author_name`),
  UNIQUE KEY `author_name_2` (`author_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `author_article`
--

CREATE TABLE IF NOT EXISTS `author_article` (
  `author_id` int(10) NOT NULL,
  `article_id` int(10) NOT NULL,
  UNIQUE KEY `unique_article` (`article_id`,`author_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `concepts`
--

CREATE TABLE IF NOT EXISTS `concepts` (
  `concept_id` int(20) NOT NULL AUTO_INCREMENT,
  `concept_name` varchar(100) NOT NULL,
  PRIMARY KEY (`concept_id`),
  UNIQUE KEY `concept_name` (`concept_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `issns`
--

CREATE TABLE IF NOT EXISTS `issns` (
  `issn` varchar(12) NOT NULL,
  `journal_id` int(10) NOT NULL,
  UNIQUE KEY `unique_issn` (`issn`,`journal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE IF NOT EXISTS `journal` (
  `journal_id` int(10) NOT NULL AUTO_INCREMENT,
  `journal_name` varchar(767) NOT NULL,
  PRIMARY KEY (`journal_id`),
  UNIQUE KEY `journal_name` (`journal_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `pagerank`
--

CREATE TABLE IF NOT EXISTS `pagerank` (
  `article_id` int(10) NOT NULL,
  `pagerank` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `publisher_id` int(10) NOT NULL AUTO_INCREMENT,
  `publisher_name` varchar(500) NOT NULL,
  PRIMARY KEY (`publisher_id`),
  UNIQUE KEY `publisher_name` (`publisher_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `publisher_article`
--

CREATE TABLE IF NOT EXISTS `publisher_article` (
  `publisher_id` int(10) NOT NULL,
  `article_id` int(10) NOT NULL,
  `journal_id` int(10) NOT NULL,
  UNIQUE KEY `unique_publisher` (`article_id`,`publisher_id`,`journal_id`),
  KEY `publisher_id` (`publisher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tags_id` int(10) NOT NULL AUTO_INCREMENT,
  `tags_name` varchar(767) NOT NULL,
  PRIMARY KEY (`tags_id`),
  UNIQUE KEY `tags_name` (`tags_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `article_id` int(10) NOT NULL,
  `votes` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article_journal`
--
ALTER TABLE `article_journal`
  ADD CONSTRAINT `article_journal_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  ADD CONSTRAINT `article_journal_ibfk_2` FOREIGN KEY (`journal_id`) REFERENCES `journal` (`journal_id`);

--
-- Constraints for table `article_tags`
--
ALTER TABLE `article_tags`
  ADD CONSTRAINT `article_tags_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  ADD CONSTRAINT `article_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tags_id`);

--
-- Constraints for table `author_article`
--
ALTER TABLE `author_article`
  ADD CONSTRAINT `author_article_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  ADD CONSTRAINT `author_article_ibfk_3` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`);

--
-- Constraints for table `publisher_article`
--
ALTER TABLE `publisher_article`
  ADD CONSTRAINT `publisher_article_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  ADD CONSTRAINT `publisher_article_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`publisher_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

