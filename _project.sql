-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: _project
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB
-- Server version	10.4.18-MariaDB

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
-- Table structure for table `acount_data`
--

DROP TABLE IF EXISTS `acount_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acount_data` (
  `date` date DEFAULT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acount_data`
--

LOCK TABLES `acount_data` WRITE;
/*!40000 ALTER TABLE `acount_data` DISABLE KEYS */;
INSERT INTO `acount_data` VALUES ('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-06-30',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-02',0),('2021-07-04',0),('2021-07-04',0),('2021-07-04',0),('2021-07-04',0),('2021-07-06',0),('2021-07-06',0),('2021-07-06',0),('2021-07-07',0),('2021-07-07',0),('2021-07-07',0),('2021-07-08',0),('2021-07-08',0),('2021-07-08',0),('2021-07-08',0),('2021-07-08',0),('2021-07-08',0),(NULL,2021),(NULL,2021),('2021-07-08',0),('2021-07-08',0),(NULL,2021),(NULL,2021),('2021-07-08',0),('2021-07-08',0),(NULL,1),(NULL,1),('2021-07-08',0),('2021-07-08',0),(NULL,1),(NULL,1),('2021-07-08',0),('2021-07-08',0),(NULL,2),(NULL,2),('2021-07-08',0),('2021-07-08',0),(NULL,2),(NULL,2),('2021-07-08',0),('2021-07-08',0),(NULL,2),(NULL,2),(NULL,0),('2021-07-08',0),('2021-07-08',0),(NULL,2),(NULL,2),('2021-07-08',0),('2021-07-08',0),(NULL,2),(NULL,2),('2021-07-08',0),('2021-07-08',0),(NULL,2),(NULL,2),('2021-07-08',0),('2021-07-08',0),(NULL,2),(NULL,2),('2021-07-08',0),('2021-07-08',0),(NULL,2),(NULL,2),('2021-07-09',0),('2021-07-09',0),(NULL,11),(NULL,11),('2021-07-09',0),('2021-07-09',0),(NULL,11),(NULL,11),('2021-07-09',0),('2021-07-09',0),(NULL,12),(NULL,12),('2021-07-09',0),('2021-07-09',0),(NULL,2),(NULL,2);
/*!40000 ALTER TABLE `acount_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_data`
--

DROP TABLE IF EXISTS `login_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_data` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_data`
--

LOCK TABLES `login_data` WRITE;
/*!40000 ALTER TABLE `login_data` DISABLE KEYS */;
INSERT INTO `login_data` VALUES (1,'chiba','koudai');
/*!40000 ALTER TABLE `login_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mst_product`
--

DROP TABLE IF EXISTS `mst_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mst_product` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `gazou` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `flag` int(11) NOT NULL,
  `letter` int(11) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mst_product`
--

LOCK TABLES `mst_product` WRITE;
/*!40000 ALTER TABLE `mst_product` DISABLE KEYS */;
INSERT INTO `mst_product` VALUES (1,'きゃべつ',100,'',NULL,0,0),(2,'とまと',1000,'',NULL,0,0),(3,'みかん',500,'',NULL,0,0),(4,'すいか',200,'',NULL,0,0),(9,'ごぼう',100,'',NULL,0,0),(17,'おれ',1100000,'天音かなたん.jpg',NULL,0,0);
/*!40000 ALTER TABLE `mst_product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-09 14:44:50
