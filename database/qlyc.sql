-- MySQL dump 10.13  Distrib 5.7.10, for Linux (x86_64)
--
-- Host: localhost    Database: homestead
-- ------------------------------------------------------
-- Server version	5.7.10

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'ANQG','An ninh quốc gia','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(2,'HN','Hiềm nghi','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(3,'ST','Sưu tra','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(4,'LQANQG','System auto create','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(5,'TX','System auto create','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(6,'TN','System auto create','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(7,'CA','System auto create','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(8,'QLNV','System auto create','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ship_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original-name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content-type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `files_ship_id_foreign` (`ship_id`),
  CONSTRAINT `files_ship_id_foreign` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kinds`
--

DROP TABLE IF EXISTS `kinds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kinds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kinds`
--

LOCK TABLES `kinds` WRITE;
/*!40000 ALTER TABLE `kinds` DISABLE KEYS */;
INSERT INTO `kinds` VALUES (1,'HS','Hình sự','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(2,'MT','Ma túy','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(3,'PĐ','Phản động','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(4,'KT','Kinh Tế','2016-09-11 17:54:14','2016-09-13 08:26:52',NULL);
/*!40000 ALTER TABLE `kinds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `receive_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_number` int(11) NOT NULL,
  `date_submit` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lists_phone_id_foreign` (`phone_id`),
  KEY `lists_user_id_foreign` (`user_id`),
  CONSTRAINT `lists_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`),
  CONSTRAINT `lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lists`
--

LOCK TABLES `lists` WRITE;
/*!40000 ALTER TABLE `lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_12_23_074105_create_purposes_table',1),('2015_12_23_074244_create_kinds_table',1),('2015_12_23_074348_create_categories_table',1),('2015_12_23_074506_create_units_table',1),('2015_12_23_075036_create_orders_table',1),('2015_12_23_075530_create_phones_table',1),('2015_12_23_081854_create_order_purpose_table',1),('2015_12_23_082501_create_lists_table',1),('2015_12_23_082501_create_ships_table',1),('2016_01_26_012335_create_ships_news_table',1),('2016_02_17_111310_create_news_table',1),('2016_02_17_185410_create_files_table',1),('2016_03_21_145050_create_networks_table',1),('2016_03_21_145343_create_network_ship_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `network_ship`
--

DROP TABLE IF EXISTS `network_ship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `network_ship` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ship_id` int(10) unsigned NOT NULL,
  `network_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `network_ship_ship_id_foreign` (`ship_id`),
  KEY `network_ship_network_id_foreign` (`network_id`),
  CONSTRAINT `network_ship_network_id_foreign` FOREIGN KEY (`network_id`) REFERENCES `networks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `network_ship_ship_id_foreign` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `network_ship`
--

LOCK TABLES `network_ship` WRITE;
/*!40000 ALTER TABLE `network_ship` DISABLE KEYS */;
/*!40000 ALTER TABLE `network_ship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `networks`
--

DROP TABLE IF EXISTS `networks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `networks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `networks`
--

LOCK TABLES `networks` WRITE;
/*!40000 ALTER TABLE `networks` DISABLE KEYS */;
INSERT INTO `networks` VALUES (1,'viettel','2016-09-11 17:44:30','2016-09-11 17:44:30'),(2,'vinaphone','2016-09-11 17:44:30','2016-09-11 17:44:30'),(3,'mobifone','2016-09-11 17:44:30','2016-09-11 17:44:30');
/*!40000 ALTER TABLE `networks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `number_cv_pa71` int(11) NOT NULL,
  `receive_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_number` int(11) NOT NULL,
  `number_news` int(11) NOT NULL,
  `date_submit` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_phone_id_foreign` (`phone_id`),
  KEY `news_user_id_foreign` (`user_id`),
  CONSTRAINT `news_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`),
  CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_purpose`
--

DROP TABLE IF EXISTS `order_purpose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_purpose` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `purpose_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_purpose_order_id_foreign` (`order_id`),
  KEY `order_purpose_purpose_id_foreign` (`purpose_id`),
  CONSTRAINT `order_purpose_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_purpose_purpose_id_foreign` FOREIGN KEY (`purpose_id`) REFERENCES `purposes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_purpose`
--

LOCK TABLES `order_purpose` WRITE;
/*!40000 ALTER TABLE `order_purpose` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_purpose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `kind_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `unit_id` int(10) unsigned NOT NULL,
  `purpose_id` int(10) unsigned NOT NULL,
  `number_cv` int(11) NOT NULL,
  `number_cv_pa71` int(11) NOT NULL,
  `order_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `manager` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_order` date NOT NULL,
  `date_begin` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_kind_id_foreign` (`kind_id`),
  KEY `orders_category_id_foreign` (`category_id`),
  KEY `orders_unit_id_foreign` (`unit_id`),
  KEY `orders_purpose_id_foreign` (`purpose_id`),
  CONSTRAINT `orders_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `orders_kind_id_foreign` FOREIGN KEY (`kind_id`) REFERENCES `kinds` (`id`),
  CONSTRAINT `orders_purpose_id_foreign` FOREIGN KEY (`purpose_id`) REFERENCES `purposes` (`id`),
  CONSTRAINT `orders_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,2,2,4,4,389,709,'aaaa','','Tùng','982335926','','aaaa','',NULL,'2016-09-11','2015-11-23','2016-01-30','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(2,1,3,4,1,4,87,709,'bbbbbbbb','','Đức Anh','3890234','','bbbbbbbb','',NULL,'2016-09-11','2015-11-26','2016-02-26','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(3,1,2,2,4,4,389,709,'ccccccccccc','','Tùng','0982335926','','ccccccccccc','',NULL,'2016-09-11','2015-11-23','2016-01-30','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(4,1,1,2,5,4,271,737,'dddddddddd','','Tiến Dũng','0972046510','','dddddddddd','',NULL,'2016-09-11','2015-07-12','2016-10-02','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(5,1,1,2,5,4,272,737,'eeeeeeeeee','','Tiến Dũng','0972046510','','eeeeeeeeee','',NULL,'2016-09-11','2015-07-12','2016-10-02','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(6,1,NULL,NULL,1,2,88,712,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(7,1,NULL,NULL,1,2,89,748,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(8,1,NULL,NULL,1,2,90,750,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(9,1,NULL,NULL,3,2,154,771,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(10,1,NULL,NULL,1,2,468,792,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(11,1,NULL,NULL,3,2,60,932,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(12,1,NULL,NULL,1,2,17,932,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(13,1,NULL,NULL,1,2,18,932,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(14,1,NULL,NULL,3,2,56,932,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(15,1,NULL,NULL,3,2,57,932,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(16,1,NULL,NULL,6,2,15,4,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(17,1,NULL,NULL,3,2,60,932,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(18,1,NULL,NULL,3,2,65,13,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(19,1,NULL,NULL,1,2,19,13,NULL,'',NULL,NULL,'','','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(20,1,1,2,5,1,257,669,'Cao Thanh Hợp','',NULL,NULL,'','cao-thanh-hop','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(21,1,1,5,7,1,218,771,'Nguyễn Văn Minh','',NULL,NULL,'','nguyen-van-minh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(22,1,1,5,7,1,219,771,'Ngô Tất Tố','',NULL,NULL,'','ngo-tat-to','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(23,1,1,5,7,1,220,771,'Nguyễn Huân','',NULL,NULL,'','nguyen-huan','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(24,1,1,5,7,1,221,771,'Nguyễn Văn Quân','',NULL,NULL,'','nguyen-van-quan','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(25,1,1,5,7,1,222,771,'Nguyễn Huân','',NULL,NULL,'','nguyen-huan','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(26,1,1,5,7,1,223,771,'Nguyễn Đình Lanh','',NULL,NULL,'','nguyen-dinh-lanh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(27,1,1,2,6,1,5,762,'Tài Trần Thắng','',NULL,NULL,'','tai-tran-thang','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(28,1,1,5,8,1,42,762,'Trần Trùn Tín','',NULL,NULL,'','tran-trun-tin','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(29,1,1,6,9,1,14,762,'Nguyễn Tuấn Hưng','',NULL,NULL,'','nguyen-tuan-hung','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(30,1,1,7,5,1,279,12,'Trần Thành Đạt','',NULL,NULL,'','tran-thanh-dat','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(31,1,1,5,10,1,217,792,'Trần Chí Thanh','',NULL,NULL,'','tran-chi-thanh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(32,1,1,5,10,1,216,792,'Bùi Văn Tý','',NULL,NULL,'','bui-van-ty','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(33,1,3,1,1,1,93,772,'Nguyễn Thị Hường','',NULL,NULL,'','nguyen-thi-huong','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(34,1,3,1,1,1,95,772,'Chưa rõ','',NULL,NULL,'','chua-ro','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(35,1,3,1,1,1,91,772,'Trần Văn Thành','',NULL,NULL,'','tran-van-thanh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(36,1,3,1,1,1,92,772,'Lê Nam Cao','',NULL,NULL,'','le-nam-cao','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(37,1,1,2,5,1,277,784,'Trần Thanh Tùng','',NULL,NULL,'','tran-thanh-tung','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(38,1,1,2,8,1,55,792,'Trần Anh Tuấn','',NULL,NULL,'','tran-anh-tuan','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(39,1,1,7,2,1,7,792,'Nguyễn Thị Minh Nga','',NULL,NULL,'','nguyen-thi-minh-nga','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(40,1,1,2,6,1,6,785,'Phạm Văn Chiến','',NULL,NULL,'','pham-van-chien','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(41,1,1,6,9,1,23,794,'Đinh Xuân Lương','',NULL,NULL,'','dinh-xuan-luong','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(42,1,1,2,6,1,7,794,'Võ Chí Công','',NULL,NULL,'','vo-chi-cong','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(43,1,1,2,3,1,1,794,'Chưa rõ','',NULL,NULL,'','chua-ro','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(44,1,1,2,3,1,1,818,'Chưa rõ','',NULL,NULL,'','chua-ro','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(45,1,3,1,1,1,103,803,'Hoàng Thị Hiểu','',NULL,NULL,'','hoang-thi-hieu','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(46,1,1,3,8,1,64,827,'Trần Ngọc Thọ','',NULL,NULL,'','tran-ngoc-tho','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(47,1,1,2,11,1,82,818,'Phạm Minh Hải','',NULL,NULL,'','pham-minh-hai','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(48,1,1,2,11,1,83,818,'Phạm Minh Hải','',NULL,NULL,'','pham-minh-hai','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(49,1,1,2,11,1,79,818,'Trần Bá Chúc','',NULL,NULL,'','tran-ba-chuc','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(50,1,1,2,11,1,80,818,'Trần Xuân Hải','',NULL,NULL,'','tran-xuan-hai','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(51,1,1,2,11,1,81,818,'Trần Xuân Hải','',NULL,NULL,'','tran-xuan-hai','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(52,1,1,2,8,1,66,827,'Đinh Xuân Vũ','',NULL,NULL,'','dinh-xuan-vu','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(53,1,1,3,8,1,62,827,'Trần Đình Minh','',NULL,NULL,'','tran-dinh-minh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(54,1,4,6,9,1,34,842,'Hoàng Văn Thắng','',NULL,NULL,'','hoang-van-thang','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(55,1,1,1,1,1,2,857,'Châu','',NULL,NULL,'','chau','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(56,1,1,5,10,1,107,857,'Bùi Xuân Trường','',NULL,NULL,'','bui-xuan-truong','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(57,1,1,2,5,1,281,864,'Lưu Văn Cường','',NULL,NULL,'','luu-van-cuong','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(58,1,3,1,1,1,11,869,'Châu','',NULL,NULL,'','chau','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(59,1,1,3,5,1,280,869,'Trần Văn Bằng','',NULL,NULL,'','tran-van-bang','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(60,1,3,8,1,1,13,879,'Nguyễn Văn Hữu','',NULL,NULL,'','nguyen-van-huu','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(61,1,3,8,1,1,12,879,'Nguyễn Thị Năm','',NULL,NULL,'','nguyen-thi-nam','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(62,1,1,5,6,1,11,879,'Trần Dũng','',NULL,NULL,'','tran-dung','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(63,1,1,3,12,1,2,888,'Đặng Xuân Tương','',NULL,NULL,'','dang-xuan-tuong','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(64,1,1,2,11,1,156,905,'Trần Văn Thanh','',NULL,NULL,'','tran-van-thanh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(65,1,1,5,6,1,13,905,'Nguyễn Văn Dũng','',NULL,NULL,'','nguyen-van-dung','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(66,1,1,2,3,1,28,911,'Mai Xuân Ngọc','',NULL,NULL,'','mai-xuan-ngoc','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(67,1,1,2,3,1,28,911,'Mai Xuân Nam','',NULL,NULL,'','mai-xuan-nam','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(68,1,1,2,8,1,103,911,'Trần Văn Sơn','',NULL,NULL,'','tran-van-son','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(69,1,1,2,8,1,100,911,'Phạm Văn Lợi','',NULL,NULL,'','pham-van-loi','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(70,1,1,2,3,1,28,911,'Mai Xuân Ngọc','',NULL,NULL,'','mai-xuan-ngoc','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(71,1,1,2,3,1,30,911,'Lê Xuân Bách','',NULL,NULL,'','le-xuan-bach','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(72,1,1,2,5,1,5,919,'Lê Tất Thành','',NULL,NULL,'','le-tat-thanh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(73,1,1,2,5,1,4,919,'Lê Tất Thành','',NULL,NULL,'','le-tat-thanh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(74,1,1,5,7,1,33,919,'Nguyễn Xuân Huyên','',NULL,NULL,'','nguyen-xuan-huyen','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(75,1,1,7,3,1,44,924,'Phạm Văn Quyền','',NULL,NULL,'','pham-van-quyen','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(76,1,1,7,3,1,46,924,'Trần Xuân Bảng','',NULL,NULL,'','tran-xuan-bang','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(77,1,1,7,3,1,41,924,'Phạm Văn Lục','',NULL,NULL,'','pham-van-luc','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(78,1,1,7,3,1,42,924,'Phạm Văn Thởi','',NULL,NULL,'','pham-van-thoi','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(79,1,1,7,3,1,49,924,'Đàm Minh Hoa','',NULL,NULL,'','dam-minh-hoa','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(80,1,1,7,3,1,48,924,'Phạm Văn Thoại','',NULL,NULL,'','pham-van-thoai','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(81,1,1,2,8,1,108,924,'Mai Văn Xuân','',NULL,NULL,'','mai-van-xuan','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(82,1,1,2,8,1,107,924,'Mai Văn Xuân','',NULL,NULL,'','mai-van-xuan','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(83,1,1,2,3,1,35,919,'Nguyễn Phú Danh','',NULL,NULL,'','nguyen-phu-danh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(84,1,1,7,3,1,47,924,'Phạm Văn Nghiêm','',NULL,NULL,'','pham-van-nghiem','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(85,1,1,7,3,1,50,924,'Phạm Văn Thởi','',NULL,NULL,'','pham-van-thoi','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(86,1,1,7,3,1,45,924,'Phạm Văn Trị','',NULL,NULL,'','pham-van-tri','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(87,1,1,7,3,1,43,924,'Võ Ngọc Giang','',NULL,NULL,'','vo-ngoc-giang','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(88,1,1,7,3,1,41,924,'Phạm Văn Lực','',NULL,NULL,'','pham-van-luc','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(89,1,1,7,3,1,57,932,'Nguyễn Văn Hùng','',NULL,NULL,'','nguyen-van-hung','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(90,1,2,7,8,1,116,4,'Đinh Xuân Vũ','',NULL,NULL,'','dinh-xuan-vu','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(91,1,2,2,8,1,114,4,'Trần Thị Chiến','',NULL,NULL,'','tran-thi-chien','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(92,1,1,2,11,1,193,35,'Phan Thanh Hữu','',NULL,NULL,'','phan-thanh-huu','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(93,1,1,2,11,1,194,35,'Phan Thanh Hoài','',NULL,NULL,'','phan-thanh-hoai','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(94,1,1,5,6,1,16,4,'Phan Quốc Toàn','',NULL,NULL,'','phan-quoc-toan','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(95,1,1,2,5,1,6,4,'Lê Đức Quỳnh','',NULL,NULL,'','le-duc-quynh','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(96,1,1,6,9,1,81,54,'Dương Đức Trung','',NULL,NULL,'','duong-duc-trung','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(97,1,1,7,11,1,213,54,'Trần Ngọc Lương','',NULL,NULL,'','tran-ngoc-luong','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(98,1,1,6,9,1,80,54,'Hồ Xuân Thiện','',NULL,NULL,'','ho-xuan-thien','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(99,1,1,7,11,1,213,54,'Trần Ngọc Lương','',NULL,NULL,'','tran-ngoc-luong','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(100,1,1,5,8,1,145,61,'Trần Ngọc Hoàn','',NULL,NULL,'','tran-ngoc-hoan','',NULL,'2016-09-11',NULL,NULL,'2016-09-11 17:54:15','2016-09-11 17:54:15',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phones`
--

DROP TABLE IF EXISTS `phones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phones_order_id_foreign` (`order_id`),
  CONSTRAINT `phones_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones`
--

LOCK TABLES `phones` WRITE;
/*!40000 ALTER TABLE `phones` DISABLE KEYS */;
INSERT INTO `phones` VALUES (1,1,'9325530000977630000','warning','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(2,2,'0935207478','warning','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(3,3,'0977638000','warning','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(4,4,'0943615437','success','2016-09-11 17:44:45','2016-09-13 08:36:21',NULL),(5,5,'0916916257','success','2016-09-11 17:44:45','2016-09-13 20:39:05',NULL),(6,6,'123594466101292000000','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(7,7,'0989803419','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(8,8,'01216584828','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(9,9,'0962289613','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(10,10,'01674661101','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(11,11,'0982044045','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(12,12,'0969660917','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(13,13,'01225482525','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(14,14,'01232545999','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(15,15,'01232067888','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(16,16,'0913295622','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(17,17,'0982044045','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(18,18,'0982044045','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(19,19,'0915272286','success','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(20,20,'356951068284987','success','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(21,21,'0911378154','success','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(22,22,'01662789334','success','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(23,23,'01655953846','success','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(24,24,'01636668757','success','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(25,25,'01665081979','success','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(26,26,'0947137123','success','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(27,27,'868573024658087','success','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(28,28,'358916026111000','success','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(29,29,'01686099797','success','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(30,30,'0932181782','success','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(31,31,'01657864088','success','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(32,32,'0976294492','success','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(33,33,'01665155320','success','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(34,34,'01684780991','success','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(35,35,'0964041167','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(36,36,'0973403064','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(37,37,'0944887858','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(38,38,'352192072884421','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(39,39,'0962253939','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(40,40,'0523866772','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(41,41,'0984129377','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(42,42,'01658380231','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(43,43,'0973593159','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(44,44,'0973593159','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(45,45,'0967943227','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(46,46,'01239026232','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(47,47,'0911373062','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(48,48,'0917258528','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(49,49,'0976600396','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(50,50,'0988027119','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(51,51,'01692999411','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(52,52,'0965678930','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(53,53,'980056003880602','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(54,54,'0917120421','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(55,55,'01698111512','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(56,56,'0975423664','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(57,57,'352957071231828','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(58,58,'01646725610','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(59,59,'868791023031136','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(60,60,'0913368456','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(61,61,'0961747467','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(62,62,'0977049221','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(63,63,'0912037835','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(64,64,'0915850998','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(65,65,'801695060839520','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(66,66,'0915322983','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(67,67,'0915519819','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(68,68,'0973472783','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(69,69,'0982868184','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(70,70,'0985800299','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(71,71,'0988688155','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(72,72,'0976979707','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(73,73,'01656480451','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(74,74,'01663681963','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(75,75,'01629262256','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(76,76,'0978894224','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(77,77,'0983646703','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(78,78,'0985404651','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(79,79,'01645142447','success','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(80,80,'01646476361','success','2016-09-11 17:54:14','2016-09-11 17:54:15',NULL),(81,81,'0915812541','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(82,82,'01269422231','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(83,83,'0905913333','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(84,84,'01672608944','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(85,85,'01693528175','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(86,86,'01694044998','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(87,87,'01697878455','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(88,88,'0983646703','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(89,89,'0989477544','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(90,90,'0965795958','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(91,91,'01676589162','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(92,92,'01224586797','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(93,93,'0915026467','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(94,94,'0905381947','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(95,95,'359057061709843','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(96,96,'0917610833','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(97,97,'0948376580','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(98,98,'0969793250','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(99,99,'01637038748','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(100,100,'01634338867','success','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL);
/*!40000 ALTER TABLE `phones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purposes`
--

DROP TABLE IF EXISTS `purposes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purposes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purposes`
--

LOCK TABLES `purposes` WRITE;
/*!40000 ALTER TABLE `purposes` DISABLE KEYS */;
INSERT INTO `purposes` VALUES (1,'list','','list','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(2,'xmctb','','xmctb','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(3,'imei','','imei','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(4,'giám sát','','monitor','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL);
/*!40000 ALTER TABLE `purposes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ships`
--

DROP TABLE IF EXISTS `ships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `number_cv_pa71` int(11) DEFAULT NULL,
  `news` int(11) DEFAULT NULL,
  `page_news` int(11) DEFAULT NULL,
  `page_list` int(11) DEFAULT NULL,
  `page_xmctb` int(11) DEFAULT NULL,
  `page_imei` int(11) DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receive_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_submit` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ships_phone_id_foreign` (`phone_id`),
  KEY `ships_user_id_foreign` (`user_id`),
  CONSTRAINT `ships_phone_id_foreign` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`),
  CONSTRAINT `ships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ships`
--

LOCK TABLES `ships` WRITE;
/*!40000 ALTER TABLE `ships` DISABLE KEYS */;
INSERT INTO `ships` VALUES (1,6,1,NULL,NULL,NULL,NULL,2,NULL,'','Lê Đức Anh','2015-11-27','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(2,7,1,NULL,NULL,NULL,NULL,1,NULL,'','Hiếu','2015-12-11','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(3,8,1,NULL,NULL,NULL,NULL,1,NULL,'','Hiếu','2015-12-11','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(4,9,1,NULL,NULL,NULL,NULL,16,NULL,'','Sự','2015-12-21','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(5,10,1,NULL,NULL,NULL,NULL,2,NULL,'','Lê Đức Anh','2015-12-29','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(6,11,1,NULL,NULL,NULL,NULL,1,NULL,'','Sự','2016-03-02','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(7,12,1,NULL,NULL,NULL,NULL,1,NULL,'','Lợi','2016-03-07','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(8,13,1,NULL,NULL,NULL,NULL,2,NULL,'','Lợi','2016-03-07','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(9,14,1,NULL,NULL,NULL,NULL,2,NULL,'','Sự','2016-03-07','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(10,15,1,NULL,NULL,NULL,NULL,1,NULL,'','Sự','2016-03-07','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(11,16,1,NULL,NULL,NULL,NULL,1,NULL,'','Quang','2016-03-08','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(12,17,1,NULL,NULL,NULL,NULL,2,NULL,'','Sự','2016-03-07','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(13,18,1,NULL,NULL,NULL,NULL,13,NULL,'','Sự','2016-03-14','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(14,19,1,NULL,NULL,NULL,NULL,1,NULL,'','Thương','2016-03-14','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(15,20,1,NULL,NULL,NULL,1,NULL,NULL,'','Ngọc','2015-12-16','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(16,21,1,NULL,NULL,NULL,3,NULL,NULL,'','Thắm','2015-12-21','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(17,22,1,NULL,NULL,NULL,4,NULL,NULL,'','Thắm','2015-12-21','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(18,23,1,NULL,NULL,NULL,5,NULL,NULL,'','Thắm','2015-12-21','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(19,24,1,NULL,NULL,NULL,15,NULL,NULL,'','Thắm','2015-12-21','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(20,25,1,NULL,NULL,NULL,15,NULL,NULL,'','Thắm','2015-12-21','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(21,26,1,NULL,NULL,NULL,3,NULL,NULL,'','Thắm','2015-12-21','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(22,27,1,NULL,NULL,NULL,3,NULL,NULL,'','B','2015-12-21','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(23,28,1,NULL,NULL,NULL,1,NULL,NULL,'','A','2015-12-21','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(24,29,1,NULL,NULL,NULL,8,NULL,NULL,'','Hưng','2015-12-21','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(25,30,1,NULL,NULL,NULL,6,NULL,NULL,'','ngọc','2015-12-23','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(26,31,1,NULL,NULL,NULL,6,NULL,NULL,'','Thành Trung ','2015-12-24','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(27,32,1,NULL,NULL,NULL,34,NULL,NULL,'','Thành Trung ','2015-12-24','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(28,33,1,NULL,NULL,NULL,28,NULL,NULL,'','nam','2015-12-24','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(29,34,1,NULL,NULL,NULL,2,NULL,NULL,'','nam','2015-12-24','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(30,35,1,NULL,NULL,NULL,95,NULL,NULL,'','nam','2015-12-24','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(31,36,1,NULL,NULL,NULL,37,NULL,NULL,'','nam','2015-12-24','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(32,37,1,NULL,NULL,NULL,8,NULL,NULL,'','thăng','2015-12-28','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(33,38,1,NULL,NULL,NULL,1,NULL,NULL,'',NULL,'2015-12-28','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(34,39,1,NULL,NULL,NULL,24,NULL,NULL,'','Huy','2015-12-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(35,40,1,NULL,NULL,NULL,7,NULL,NULL,'','Hậu','2015-12-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(36,41,1,NULL,NULL,NULL,25,NULL,NULL,'','Hưng','1900-01-31','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(37,42,1,NULL,NULL,NULL,3,NULL,NULL,'','Lê Công','2016-04-01','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(38,43,1,NULL,NULL,NULL,4,NULL,NULL,'','Sự','2016-01-04','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(39,44,1,NULL,NULL,NULL,1,NULL,NULL,'','Sự','2016-01-05','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(40,45,1,NULL,NULL,NULL,30,NULL,NULL,'','Hải','2016-01-07','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(41,46,1,NULL,NULL,NULL,1,NULL,NULL,'','Bùi Danh Đồng','2016-01-13','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(42,47,1,NULL,NULL,NULL,7,NULL,NULL,'','Bùi Danh Đồng','2016-01-13','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(43,48,1,NULL,NULL,NULL,21,NULL,NULL,'','Bùi Danh Đồng','2016-01-13','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(44,49,1,NULL,NULL,NULL,39,NULL,NULL,'','Bùi Danh Đồng','2016-01-13','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(45,50,1,NULL,NULL,NULL,15,NULL,NULL,'','Bùi Danh Đồng','2016-01-13','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(46,51,1,NULL,NULL,NULL,1,NULL,NULL,'','Bùi Danh Đồng','2016-01-13','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(47,52,1,NULL,NULL,NULL,174,NULL,NULL,'','Bùi Danh Đồng','2016-01-13','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(48,53,1,NULL,NULL,NULL,1,NULL,NULL,'','Bùi Danh Đồng','2016-01-14','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(49,54,1,NULL,NULL,NULL,27,NULL,NULL,'','Linh','2016-01-18','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(50,55,1,NULL,NULL,NULL,5,NULL,NULL,'','Hải','2016-01-21','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(51,56,1,NULL,NULL,NULL,14,NULL,NULL,'','Thành Trung ','2016-01-21','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(52,57,1,NULL,NULL,NULL,1,NULL,NULL,'','Dũng','2016-01-28','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(53,58,1,NULL,NULL,NULL,8,NULL,NULL,'','An','2016-01-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(54,59,1,NULL,NULL,NULL,9,NULL,NULL,'','Bắc','2016-01-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(55,60,1,NULL,NULL,NULL,23,NULL,NULL,'','An','2016-02-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(56,61,1,NULL,NULL,NULL,95,NULL,NULL,'','Hiếu','2016-02-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(57,62,1,NULL,NULL,NULL,10,NULL,NULL,'','Lê Công','2016-02-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(58,63,1,NULL,NULL,NULL,2,NULL,NULL,'','Thắng','2016-02-16','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(59,64,1,NULL,NULL,NULL,1,NULL,NULL,'','Bùi Danh Đồng','2016-02-23','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(60,65,1,NULL,NULL,NULL,1,NULL,NULL,'','Lê Công','2016-02-23','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(61,66,1,NULL,NULL,NULL,9,NULL,NULL,'','Duy','2016-02-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(62,67,1,NULL,NULL,NULL,9,NULL,NULL,'','Duy','2016-02-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(63,68,1,NULL,NULL,NULL,3,NULL,NULL,'','Bùi Danh Đồng','2016-02-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(64,69,1,NULL,NULL,NULL,7,NULL,NULL,'','Bùi Danh Đồng','2016-02-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(65,70,1,NULL,NULL,NULL,6,NULL,NULL,'','Duy','2016-02-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(66,71,1,NULL,NULL,NULL,3,NULL,NULL,'','Duy','2016-02-29','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(67,72,1,NULL,NULL,NULL,2,NULL,NULL,'','Dũng','2016-03-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(68,73,1,NULL,NULL,NULL,4,NULL,NULL,'','Dũng','2016-03-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(69,74,1,NULL,NULL,NULL,3,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(70,75,1,NULL,NULL,NULL,10,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(71,76,1,NULL,NULL,NULL,3,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(72,77,1,NULL,NULL,NULL,2,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(73,78,1,NULL,NULL,NULL,13,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(74,79,1,NULL,NULL,NULL,2,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(75,80,1,NULL,NULL,NULL,2,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(76,81,1,NULL,NULL,NULL,3,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(77,82,1,NULL,NULL,NULL,2,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(78,83,1,NULL,NULL,NULL,34,NULL,NULL,'','Quang','2016-03-02','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(79,84,1,NULL,NULL,NULL,1,NULL,NULL,'','Quang','2016-03-07','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(80,85,1,NULL,NULL,NULL,6,NULL,NULL,'','Quang','2016-03-07','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(81,86,1,NULL,NULL,NULL,4,NULL,NULL,'','Quang','2016-03-07','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(82,87,1,NULL,NULL,NULL,6,NULL,NULL,'','Quang','2016-03-07','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(83,88,1,NULL,NULL,NULL,2,NULL,NULL,'','Quang','2016-03-07','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(84,89,1,NULL,NULL,NULL,5,NULL,NULL,'','Quang','2016-03-07','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(85,90,1,NULL,NULL,NULL,9,NULL,NULL,'','Quang','2016-03-08','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(86,91,1,NULL,NULL,NULL,37,NULL,NULL,'','Quang','2016-03-08','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(87,92,1,NULL,NULL,NULL,2,NULL,NULL,'','Bùi Danh Đồng','2016-03-23','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(88,93,1,NULL,NULL,NULL,4,NULL,NULL,'','Bùi Danh Đồng','2016-03-23','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(89,94,1,NULL,NULL,NULL,2,NULL,NULL,'','Lê Công','2016-03-28','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(90,95,1,NULL,NULL,NULL,2,NULL,NULL,'','Long','2016-03-28','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(91,96,1,NULL,NULL,NULL,10,NULL,NULL,'','Huân','2016-03-29','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(92,97,1,NULL,NULL,NULL,9,NULL,NULL,'','Bùi Danh Đồng','2016-03-29','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(93,98,1,NULL,NULL,NULL,33,NULL,NULL,'','Tiểu Phương','2016-03-30','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(94,99,1,NULL,NULL,NULL,11,NULL,NULL,'','Bùi Danh Đồng','2016-03-30','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL),(95,100,1,NULL,NULL,NULL,4,NULL,NULL,'','Quang','2016-04-04','2016-09-11 17:54:15','2016-09-11 17:54:15',NULL);
/*!40000 ALTER TABLE `ships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ships_news`
--

DROP TABLE IF EXISTS `ships_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ships_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ship_id` int(10) unsigned NOT NULL,
  `number_cv` int(11) NOT NULL,
  `number_news` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ships_news_ship_id_foreign` (`ship_id`),
  CONSTRAINT `ships_news_ship_id_foreign` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ships_news`
--

LOCK TABLES `ships_news` WRITE;
/*!40000 ALTER TABLE `ships_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `ships_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `block` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'PA88','An ninh chính trị tư tưởng','AN','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(2,'PA92','xxxxxxxxx','AN','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(3,'PC45','Phòng chống mà túy','CS','2016-09-11 17:44:30','2016-09-11 17:44:30',NULL),(4,'PC47','System auto create','AN','2016-09-11 17:44:45','2016-09-11 17:44:45',NULL),(5,'CAĐH','System auto create','ĐP','2016-09-11 17:44:45','2016-09-13 09:01:17',NULL),(6,'CABT','System auto create','AN','2016-09-11 17:52:00','2016-09-11 17:52:00',NULL),(7,'CAQN','System auto create','AN','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(8,'CATXBĐ','System auto create','AN','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(9,'PC52','System auto create','AN','2016-09-11 17:54:12','2016-09-11 17:54:12',NULL),(10,'CAQT','System auto create','AN','2016-09-11 17:54:13','2016-09-11 17:54:13',NULL),(11,'CATH','System auto create','AN','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL),(12,'PC44','System auto create','AN','2016-09-11 17:54:14','2016-09-11 17:54:14',NULL);
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','$2y$10$azj4QhA.VJXxe/G8Cd5JvejEqOyGlpA19GvOpkRAe5oCitg50GOe.','admin',NULL,'2016-09-11 17:44:30','2016-09-11 17:44:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-16  3:00:41
