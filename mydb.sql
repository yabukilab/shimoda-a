-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: shimoda_a
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
-- Table structure for table `price_history`
--

DROP TABLE IF EXISTS `price_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_history` (
  `history_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `recorded_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`history_id`),
  KEY `product_id` (`product_id`),
  KEY `store_id` (`store_id`),
  CONSTRAINT `price_history_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `price_history_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_history`
--

LOCK TABLES `price_history` WRITE;
/*!40000 ALTER TABLE `price_history` DISABLE KEYS */;
INSERT INTO `price_history` VALUES (9,2,6,235,NULL,NULL,'2025-07-05 15:37:20'),(10,3,6,483,NULL,NULL,'2025-07-05 15:37:20'),(11,4,6,192,NULL,NULL,'2025-07-05 15:37:20'),(12,5,6,900,600,NULL,'2025-07-05 15:37:20'),(13,6,6,670,NULL,NULL,'2025-07-05 15:37:20'),(14,7,6,483,NULL,NULL,'2025-07-05 15:37:20'),(15,8,6,235,NULL,NULL,'2025-07-05 15:37:20'),(16,9,6,78,NULL,NULL,'2025-07-05 15:37:20'),(17,10,6,192,NULL,NULL,'2025-07-05 15:37:20'),(18,11,6,95,NULL,NULL,'2025-07-05 15:37:20'),(19,12,6,41,NULL,NULL,'2025-07-05 15:37:20'),(20,13,6,203,NULL,NULL,'2025-07-05 15:37:20'),(21,14,6,257,NULL,NULL,'2025-07-05 15:37:20'),(22,15,6,332,NULL,NULL,'2025-07-05 15:37:20'),(23,16,6,170,NULL,NULL,'2025-07-05 15:37:20'),(24,17,6,278,NULL,NULL,'2025-07-05 15:37:20'),(25,18,6,127,NULL,NULL,'2025-07-05 15:37:20'),(26,19,6,224,NULL,NULL,'2025-07-05 15:37:20'),(27,20,6,170,NULL,NULL,'2025-07-05 15:37:20'),(28,21,6,95,NULL,NULL,'2025-07-05 15:37:20'),(29,22,6,203,NULL,NULL,'2025-07-05 15:37:20'),(30,23,6,602,NULL,NULL,'2025-07-05 15:37:20'),(31,24,6,591,NULL,NULL,'2025-07-05 15:37:20'),(32,25,6,278,NULL,NULL,'2025-07-05 15:37:20'),(33,26,6,235,NULL,NULL,'2025-07-05 15:37:20'),(34,27,6,354,NULL,NULL,'2025-07-05 15:37:20'),(35,28,6,481,NULL,NULL,'2025-07-05 15:37:20'),(36,29,6,138,NULL,NULL,'2025-07-05 15:37:20'),(37,30,6,138,NULL,NULL,'2025-07-05 15:37:20'),(38,31,6,393,NULL,NULL,'2025-07-05 15:37:20'),(39,32,6,95,NULL,NULL,'2025-07-05 15:37:20'),(40,33,6,224,NULL,NULL,'2025-07-05 15:37:20'),(41,34,6,429,NULL,NULL,'2025-07-05 15:37:20'),(42,35,6,213,NULL,NULL,'2025-07-05 15:37:20'),(43,2,7,203,NULL,NULL,'2025-07-05 16:44:14'),(44,3,7,418,NULL,NULL,'2025-07-05 16:44:14'),(45,4,7,227,NULL,NULL,'2025-07-05 16:44:14'),(46,5,7,550,280,NULL,'2025-07-05 16:44:14'),(47,6,7,675,NULL,NULL,'2025-07-05 16:44:14'),(48,7,7,461,NULL,NULL,'2025-07-05 16:44:14'),(49,8,7,295,NULL,NULL,'2025-07-05 16:44:14'),(50,9,7,101,NULL,NULL,'2025-07-05 16:44:14'),(51,10,7,182,NULL,NULL,'2025-07-05 16:44:14'),(52,11,7,101,NULL,NULL,'2025-07-05 16:44:14'),(53,12,7,25,NULL,NULL,'2025-07-05 16:44:14'),(54,13,7,309,NULL,NULL,'2025-07-05 16:44:14'),(55,14,7,247,NULL,NULL,'2025-07-05 16:44:14'),(56,15,7,269,NULL,NULL,'2025-07-05 16:44:14'),(57,16,7,163,NULL,NULL,'2025-07-05 16:44:14'),(58,17,7,428,NULL,NULL,'2025-07-05 16:44:14'),(59,18,7,115,NULL,NULL,'2025-07-05 16:44:14'),(60,19,7,197,NULL,NULL,'2025-07-05 16:52:49'),(61,20,7,123,NULL,NULL,'2025-07-05 16:52:49'),(62,21,7,100,NULL,NULL,'2025-07-05 16:52:49'),(63,22,7,187,NULL,NULL,'2025-07-05 16:52:49'),(64,23,7,520,NULL,NULL,'2025-07-05 16:52:49'),(65,24,7,409,NULL,NULL,'2025-07-05 16:52:49'),(66,25,7,268,NULL,NULL,'2025-07-05 16:52:49'),(67,26,7,355,NULL,NULL,'2025-07-05 16:52:49'),(68,27,7,216,NULL,NULL,'2025-07-05 16:52:49'),(69,28,7,378,NULL,NULL,'2025-07-05 16:52:49'),(70,29,7,139,NULL,NULL,'2025-07-05 16:52:49'),(71,30,7,114,NULL,NULL,'2025-07-05 16:52:49'),(72,31,7,256,NULL,NULL,'2025-07-05 16:52:49'),(73,32,7,96,NULL,NULL,'2025-07-05 16:52:49'),(74,33,7,214,NULL,NULL,'2025-07-05 16:52:49'),(75,34,7,293,NULL,NULL,'2025-07-05 16:52:49'),(76,35,7,214,NULL,NULL,'2025-07-05 16:52:49');
/*!40000 ALTER TABLE `price_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_weekly_avg`
--

DROP TABLE IF EXISTS `price_weekly_avg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_weekly_avg` (
  `avg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `average_price` decimal(10,2) NOT NULL,
  `average_period_start` date NOT NULL,
  `average_period_end` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`avg_id`),
  KEY `product_id` (`product_id`),
  KEY `store_id` (`store_id`),
  CONSTRAINT `price_weekly_avg_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `price_weekly_avg_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_weekly_avg`
--

LOCK TABLES `price_weekly_avg` WRITE;
/*!40000 ALTER TABLE `price_weekly_avg` DISABLE KEYS */;
/*!40000 ALTER TABLE `price_weekly_avg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prices` (
  `price_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`price_id`),
  UNIQUE KEY `product_id` (`product_id`,`store_id`),
  KEY `store_id` (`store_id`),
  CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `prices_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (5,2,6,235,NULL,NULL,'6-2.webp','2025-07-05 05:53:33'),(6,3,6,483,NULL,NULL,'6-3.webp','2025-07-05 05:53:33'),(7,4,6,192,NULL,NULL,'6-4.webp','2025-07-05 05:53:33'),(8,5,6,900,600,NULL,'6-5.webp','2025-07-05 05:53:33'),(9,6,6,670,NULL,NULL,'6-6.webp','2025-07-05 05:53:33'),(10,7,6,483,NULL,NULL,'6-7.webp','2025-07-05 05:53:33'),(11,8,6,235,NULL,NULL,'6-8.webp','2025-07-05 05:53:33'),(12,9,6,78,NULL,NULL,'6-9.webp','2025-07-05 05:53:33'),(13,10,6,192,NULL,NULL,'6-10.webp','2025-07-05 05:53:33'),(14,11,6,95,NULL,NULL,'6-11.webp','2025-07-05 05:53:33'),(15,12,6,41,NULL,NULL,'6-12.webp','2025-07-05 05:53:33'),(16,13,6,203,NULL,NULL,'6-13.webp','2025-07-05 05:53:33'),(17,14,6,257,NULL,NULL,'6-14.webp','2025-07-05 05:53:33'),(18,15,6,332,NULL,NULL,'6-15.webp','2025-07-05 05:53:33'),(19,16,6,170,NULL,NULL,'6-16.webp','2025-07-05 05:53:33'),(20,17,6,278,NULL,NULL,'6-17.webp','2025-07-05 05:53:33'),(21,18,6,127,NULL,NULL,'6-18.webp','2025-07-05 05:53:33'),(22,19,6,224,NULL,NULL,'6-19.webp','2025-07-05 05:53:33'),(23,20,6,170,NULL,NULL,'6-20.webp','2025-07-05 05:53:33'),(24,21,6,95,NULL,NULL,'6-21.webp','2025-07-05 05:53:33'),(25,22,6,203,NULL,NULL,'6-22.webp','2025-07-05 05:53:33'),(26,23,6,602,NULL,NULL,'6-23.webp','2025-07-05 05:53:33'),(27,24,6,591,NULL,NULL,'6-24.webp','2025-07-05 05:53:33'),(28,25,6,278,NULL,NULL,'6-25.webp','2025-07-05 05:53:33'),(29,26,6,235,NULL,NULL,'6-26.webp','2025-07-05 06:00:44'),(30,27,6,354,NULL,NULL,'6-27.webp','2025-07-05 06:00:44'),(31,28,6,481,NULL,NULL,'6-28.webp','2025-07-05 06:00:44'),(32,29,6,138,NULL,NULL,'6-29.webp','2025-07-05 06:00:44'),(33,30,6,138,NULL,NULL,'6-30.webp','2025-07-05 06:00:44'),(34,31,6,393,NULL,NULL,'6-31.webp','2025-07-05 06:00:44'),(35,32,6,95,NULL,NULL,'6-32.webp','2025-07-05 06:00:44'),(36,33,6,224,NULL,NULL,'6-33.webp','2025-07-05 06:00:44'),(37,34,6,429,NULL,NULL,'6-34.webp','2025-07-05 06:00:44'),(38,35,6,213,NULL,NULL,'6-35.webp','2025-07-05 06:00:44'),(39,2,7,203,NULL,NULL,'702.jpg','2025-07-05 07:24:21'),(40,3,7,418,NULL,NULL,'703.jpg','2025-07-05 07:24:21'),(41,4,7,227,NULL,NULL,'704.jpg','2025-07-05 07:24:21'),(42,5,7,550,280,NULL,'705.jpg','2025-07-05 07:24:21'),(43,6,7,675,NULL,NULL,'706.jpg','2025-07-05 07:24:21'),(44,7,7,461,NULL,NULL,'707.jpg','2025-07-05 07:24:21'),(45,8,7,295,NULL,NULL,'708.jpg','2025-07-05 07:24:21'),(46,9,7,101,NULL,NULL,'709.jpg','2025-07-05 07:24:21'),(47,10,7,182,NULL,NULL,'710.jpg','2025-07-05 07:24:21'),(48,11,7,101,NULL,NULL,'711.jpg','2025-07-05 07:24:21'),(49,12,7,25,NULL,NULL,'712.jpg','2025-07-05 07:24:21'),(50,13,7,309,NULL,NULL,'713.jpg','2025-07-05 07:24:21'),(51,14,7,247,NULL,NULL,'714.jpg','2025-07-05 07:24:21'),(52,15,7,269,NULL,NULL,'715.jpg','2025-07-05 07:24:21'),(53,16,7,163,NULL,NULL,'716.jpg','2025-07-05 07:24:21'),(54,17,7,428,NULL,NULL,'717.jpg','2025-07-05 07:34:33'),(55,18,7,115,NULL,NULL,'718.jpg','2025-07-05 07:34:33'),(56,19,7,197,NULL,NULL,'719.jpg','2025-07-05 07:34:33'),(57,20,7,123,NULL,NULL,'720.jpg','2025-07-05 07:34:33'),(58,21,7,100,NULL,NULL,'721.jpg','2025-07-05 07:34:33'),(59,22,7,187,NULL,NULL,'722.jpg','2025-07-05 07:34:33'),(60,23,7,520,NULL,NULL,'723.jpg','2025-07-05 07:34:33'),(61,24,7,409,NULL,NULL,'724.jpg','2025-07-05 07:34:33'),(62,25,7,268,NULL,NULL,'725.jpg','2025-07-05 07:34:33'),(63,26,7,355,NULL,NULL,'726.jpg','2025-07-05 07:34:33'),(64,27,7,216,NULL,NULL,'727.jpg','2025-07-05 07:34:33'),(65,28,7,378,NULL,NULL,'728.jpg','2025-07-05 07:34:33'),(66,29,7,139,NULL,NULL,'729.jpg','2025-07-05 07:34:33'),(67,30,7,114,NULL,NULL,'730.jpg','2025-07-05 07:34:33'),(68,31,7,256,NULL,NULL,'731.jpg','2025-07-05 07:34:33'),(69,32,7,96,NULL,NULL,'732.jpg','2025-07-05 07:34:33'),(70,33,7,214,NULL,NULL,'733.jpg','2025-07-05 07:34:33'),(71,34,7,293,NULL,NULL,'734.jpg','2025-07-05 07:34:33'),(72,35,7,214,NULL,NULL,'735.jpg','2025-07-05 07:34:33');
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,'超熟 6枚切り'),(3,'マ・マー 500g'),(4,'日清食品 カップヌードル'),(5,'鶏もも肉'),(6,'鮭(切り身)'),(7,'シャウエッセン'),(8,'味の素 冷凍ギョーザ'),(9,'国産玉ねぎ'),(10,'国産キャベツ'),(11,'国産にんじん'),(12,'国産もやし 200g'),(13,'海外産バナナ'),(14,'国産大根'),(15,'おいしい牛乳900ml'),(16,'明治 ブルガリアヨーグルト 400g'),(17,'雪印 スライスチーズ 7枚入り'),(18,'サントリー 天然水 2L'),(19,'コカ・コーラ 1.5L'),(20,'ジョージア カフェラテ 500ml'),(21,'サントリー 伊右衛門 600ml'),(22,'ボンカレーゴールド 中辛'),(23,'サッポロ一番 しょうゆ 5食入り'),(24,'キッコーマン 特選丸大豆しょうゆ 750ml'),(25,'カゴメ ケチャップ 500g'),(26,'ピュアセレクト 400g'),(27,'伯方の塩 500g'),(28,'サランラップ 22cm*50m'),(29,'雪印メグミルク なめらかプリン 70g*3'),(30,'エッセル スーパーカップ'),(31,'スコッティ カシミヤ ティッシュ'),(32,'おかめ納豆 極小粒ミニ 50g*3'),(33,'国産ブロッコリー'),(34,'ミツカン カンタン酢'),(35,'国産ほうれん草');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores` (
  `store_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `store_name` varchar(100) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (5,'イオン'),(6,'イトーヨーカドー'),(7,'Amazon'),(8,'ライフ');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-05 23:31:08
