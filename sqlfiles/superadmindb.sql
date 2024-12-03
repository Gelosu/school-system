-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: superadmindb
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'kldasececadmin','admin123'),(2,'guidanceadmin','admin123'),(3,'studpubadmin','admin123'),(4,'superadminkld','superadmin12345'),(5,'studactdevadmin','admin123'),(6,'kldswdadmin','admin123'),(7,'kldscfwdadmin','admin123');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guidance`
--

DROP TABLE IF EXISTS `guidance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guidance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `emailid` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` text,
  `bio` text,
  `employee_id` varchar(250) DEFAULT NULL,
  `joining_date` varchar(250) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `emailid` (`emailid`),
  UNIQUE KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guidance`
--

LOCK TABLES `guidance` WRITE;
/*!40000 ALTER TABLE `guidance` DISABLE KEYS */;
INSERT INTO `guidance` VALUES (1,'admin','','admin','admin@hms.com','admin123','','','','','','','','1',1,'2024-10-06 08:26:51'),(7,'Jane','Smith','jane','jane@hms.com','Jane@123#$','07/03/1990','Male','USA','MBBS, MD','1','04/05/2023','9876543210','2',1,'2023-05-05 18:10:58'),(8,'Jyoti','Batra','jyoti','jyoti@xyz.com','Jyoti@123#$','24/08/1988','Male','USA','MBBS, MD','2','03/05/2023','9876543210','2',1,'2023-05-05 18:18:10'),(9,'Casper','Castro','Casper','casper@gmail.com','casper123','07/02/2019','Male','123','111','12345','01/11/2024','1234567890','2',1,'2024-11-01 07:55:03'),(11,'GELO ','DUMAOP','GELOSU','angelo.dumaop01@gmail.com','12345','15/11/2024','Male','dfs','fdsfs','1321321','29/11/2024','3123131231','2',1,'2024-11-27 19:09:25');
/*!40000 ALTER TABLE `guidance` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,2,'dasda','2024-11-25 11:47:36'),(2,1,2,'dsadsadd','2024-11-25 11:47:40'),(3,2,1,'hi test','2024-11-25 11:48:07'),(4,2,3,'hi bitchhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh','2024-11-25 11:50:49'),(5,1,1,'hi bithc','2024-11-25 11:51:14'),(6,2,1,'hi bitchhhh','2024-11-25 11:51:59'),(7,1,2,'DSADA','2024-11-25 12:06:04'),(8,1,2,'HI MUSTA KAAAAAAAAAAAAAA','2024-11-25 12:06:14'),(9,2,1,'aus naman ikaw\n\n','2024-11-25 12:06:41'),(10,2,1,'okay lang din','2024-11-25 12:06:56'),(11,1,1,'helllo','2024-11-25 12:07:13'),(12,1,2,'dasda','2024-11-25 12:58:42'),(13,1,3,'dsdad','2024-11-25 13:05:33'),(14,1,3,'dsadda','2024-11-25 13:05:35'),(15,1,2,'dasdad','2024-11-25 13:13:49'),(16,1,3,'hygfshsdhdsfhsf','2024-11-25 13:13:55'),(17,4,2,'sasasa','2024-11-28 13:04:25'),(18,4,1,'sasas','2024-11-28 13:04:31'),(19,4,3,'sasasa','2024-11-28 13:04:35'),(20,1,1,'dada','2024-11-28 13:05:25'),(21,1,2,'dad','2024-11-28 13:05:31'),(22,1,3,'sfs','2024-11-28 13:05:36'),(23,1,2,'DA','2024-11-28 13:06:50'),(24,1,4,'DA','2024-11-28 13:06:53'),(25,4,1,'fsf','2024-11-28 13:08:01'),(26,4,1,'fsdfsdfsddffs','2024-11-28 13:08:03'),(27,1,4,'copy that hi poooooooooooooooo','2024-11-28 13:08:40'),(28,4,2,'zcz','2024-11-28 17:43:20'),(29,4,3,'dasdadda','2024-11-28 17:43:27'),(30,4,1,'fsfs','2024-11-28 17:43:33'),(31,5,1,'hi \n','2024-12-01 10:16:55');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publication`
--

DROP TABLE IF EXISTS `publication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publication` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `middlename` varchar(200) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `address` text,
  `email` varchar(200) DEFAULT NULL,
  `password` text,
  `type` tinyint(1) DEFAULT NULL,
  `avatar` text,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publication`
--

LOCK TABLES `publication` WRITE;
/*!40000 ALTER TABLE `publication` DISABLE KEYS */;
INSERT INTO `publication` VALUES (1,'Admin','Admin','','+12354654787','Sample','admin@admin.com','0192023a7bbd73250516f069df18b500',1,'','2020-11-11 15:35:19'),(2,'John','Smith','C','+14526-5455-44','Address','jsmith@sample.com','1254737c076cf867dc53d60a0364f38e',2,'1605080820_avatar.jpg','2020-11-11 09:24:40'),(3,'dej','p','c','0999999999','b3 l18','dej@gmail.com','e80172c1d41584d525bcacfb7c2440db',2,'','2024-11-14 22:53:06'),(4,'CHRISTIAN ANGELO','DUMAOP','ESPIRITU','09298196821','DSABDASDSADADADA','angelo.dumaop01@gmail.com','827ccb0eea8a706c4c34a16891f84e7b',2,'1732436700_1605057840_avatar.jpg','2024-11-24 13:59:20');
/*!40000 ALTER TABLE `publication` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-02 15:08:57
