-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bbs
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `boards`
--

DROP TABLE IF EXISTS `boards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boards` (
  `board_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `faculty` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`board_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boards`
--

LOCK TABLES `boards` WRITE;
/*!40000 ALTER TABLE `boards` DISABLE KEYS */;
INSERT INTO `boards` VALUES (22,'機械工学科',NULL,'工学部'),(23,'先端材料工学科',NULL,'工学部'),(24,'電気電子工学科',NULL,'工学部'),(25,'情報通信システム工学科',NULL,'工学部'),(26,'応用科学科',NULL,'工学部'),(27,'機械電子創成工学科',NULL,'工学部'),(28,'建築学科',NULL,'創造工学部'),(29,'デザイン科学学科',NULL,'創造工学部'),(30,'都市環境工学科',NULL,'創造工学部'),(31,'未来ロボティクス学科',NULL,'先進工学部'),(32,'生命学科',NULL,'先進工学部'),(33,'知能メディア工学科',NULL,'先進工学部'),(34,'情報工学科',NULL,'情報変革科学部'),(35,'認知情報科学科',NULL,'情報変革科学部'),(36,'高度応用情報科学科',NULL,'情報変革科学部'),(37,'情報工学科',NULL,'情報科学部'),(38,'情報ネットワーク学科',NULL,'情報科学部'),(39,'デジタル変革科学科',NULL,'未来変革科学部'),(40,'経営デザイン科学科',NULL,'未来変革科学部'),(41,'経営情報科学科',NULL,'社会システム科学部'),(42,'プロジェクトマネジメント学科',NULL,'社会システム科学部'),(43,'金融・経営リスク科学科',NULL,'社会システム科学部');
/*!40000 ALTER TABLE `boards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '名無しの千葉工大生',
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `helpful_count` int(11) DEFAULT 0,
  `report_count` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (36,18,'名無しの千葉工大生','囚人','2024-05-09 03:25:53',0,0),(37,18,'おねがい','ああ','2024-05-09 03:26:05',0,0),(38,18,'おねがい','ああ','2024-05-09 03:26:09',0,0),(39,18,'名無しの千葉工大生','囚人','2024-05-09 03:26:15',0,0),(40,18,'jii','nk','2024-05-10 03:15:26',0,0),(41,20,'fsdf','sdfsdf','2024-05-10 05:32:25',0,0),(42,22,'おねがい','aaaaaaaaaaaaaaaaaaa','2024-05-10 07:12:38',0,0),(43,24,'dsd','dfsa','2024-05-17 05:53:36',25,0),(44,24,'名無しの千葉工大生','ちゅき','2024-05-17 06:02:09',0,0),(45,24,'名無しの千葉工大生','ちゅき','2024-05-17 06:02:16',0,0),(46,24,'名無しの千葉工大生','いっぱいちゅき','2024-05-17 06:02:29',0,0),(47,23,'名無しの千葉工大生','革命','2024-05-23 05:19:26',0,0),(48,23,'名無しの千葉工大生','運命','2024-05-23 05:19:30',0,0),(49,30,'しね','しね','2024-06-07 20:30:08',0,0),(50,29,'ewq','eq','2024-06-07 20:36:21',0,0),(51,28,'ewq','qew','2024-06-07 20:36:30',8,0),(52,32,'a','a','2024-06-20 05:25:49',0,0),(53,33,'dfs','afs','2024-06-20 05:28:02',5,0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `board_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_code` varchar(255) DEFAULT NULL,
  `post_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`thread_id`),
  KEY `board_id` (`board_id`),
  CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `boards` (`board_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (27,25,'ぱぱ','あか',NULL,'2024-06-07 15:20:49'),(28,26,'ｆｓ','ｆｓ',NULL,'2024-06-08 05:20:21'),(29,26,'れｗ','うぇｒ',NULL,'2024-06-08 05:20:46'),(30,36,'えｒｗ','れｗ',NULL,'2024-06-08 05:25:33'),(31,42,'ewq','eq',NULL,'2024-06-08 05:37:45'),(32,23,'a','a',NULL,'2024-06-20 14:25:41'),(33,23,'ff','ff',NULL,'2024-06-20 14:27:57'),(35,23,'tiki','syo',NULL,'2024-06-21 15:44:17'),(36,23,'pya','pya',NULL,'2024-06-21 15:55:40'),(37,23,'a','a',NULL,'2024-06-21 16:08:45');
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-27 13:26:16
