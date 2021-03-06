-- MySQL dump 10.13  Distrib 5.5.8, for Win32 (x86)
--
-- Host: localhost    Database: NavyBreak
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Table structure for table `cgame`
--

DROP TABLE IF EXISTS `cgame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cgame` (
  `id_game` varchar(10) NOT NULL,
  `id_userone` int(11) DEFAULT NULL,
  `id_usertwo` int(11) DEFAULT NULL,
  `cooshone` varchar(50) DEFAULT NULL,
  `cooseone` varchar(300) DEFAULT NULL,
  `pone_points` varchar(10) DEFAULT NULL,
  `cooshtwo` varchar(50) DEFAULT NULL,
  `coosetwo` varchar(300) DEFAULT NULL,
  `ptwo_points` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_game`),
  KEY `id_userone` (`id_userone`),
  KEY `id_usertwo` (`id_usertwo`),
  CONSTRAINT `cgame_ibfk_1` FOREIGN KEY (`id_userone`) REFERENCES `user` (`id_user`),
  CONSTRAINT `cgame_ibfk_2` FOREIGN KEY (`id_usertwo`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cgame`
--

LOCK TABLES `cgame` WRITE;
/*!40000 ALTER TABLE `cgame` DISABLE KEYS */;
INSERT INTO `cgame` VALUES ('1030',1,2,'A1,B2,B4,B5,C2,J4,D8,E9,D7,J1','A5,C7,I8','-3','E3,B4,C4,D1,F9,H5,A2,G3,I3,K2',' B5,J4,A8','1');
/*!40000 ALTER TABLE `cgame` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id_comment` varchar(10) NOT NULL,
  `id_postcomment` varchar(10) DEFAULT NULL,
  `id_usercomment` int(11) DEFAULT NULL,
  `comment_text` varchar(140) DEFAULT NULL,
  `comment_time` varchar(20) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `mecaga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_postcomment` (`id_postcomment`),
  KEY `id_usercomment` (`id_usercomment`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_postcomment`) REFERENCES `post` (`id_post`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_usercomment`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES ('7788','89',2,'soyelcomentario de rody','2017-05-25 04:19',2,1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `duels`
--

DROP TABLE IF EXISTS `duels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `duels` (
  `id_duels` varchar(10) NOT NULL,
  `id_userchallenger` int(11) DEFAULT NULL,
  `status` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id_duels`),
  KEY `id_userchallenger` (`id_userchallenger`),
  CONSTRAINT `duels_ibfk_1` FOREIGN KEY (`id_userchallenger`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `duels`
--

LOCK TABLES `duels` WRITE;
/*!40000 ALTER TABLE `duels` DISABLE KEYS */;
INSERT INTO `duels` VALUES ('13',2,'YES');
/*!40000 ALTER TABLE `duels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id_usernotif` int(11) DEFAULT NULL,
  `id_report` varchar(10) DEFAULT NULL,
  `id_duels` varchar(10) DEFAULT NULL,
  KEY `id_usernotif` (`id_usernotif`),
  KEY `id_report` (`id_report`),
  KEY `id_duels` (`id_duels`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`id_usernotif`) REFERENCES `user` (`id_user`),
  CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`id_report`) REFERENCES `reports` (`id_report`),
  CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`id_duels`) REFERENCES `duels` (`id_duels`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'10','13');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id_post` varchar(10) NOT NULL,
  `id_userpost` int(11) DEFAULT NULL,
  `post_text` varchar(140) DEFAULT NULL,
  `post_time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_userpost` (`id_userpost`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_userpost`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES ('89',2,'Soy el segundo XDxdxdDXDXdxdxdXdxD','2017-05-25 04:06'),('90',1,'Soy el primero XDxdxdDXDXdxdxdXdxD','2017-05-25 04:06');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id_report` varchar(10) NOT NULL,
  `report_text` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_report`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES ('10','Este tipo dibuja tuneles bien chidos');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `rname` varchar(20) DEFAULT NULL,
  `b_day` char(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `wgames` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (0,'Chuchinloco','derp12345','Chucho','2017-05-08','elchiucho@hotmail.com',0),(1,'willy','12345','gilberto','2000-07-21','wilbe@hotmail.com',90),(2,'rody','12345','rodrigo','2000-08-21','rodym@hotmail.com',90),(3,'traodsf','pelopelo0','moysdf','2017-05-03','porase@hotmail.com',0),(4,'Chuchinsd','derp12345','opsdf','2017-05-08','elchiucasd@hotmail.com',0),(5,'eragondan','1534037c','Daniel','2000-07-21','eragond@hotmail.com',0),(6,'eltakalco','calzones39','checo','2000-04-11','katagirib@outlook.com',0),(7,'moymals','eltakoloco0','Moyeelco','1222-02-16','soyelmoy@gmail.com',0),(8,'asdfas','redlop','andres','2000-05-21','dsfasdf@hotmail.com',0),(9,'pepolon','soypepo','fuelos','2000-12-12','rtaos@hotmail.com',0),(10,'dalsim','pepeloco','dalsof','2000-07-21','eldalsof@hotmail.com',0),(11,'pericoloso','386806a2','peroas','1033-05-21','elpros@hotmail.com',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-26 18:51:30
