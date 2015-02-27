-- MySQL dump 10.13  Distrib 5.6.17, for osx10.7 (x86_64)
--
-- Host: oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com    Database: corpus
-- ------------------------------------------------------
-- Server version	5.6.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article_journal`
--

DROP TABLE IF EXISTS `article_journal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_journal` (
  `article_id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  UNIQUE KEY `unique_journal` (`article_id`,`journal_id`),
  KEY `article_id_f` (`article_id`),
  KEY `journal_id_fk` (`journal_id`),
  CONSTRAINT `article_journal_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  CONSTRAINT `article_journal_ibfk_2` FOREIGN KEY (`journal_id`) REFERENCES `journal` (`journal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `article_tags`
--

DROP TABLE IF EXISTS `article_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_tags` (
  `tag_id` int(10) NOT NULL,
  `article_id` int(11) NOT NULL,
  UNIQUE KEY `unique_tag` (`article_id`,`tag_id`),
  KEY `article_id_fk` (`article_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `article_tags_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  CONSTRAINT `article_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tags_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8612432 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `author_article`
--

DROP TABLE IF EXISTS `author_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author_article` (
  `author_id` int(10) NOT NULL,
  `article_id` int(10) NOT NULL,
  UNIQUE KEY `unique_article` (`article_id`,`author_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `author_article_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  CONSTRAINT `author_article_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  CONSTRAINT `author_article_ibfk_3` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `author_id` int(10) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(100) NOT NULL,
  PRIMARY KEY (`author_id`),
  UNIQUE KEY `author_name` (`author_name`),
  UNIQUE KEY `author_name_2` (`author_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8311088 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `issns`
--

DROP TABLE IF EXISTS `issns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `issns` (
  `issn` varchar(12) NOT NULL,
  `journal_id` int(10) NOT NULL,
  UNIQUE KEY `unique_issn` (`issn`,`journal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `journal`
--

DROP TABLE IF EXISTS `journal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journal` (
  `journal_id` int(10) NOT NULL AUTO_INCREMENT,
  `journal_name` varchar(767) NOT NULL,
  PRIMARY KEY (`journal_id`),
  UNIQUE KEY `journal_name` (`journal_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1091533 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pagerank`
--

DROP TABLE IF EXISTS `pagerank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagerank` (
  `article_id` int(10) NOT NULL,
  `pagerank` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher` (
  `publisher_id` int(10) NOT NULL AUTO_INCREMENT,
  `publisher_name` varchar(500) NOT NULL,
  PRIMARY KEY (`publisher_id`),
  UNIQUE KEY `publisher_name` (`publisher_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1087696 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `publisher_article`
--

DROP TABLE IF EXISTS `publisher_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher_article` (
  `publisher_id` int(10) NOT NULL,
  `article_id` int(10) NOT NULL,
  `journal_id` int(10) NOT NULL,
  UNIQUE KEY `unique_publisher` (`article_id`,`publisher_id`,`journal_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `publisher_article_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  CONSTRAINT `publisher_article_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`publisher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `tags_id` int(10) NOT NULL AUTO_INCREMENT,
  `tags_name` varchar(767) NOT NULL,
  PRIMARY KEY (`tags_id`),
  UNIQUE KEY `tags_name` (`tags_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3951954 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votes` (
  `article_id` int(10) NOT NULL,
  `votes` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-18 10:48:12
