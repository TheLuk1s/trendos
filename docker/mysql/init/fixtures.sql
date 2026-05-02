-- MySQL dump 10.13  Distrib 8.0.26, for macos11 (x86_64)
--
-- Host: 127.0.0.1    Database: project
-- ------------------------------------------------------
-- Server version	8.0.25-15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `devices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1,1,'android','test device','2022-03-03 12:33:45'),(2,2,'windows','my first device','2022-03-03 12:33:45'),(3,3,'windows','test app','2022-03-03 12:33:45'),(4,4,'android','moms phone','2022-03-03 12:33:45'),(5,5,'android','italy','2022-03-03 12:33:45'),(6,5,'windows','server','2022-03-03 12:33:45'),(7,6,'ios','new phone','2022-03-03 12:33:45'),(8,6,'android','old phone','2022-03-03 12:33:45'),(9,6,'windows','LAPTOP','2022-03-03 12:33:45'),(10,8,'android',NULL,'2022-03-03 12:33:45'),(11,8,'android',NULL,'2022-03-03 12:33:45'),(12,8,'ios',NULL,'2022-03-03 12:33:45'),(13,8,'ios',NULL,'2022-03-03 12:33:45'),(14,8,'windows',NULL,'2022-03-03 12:33:45');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_premium` tinyint(1) DEFAULT NULL,
  `country_code` char(2) DEFAULT NULL,
  `last_active_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'hgreis@go0glelemail.com','active',0,'ES','2022-03-01 12:33:45','2022-03-01 12:33:45'),(2,'matt5000@kaspecism.site','active',0,'ES','2022-03-02 12:33:45','2022-03-01 12:33:45'),(3,'morasergio1@uioct.com','active',0,'GB','2022-03-03 12:33:45','2022-03-01 12:33:45'),(4,'ren1033xxx@cua77-official.gq','active',0,'US','2022-03-03 12:33:45','2022-03-01 12:33:45'),(5,'yogamag@uewodia.com','active',1,'ES','2022-03-03 12:33:45','2022-03-01 12:33:45'),(6,'sttimers69@neeahoniy.com','active',1,'ES','2022-03-03 12:33:45','2022-03-01 12:33:45'),(7,'jannatroshina@nkgursr.com','suspended',1,'LV','2022-03-03 12:33:45','2022-03-01 12:33:45');
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
