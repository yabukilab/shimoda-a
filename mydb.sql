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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_history`
--

LOCK TABLES `price_history` WRITE;
/*!40000 ALTER TABLE `price_history` DISABLE KEYS */;
INSERT INTO `price_history` VALUES (9,2,6,235,NULL,NULL,'2025-07-05 15:37:20'),(10,3,6,483,NULL,NULL,'2025-07-05 15:37:20'),(11,4,6,192,NULL,NULL,'2025-07-05 15:37:20'),(12,5,6,900,600,NULL,'2025-07-05 15:37:20'),(13,6,6,670,NULL,NULL,'2025-07-05 15:37:20'),(14,7,6,483,NULL,NULL,'2025-07-05 15:37:20'),(15,8,6,235,NULL,NULL,'2025-07-05 15:37:20'),(16,9,6,78,NULL,NULL,'2025-07-05 15:37:20'),(17,10,6,192,NULL,NULL,'2025-07-05 15:37:20'),(18,11,6,95,NULL,NULL,'2025-07-05 15:37:20'),(19,12,6,41,NULL,NULL,'2025-07-05 15:37:20'),(20,13,6,203,NULL,NULL,'2025-07-05 15:37:20'),(21,14,6,257,NULL,NULL,'2025-07-05 15:37:20'),(22,15,6,332,NULL,NULL,'2025-07-05 15:37:20'),(23,16,6,170,NULL,NULL,'2025-07-05 15:37:20'),(24,17,6,278,NULL,NULL,'2025-07-05 15:37:20'),(25,18,6,127,NULL,NULL,'2025-07-05 15:37:20'),(26,19,6,224,NULL,NULL,'2025-07-05 15:37:20'),(27,20,6,170,NULL,NULL,'2025-07-05 15:37:20'),(28,21,6,95,NULL,NULL,'2025-07-05 15:37:20'),(29,22,6,203,NULL,NULL,'2025-07-05 15:37:20'),(30,23,6,602,NULL,NULL,'2025-07-05 15:37:20'),(31,24,6,591,NULL,NULL,'2025-07-05 15:37:20'),(32,25,6,278,NULL,NULL,'2025-07-05 15:37:20'),(33,26,6,235,NULL,NULL,'2025-07-05 15:37:20'),(34,27,6,354,NULL,NULL,'2025-07-05 15:37:20'),(35,28,6,481,NULL,NULL,'2025-07-05 15:37:20'),(36,29,6,138,NULL,NULL,'2025-07-05 15:37:20'),(37,30,6,138,NULL,NULL,'2025-07-05 15:37:20'),(38,31,6,393,NULL,NULL,'2025-07-05 15:37:20'),(39,32,6,95,NULL,NULL,'2025-07-05 15:37:20'),(40,33,6,224,NULL,NULL,'2025-07-05 15:37:20'),(41,34,6,429,NULL,NULL,'2025-07-05 15:37:20'),(42,35,6,213,NULL,NULL,'2025-07-05 15:37:20');
/*!40000 ALTER TABLE `price_history` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (5,2,6,235,NULL,NULL,'6-2.webp','2025-07-05 05:53:33'),(6,3,6,483,NULL,NULL,'6-3.webp','2025-07-05 05:53:33'),(7,4,6,192,NULL,NULL,'6-4.webp','2025-07-05 05:53:33'),(8,5,6,900,600,NULL,'6-5.webp','2025-07-05 05:53:33'),(9,6,6,670,NULL,NULL,'6-6.webp','2025-07-05 05:53:33'),(10,7,6,483,NULL,NULL,'6-7.webp','2025-07-05 05:53:33'),(11,8,6,235,NULL,NULL,'6-8.webp','2025-07-05 05:53:33'),(12,9,6,78,NULL,NULL,'6-9.webp','2025-07-05 05:53:33'),(13,10,6,192,NULL,NULL,'6-10.webp','2025-07-05 05:53:33'),(14,11,6,95,NULL,NULL,'6-11.webp','2025-07-05 05:53:33'),(15,12,6,41,NULL,NULL,'6-12.webp','2025-07-05 05:53:33'),(16,13,6,203,NULL,NULL,'6-13.webp','2025-07-05 05:53:33'),(17,14,6,257,NULL,NULL,'6-14.webp','2025-07-05 05:53:33'),(18,15,6,332,NULL,NULL,'6-15.webp','2025-07-05 05:53:33'),(19,16,6,170,NULL,NULL,'6-16.webp','2025-07-05 05:53:33'),(20,17,6,278,NULL,NULL,'6-17.webp','2025-07-05 05:53:33'),(21,18,6,127,NULL,NULL,'6-18.webp','2025-07-05 05:53:33'),(22,19,6,224,NULL,NULL,'6-19.webp','2025-07-05 05:53:33'),(23,20,6,170,NULL,NULL,'6-20.webp','2025-07-05 05:53:33'),(24,21,6,95,NULL,NULL,'6-21.webp','2025-07-05 05:53:33'),(25,22,6,203,NULL,NULL,'6-22.webp','2025-07-05 05:53:33'),(26,23,6,602,NULL,NULL,'6-23.webp','2025-07-05 05:53:33'),(27,24,6,591,NULL,NULL,'6-24.webp','2025-07-05 05:53:33'),(28,25,6,278,NULL,NULL,'6-25.webp','2025-07-05 05:53:33'),(29,26,6,235,NULL,NULL,'6-26.webp','2025-07-05 06:00:44'),(30,27,6,354,NULL,NULL,'6-27.webp','2025-07-05 06:00:44'),(31,28,6,481,NULL,NULL,'6-28.webp','2025-07-05 06:00:44'),(32,29,6,138,NULL,NULL,'6-29.webp','2025-07-05 06:00:44'),(33,30,6,138,NULL,NULL,'6-30.webp','2025-07-05 06:00:44'),(34,31,6,393,NULL,NULL,'6-31.webp','2025-07-05 06:00:44'),(35,32,6,95,NULL,NULL,'6-32.webp','2025-07-05 06:00:44'),(36,33,6,224,NULL,NULL,'6-33.webp','2025-07-05 06:00:44'),(37,34,6,429,NULL,NULL,'6-34.webp','2025-07-05 06:00:44'),(38,35,6,213,NULL,NULL,'6-35.webp','2025-07-05 06:00:44');
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

-- Dump completed on 2025-07-05 15:38:15
