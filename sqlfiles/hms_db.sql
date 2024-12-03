-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hms_db
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aptstuddb`
--

LOCK TABLES `aptstuddb` WRITE;
/*!40000 ALTER TABLE `aptstuddb` DISABLE KEYS */;
INSERT INTO `aptstuddb` VALUES (7,'dsadad','dsadas','dsad','2024-11-26','14:19:00','dsad'),(8,'dsadad','dsadas','dsad','2024-11-26','14:19:00','dsad'),(9,'dsadad','dsadas','dsad','2024-11-26','14:19:00','dsad'),(10,'dsa','dsa','da','2024-11-30','14:21:00','dsadsadaTESTINGGG'),(11,'dsz','da','das','2024-11-29','14:29:00','adadsda'),(12,'dsad','dsa','cda','2024-11-29','14:40:00','dsada');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studloa_db`
--

LOCK TABLES `studloa_db` WRITE;
/*!40000 ALTER TABLE `studloa_db` DISABLE KEYS */;
INSERT INTO `studloa_db` VALUES (3,'SDA','DSADADADAD','2024-11-29','2024-11-09','2024-11-08','GIVE UP NOW'),(4,'SDA','DSADADADAD','2024-11-29','2024-11-09','2024-11-08','GIVE UP NOW'),(5,'dsad','dada','2024-12-02','2024-11-28','2024-12-07','dasda'),(6,'das','da','2024-12-06','2024-12-06','2024-11-08','dsada');
/*!40000 ALTER TABLE `studloa_db` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_appointment`
--

DROP TABLE IF EXISTS `tbl_appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_appointment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `appointment_id` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `patient_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `department` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `doctor` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `time` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_appointment`
--

LOCK TABLES `tbl_appointment` WRITE;
/*!40000 ALTER TABLE `tbl_appointment` DISABLE KEYS */;
INSERT INTO `tbl_appointment` VALUES (1,'APT-1','Paul Smith,24/04/1991','ENT','Jane Smith','08/05/2023','10:00 AM','Appointment fix with paul smith',1,'2023-05-05 18:14:43'),(4,'APT-2890','JD','Dentists','Jyoti Batra','2024-10-10','07:54','makdo',0,'2024-10-06 09:52:24'),(13,'APT-5','Paul Smith,24/04/1991','ENT','Jyoti Batra','08/05/2023','10:00 PM','paappoint po',1,'2024-11-01 04:05:21');
/*!40000 ALTER TABLE `tbl_appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_department` (
  `id` int NOT NULL AUTO_INCREMENT,
  `department_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_department`
--

LOCK TABLES `tbl_department` WRITE;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
INSERT INTO `tbl_department` VALUES (1,'Dentists','Dentists',1,'2023-05-05 16:50:33'),(2,'Neurology','Neurology',1,'2023-05-05 16:50:49'),(3,'Opthalmology','Opthalmology',1,'2023-05-05 16:51:28'),(4,'ENT','ENT',1,'2023-05-05 18:13:36');
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_employee`
--

DROP TABLE IF EXISTS `tbl_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `emailid` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `bio` text COLLATE utf8mb4_general_ci NOT NULL,
  `employee_id` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `joining_date` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT '1=Admin, 2=Doctor, 3=Nurse, 4=Accountant',
  `status` tinyint NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_employee`
--

LOCK TABLES `tbl_employee` WRITE;
/*!40000 ALTER TABLE `tbl_employee` DISABLE KEYS */;
INSERT INTO `tbl_employee` VALUES (1,'admin','','admin','admin@hms.com','admin123','','','','','','','','1',1,'2024-10-06 08:26:51'),(7,'Jane','Smith','jane','jane@hms.com','Jane@123#$','07/03/1990','Male','USA','MBBS, MD','1','04/05/2023','9876543210','2',1,'2023-05-05 18:10:58'),(8,'Jyoti','Batra','jyoti','jyoti@xyz.com','Jyoti@123#$','24/08/1988','Male','USA','MBBS, MD','2','03/05/2023','9876543210','2',1,'2023-05-05 18:18:10'),(9,'Casper','Castro','Casper','casper@gmail.com','casper123','07/02/2019','Male','123','111','12345','01/11/2024','1234567890','2',1,'2024-11-01 07:55:03'),(10,'James Andrew','Distor','jd','jd@gmail.com','123','22/11/2024','Male','123','1','12345','29/11/2024','1234567890','2',1,'2024-11-18 21:20:23'),(11,'GELO ','DUMAOP','GELOSU','angelo.dumaop01@gmail.com','12345','15/11/2024','Male','dfs','fdsfs','1321321','29/11/2024','3123131231','2',1,'2024-11-27 19:09:25');
/*!40000 ALTER TABLE `tbl_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_patient`
--

DROP TABLE IF EXISTS `tbl_patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_patient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `patient_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_patient`
--

LOCK TABLES `tbl_patient` WRITE;
/*!40000 ALTER TABLE `tbl_patient` DISABLE KEYS */;
INSERT INTO `tbl_patient` VALUES (1,'Paul','Smith','paul@abc.com','24/04/1991','Male','InPatient','USA','1234567890',1,'2023-05-05 18:12:33'),(3,'Jomar','Torne','jomari@gmail.com','21/12/2024','Male','OutPatient','123','1234567890',1,'2024-11-01 05:05:45');
/*!40000 ALTER TABLE `tbl_patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_role`
--

DROP TABLE IF EXISTS `tbl_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` tinyint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_role`
--

LOCK TABLES `tbl_role` WRITE;
/*!40000 ALTER TABLE `tbl_role` DISABLE KEYS */;
INSERT INTO `tbl_role` VALUES (1,'Doctor',2,'2023-05-05 13:13:56'),(2,'Nurse',3,'2023-05-05 13:16:12'),(3,'Accountant',4,'2023-05-05 13:16:16');
/*!40000 ALTER TABLE `tbl_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_schedule`
--

DROP TABLE IF EXISTS `tbl_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `available_days` text COLLATE utf8mb4_general_ci NOT NULL,
  `start_time` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `end_time` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_schedule`
--

LOCK TABLES `tbl_schedule` WRITE;
/*!40000 ALTER TABLE `tbl_schedule` DISABLE KEYS */;
INSERT INTO `tbl_schedule` VALUES (1,'Jane Smith','Monday, Wednesday, Friday','11:00 AM','5:00 PM','Monday, Wednesday and Friday from 11 am to 5 pm',1,'2023-05-05 18:16:17'),(2,'Casper Castro','Monday, Wednesday','4:00 PM','6:00 PM','q',1,'2024-11-01 07:55:54'),(3,'James Andrew Distor','Monday','5:21 PM','5:50 AM','q',1,'2024-11-18 21:21:12');
/*!40000 ALTER TABLE `tbl_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_week`
--

DROP TABLE IF EXISTS `tbl_week`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_week` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_week`
--

LOCK TABLES `tbl_week` WRITE;
/*!40000 ALTER TABLE `tbl_week` DISABLE KEYS */;
INSERT INTO `tbl_week` VALUES (1,'Sunday','2023-05-05 11:16:11'),(2,'Monday','2023-05-05 11:16:25'),(3,'Tuesday','2023-05-05 11:16:37'),(4,'Wednesday','2023-05-05 11:16:49'),(5,'Thursday','2023-05-05 11:16:58'),(6,'Friday','2023-05-05 11:17:06'),(7,'Saturday','2023-05-05 11:17:16');
/*!40000 ALTER TABLE `tbl_week` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-02 15:08:08
