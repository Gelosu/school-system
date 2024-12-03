-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: studentsectiondb
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
-- Table structure for table `aptstuddb`
--

DROP TABLE IF EXISTS `aptstuddb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aptstuddb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `NAME` varchar(250) DEFAULT NULL,
  `SECTION` varchar(250) DEFAULT NULL,
  `COUNSELOR` varchar(250) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `TIME` time DEFAULT NULL,
  `MESSAGE` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aptstuddb`
--

LOCK TABLES `aptstuddb` WRITE;
/*!40000 ALTER TABLE `aptstuddb` DISABLE KEYS */;
INSERT INTO `aptstuddb` VALUES (1,'ADADA','dada','ada','2024-11-29','10:14:00','dfsfs'),(2,'DADA','dsadasddad','dsadad','2024-11-22','10:32:00','weqeq'),(3,'DADA','dsadasddad','dsadad','2024-11-22','10:32:00','weqeq'),(4,'DADA','dsadasddad','dsadad','2024-11-22','10:32:00','weqeq'),(5,'fdfs','fdsfs','fdsfs','2024-12-03','10:39:00','fsfdsf'),(6,'sadadda','dsada','dsada','2024-11-23','11:05:00','dasda');
/*!40000 ALTER TABLE `aptstuddb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sportdb`
--

DROP TABLE IF EXISTS `sportdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sportdb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `NAME` varchar(250) NOT NULL,
  `SECTION` varchar(250) NOT NULL,
  `SPORT` varchar(250) NOT NULL,
  `PSA_PATH` varchar(250) NOT NULL,
  `GRADEPATH` varchar(250) NOT NULL,
  `IDPATH` varchar(250) NOT NULL,
  `UPLOADDT` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sportdb`
--

LOCK TABLES `sportdb` WRITE;
/*!40000 ALTER TABLE `sportdb` DISABLE KEYS */;
INSERT INTO `sportdb` VALUES (1,'GELO','BET-COET-4A','table-tennis','SPORTS/UPLOADS/GELO/PSA/PSA.pdf','SPORTS/UPLOADS/GELO/GRADECOPY/GRADES.pdf','SPORTS/UPLOADS/GELO/SCHOOLID/SCHOOLID.pdf','2024-11-24 12:52:48'),(2,'DSDASDAS','DADASDA','table-tennis','SPORTS/UPLOADS/DSDASDAS/PSA/PSA.pdf','SPORTS/UPLOADS/DSDASDAS/GRADECOPY/GRADES.pdf','SPORTS/UPLOADS/DSDASDAS/SCHOOLID/SCHOOLID.pdf','2024-11-24 12:56:42');
/*!40000 ALTER TABLE `sportdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studloa_db`
--

DROP TABLE IF EXISTS `studloa_db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studloa_db` (
  `id` int NOT NULL AUTO_INCREMENT,
  `NAME` varchar(250) DEFAULT NULL,
  `CSYRSC` varchar(250) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `INTERVIEW` date DEFAULT NULL,
  `LSTART` date DEFAULT NULL,
  `REASON` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studloa_db`
--

LOCK TABLES `studloa_db` WRITE;
/*!40000 ALTER TABLE `studloa_db` DISABLE KEYS */;
INSERT INTO `studloa_db` VALUES (1,'DADA','DSADAD','2024-11-22','2024-11-30','2024-11-08','DSADSADAD'),(2,'FDSF','FSFS','2024-11-28','2024-11-21','2024-11-28','SDFSF');
/*!40000 ALTER TABLE `studloa_db` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-28  0:06:26
