-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: asecec
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'kldasececadmin','admin123'),(2,'guidanceadmin','admin123'),(3,'studpubadmin','admin123'),(4,'superadminkld','admin12345');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,2,'dasda','2024-11-25 11:47:36'),(2,1,2,'dsadsadd','2024-11-25 11:47:40'),(3,2,1,'hi test','2024-11-25 11:48:07'),(4,2,3,'hi bitchhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh','2024-11-25 11:50:49'),(5,1,1,'hi bithc','2024-11-25 11:51:14'),(6,2,1,'hi bitchhhh','2024-11-25 11:51:59'),(7,1,2,'DSADA','2024-11-25 12:06:04'),(8,1,2,'HI MUSTA KAAAAAAAAAAAAAA','2024-11-25 12:06:14'),(9,2,1,'aus naman ikaw\n\n','2024-11-25 12:06:41'),(10,2,1,'okay lang din','2024-11-25 12:06:56'),(11,1,1,'helllo','2024-11-25 12:07:13'),(12,1,2,'dasda','2024-11-25 12:58:42'),(13,1,3,'dsdad','2024-11-25 13:05:33'),(14,1,3,'dsadda','2024-11-25 13:05:35'),(15,1,2,'dasdad','2024-11-25 13:13:49'),(16,1,3,'hygfshsdhdsfhsf','2024-11-25 13:13:55'),(17,1,1,'dadsada','2024-11-26 14:46:20'),(18,1,3,'dsada','2024-11-26 14:46:25'),(19,1,1,'fdsfs','2024-11-26 14:46:36'),(20,2,3,'dhahdhada','2024-11-26 14:50:27'),(21,1,2,'hellloooooo','2024-11-26 14:50:43'),(22,2,1,'musta ka','2024-11-26 14:50:53'),(23,1,2,'im fine','2024-11-26 14:50:59'),(24,2,1,'heloo po','2024-11-26 14:57:34'),(25,1,2,'hi bitch','2024-11-26 14:57:40'),(26,2,1,'dada','2024-11-26 15:31:46'),(27,2,1,'testinggggggggggggggggg','2024-11-26 15:32:26'),(28,2,1,'dsad','2024-11-26 15:33:03'),(29,2,3,'s','2024-11-26 15:33:12'),(30,1,2,'adad','2024-11-26 15:33:19'),(31,2,3,'dada','2024-11-26 15:33:29'),(32,2,1,'dad','2024-11-26 15:34:56'),(33,2,1,'dad','2024-11-26 15:35:46'),(34,2,3,'dsadada','2024-11-26 15:35:56'),(35,2,2,'dsad','2024-11-26 15:36:21'),(36,2,1,'fdsf','2024-11-26 15:36:29'),(37,1,2,'fsdfdssfs','2024-11-26 15:36:32'),(38,2,1,'dsadad','2024-11-26 15:36:36'),(39,2,1,'da','2024-11-26 15:36:44'),(40,1,2,'dada','2024-11-26 16:20:05'),(41,2,1,'dsada','2024-11-26 16:27:06'),(42,2,2,'fsfsfs','2024-11-26 16:27:22'),(43,2,1,'fsfs','2024-11-26 16:27:26'),(44,1,2,'dadadad','2024-11-26 16:27:33'),(45,2,3,'SAS','2024-11-26 16:53:07'),(46,2,3,'g','2024-11-26 17:06:55'),(47,2,3,'g','2024-11-26 17:07:01'),(48,2,1,'g','2024-11-26 17:07:07'),(49,1,2,'fsfsfsf','2024-11-26 17:07:29'),(50,1,2,'dadada','2024-11-26 17:07:45'),(51,2,1,'dada','2024-11-26 17:13:39'),(52,2,1,'dad','2024-11-26 17:13:43'),(53,2,1,'da','2024-11-26 17:14:02'),(54,2,1,'dada','2024-11-26 17:14:12'),(55,2,1,'ddadadsdasdsasdad','2024-11-26 17:16:28'),(56,1,2,'da','2024-11-26 17:16:37'),(57,1,2,'da','2024-11-26 17:16:53'),(58,2,2,'dadadada','2024-11-26 18:11:29'),(59,2,1,'da','2024-11-26 18:11:36'),(60,2,1,'dada','2024-11-26 18:11:38'),(61,1,2,'dada','2024-11-26 18:12:16'),(62,1,2,'vugvhgugubhbuhbj','2024-11-26 18:14:47'),(63,2,1,'dadada','2024-11-26 18:15:48'),(64,2,1,'adada','2024-11-26 18:15:55'),(65,2,1,'dad','2024-11-26 18:16:11'),(66,2,1,'fad','2024-11-26 18:16:18'),(67,2,3,'fsfs','2024-11-26 18:16:32'),(68,2,1,'da','2024-11-26 18:16:56'),(69,2,3,'dada','2024-11-26 18:17:01'),(70,1,2,'dad','2024-11-26 18:20:24'),(71,2,1,'hhhjjh','2024-11-26 18:36:45'),(72,3,1,'hello po :>','2024-11-27 15:13:41'),(73,3,2,'hi poooooo:>','2024-11-27 15:13:51'),(74,1,4,'dadadad','2024-11-28 13:05:14'),(75,1,4,'fdsfs','2024-11-28 13:05:55'),(76,1,4,'HIIIIIIIIIIIIIIII :>','2024-11-28 13:06:05'),(77,1,4,'DSD','2024-11-28 13:06:37'),(78,3,4,'hi po','2024-11-28 17:44:06'),(79,3,1,'dad','2024-11-28 17:45:34'),(80,3,4,'daddsadsa','2024-11-28 17:45:40'),(81,4,2,'fdsfs','2024-11-28 17:59:33'),(82,4,2,'fdsfs','2024-11-28 17:59:34'),(83,4,1,'dasd','2024-11-28 18:01:08');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-02 19:17:15
