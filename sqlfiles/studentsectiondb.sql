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
-- Table structure for table `accesslogs`
--

DROP TABLE IF EXISTS `accesslogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accesslogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `NAME` varchar(250) NOT NULL,
  `DOMAINACC` varchar(250) NOT NULL,
  `FILENAME` varchar(250) NOT NULL,
  `DTACCESS` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesslogs`
--

LOCK TABLES `accesslogs` WRITE;
/*!40000 ALTER TABLE `accesslogs` DISABLE KEYS */;
INSERT INTO `accesslogs` VALUES (1,'CHRISTIAN ANGELO E. DUMAOP2','christian angelo.dumaop2@kld.com','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/Accomplishment Report_ORG NAME.docx','2024-12-01 12:30:59'),(2,'CHRISTIAN ANGELO E. DUMAOP2','christian angelo.dumaop2@kld.com','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/KLD-01-05-F009 STUDENT ORGANIZATION ADVISER PLEDGE FORM (1).docx','2024-12-01 13:01:37');
/*!40000 ALTER TABLE `accesslogs` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aptstuddb`
--

LOCK TABLES `aptstuddb` WRITE;
/*!40000 ALTER TABLE `aptstuddb` DISABLE KEYS */;
INSERT INTO `aptstuddb` VALUES (1,'ADADA','dada','ada','2024-11-29','10:14:00','dfsfs'),(2,'DADA','dsadasddad','dsadad','2024-11-22','10:32:00','weqeq'),(3,'DADA','dsadasddad','dsadad','2024-11-22','10:32:00','weqeq'),(4,'DADA','dsadasddad','dsadad','2024-11-22','10:32:00','weqeq'),(5,'fdfs','fdsfs','fdsfs','2024-12-03','10:39:00','fsfdsf'),(6,'sadadda','dsada','dsada','2024-11-23','11:05:00','dasda'),(7,'fsgdfgdgdg','fdgdgdgfdg','fdgdgd','2024-12-21','12:30:00','ewq'),(8,'dsaa','dasdada','dadadads','2024-12-27','12:38:00','dsada'),(9,'ghf','hgfhf','hgfhfhgf','2024-12-06','15:43:00','rtetet'),(10,'ghf','hgfhf','hgfhfhgf','2024-12-06','15:43:00','rtetet'),(11,'fdsfs','fdsfsf','fsdf','2024-12-06','12:37:00','fdsf'),(12,'fdsfs','fdsfsf','fsdf','2024-12-06','12:37:00','fdsf'),(13,'fdsfs','fdsfsf','fsdf','2024-12-06','12:37:00','fdsf'),(14,'fdsfs','fdsfsf','fsdf','2024-12-06','12:37:00','fdsf'),(15,'fdsfs','fdsfsf','fsdf','2024-12-06','12:37:00','fdsf'),(16,'fdsfs','fdsfsf','fsdf','2024-12-06','12:37:00','fdsf'),(17,'fdsfs','fdsfsf','fsdf','2024-12-06','12:37:00','fdsf'),(18,'dasd','dsada','gdgd','2024-12-27','12:45:00','gdfg'),(19,'dasd','dsada','gdgd','2024-12-27','12:45:00','gdfg'),(20,'dasd','dsada','gdgd','2024-12-27','12:45:00','gdfg'),(21,'dasd','dsada','gdgd','2024-12-27','12:45:00','gdfg'),(22,'dasd','dsada','gdgd','2024-12-27','12:45:00','gdfg'),(23,'gdf','fdgdf','gfd','2024-12-12','12:42:00','fds'),(24,'gfhfhfh','hfghfhf','hfg','2024-12-12','12:43:00','hgfhf'),(25,'gfhfhfh','hfghfhf','hfg','2024-12-12','12:43:00','hgfhf'),(26,'fsfsfds','fsfsf','fsdfdsfs','2024-12-13','12:46:00','fdsf'),(27,'fsfsfds','fsfsf','fsdfdsfs','2024-12-13','12:46:00','fdsf'),(28,'fsfsfds','fsfsf','fsdfdsfs','2024-12-13','12:46:00','fdsf'),(29,'fsfsfds','fsfsf','fsdfdsfs','2024-12-13','12:46:00','fdsf'),(30,'gdhfghfh','hfhfhgf','ghfh','2024-12-20','12:50:00','hgfhf'),(31,'gdhfghfh','hfhfhgf','ghfh','2024-12-20','12:50:00','hgfhf'),(32,'dsadad','dadad','adada','2024-12-05','00:15:00','dsada');
/*!40000 ALTER TABLE `aptstuddb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filemanage`
--

DROP TABLE IF EXISTS `filemanage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filemanage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` longtext,
  `path` varchar(250) NOT NULL,
  `dateuploaded` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filemanage`
--

LOCK TABLES `filemanage` WRITE;
/*!40000 ALTER TABLE `filemanage` DISABLE KEYS */;
INSERT INTO `filemanage` VALUES (1,'ACCOMPLISHMENT REPORT','Use this document in compiling all the events conducted and accomplish by student organization for the whole school year','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/Accomplishment Report_ORG NAME.docx','2024-12-01'),(2,'GUIDELINES ON APPLICATION FOR STUDENT ORGANIZATION','Use this document to know how to apply for a student organization ','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/GUIDELINES ON APPLICATION FOR STUDENT ORGANIZATION ACCREDITATION.docx.pdf','2024-12-01'),(3,'STUDENT ORGANIZATION ADVISER PLEDGE','Use this document for agreement of the adviser and the student organization','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/KLD-01-05-F009 STUDENT ORGANIZATION ADVISER PLEDGE FORM (1).docx','2024-12-01'),(4,'GENERAL PLAN OF ACTIVITIES','Use this document in planning of the activities within the school year','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/KLD-01-05-F011General Plan of Activities.docx','2024-12-01'),(5,'CONSTITUTION AND BY LAWS','Use this document for providing information such as rules, membership fee, and any student organization matters','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/CONSTITUTION AND BY-LAWS template.docx','2024-12-01'),(6,'STUDENT ORGANIZATION ACCREDITATION','Use this document to apply for your student organization name and before proceeding. Please do read the Guidelines first.','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/KLD-01-05-F008 Student Organization Accreditation Form.docx','2024-12-01'),(7,'ANTI HAZING PLEDGE FORM','Use this document for agreeing with the terms and conditions under anti hazing law','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/KLD-01-05-F010 Anti-Hazing Pledge form.docx','2024-12-01'),(8,'DATA PRIVACY CONSENT FORM','Use this document for agreeing the terms and conditions under data privacy act','http://localhost/KLDSUPERADMIN/FILEMANAGE/uploads/Dat Privacy Consent Form.docx','2024-12-01');
/*!40000 ALTER TABLE `filemanage` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sportdb`
--

LOCK TABLES `sportdb` WRITE;
/*!40000 ALTER TABLE `sportdb` DISABLE KEYS */;
INSERT INTO `sportdb` VALUES (4,'DSADAD','dsadad','cheerdance','http://localhost/klds/SPORTS/UPLOADS/DSADAD/PSA/PSA.pdf','http://localhost/klds/SPORTS/UPLOADS/DSADAD/GRADECOPY/GRADES.pdf','http://localhost/klds/SPORTS/UPLOADS/DSADAD/SCHOOLID/SCHOOLID.pdf','2024-12-01 23:53:38'),(9,'GELOSU','dsa','basketball-women','http://localhost/swdd/athleteapp/UPLOADS/GELOSU/PSA/SCHOOLID.pdf','http://localhost/swdd/athleteapp/UPLOADS/GELOSU/GRADECOPY/SCHOOLID.pdf','http://localhost/swdd/athleteapp/UPLOADS/GELOSU/SCHOOLID/SCHOOLID.pdf','2024-12-02 00:22:54'),(10,'SDSADSASA','dsadada','cheerdance','http://localhost/swdd/athleteapp/UPLOADS/SDSADSASA/PSA/SCHOOLID.pdf','http://localhost/swdd/athleteapp/UPLOADS/SDSADSASA/GRADECOPY/SCHOOLID.pdf','http://localhost/swdd/athleteapp/UPLOADS/SDSADSASA/SCHOOLID/SCHOOLID.pdf','2024-12-02 00:25:25'),(11,'GELO','BET-COET-4A','cheerdance','http://localhost/klds/SPORTS/UPLOADS/GELO/PSA/PSA.pdf','http://localhost/klds/SPORTS/UPLOADS/GELO/GRADECOPY/SCHOOLID.pdf','http://localhost/klds/SPORTS/UPLOADS/GELO/SCHOOLID/GRADES.pdf','2024-12-02 01:00:49'),(12,'FDDSFS','fsfsfs','table-tennis','http://localhost/klds/SPORTS/UPLOADS/FDDSFS/PSA/SCHOOLID.pdf','http://localhost/klds/SPORTS/UPLOADS/FDDSFS/GRADECOPY/SCHOOLID.pdf','http://localhost/klds/SPORTS/UPLOADS/FDDSFS/SCHOOLID/SCHOOLID.pdf','2024-12-02 01:02:04'),(13,'DSADA','dsada','volleyball-men','http://localhost/klds/SPORTS/UPLOADS/DSADA/PSA/SCHOOLID.pdf','http://localhost/klds/SPORTS/UPLOADS/DSADA/GRADECOPY/SCHOOLID.pdf','http://localhost/klds/SPORTS/UPLOADS/DSADA/SCHOOLID/GRADES.pdf','2024-12-02 12:24:24'),(14,'CHRISTIANANGELOE.DUMAOP2131','DSAD','chess','http://localhost/klds/SPORTS/UPLOADS/CHRISTIANANGELOE.DUMAOP2131/PSA/PSA.pdf','http://localhost/klds/SPORTS/UPLOADS/CHRISTIANANGELOE.DUMAOP2131/GRADECOPY/PSA.pdf','http://localhost/klds/SPORTS/UPLOADS/CHRISTIANANGELOE.DUMAOP2131/SCHOOLID/SCHOOLID.pdf','2024-12-02 12:25:51');
/*!40000 ALTER TABLE `sportdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentaccs`
--

DROP TABLE IF EXISTS `studentaccs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studentaccs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `NAME` varchar(250) NOT NULL,
  `SECTION` varchar(250) NOT NULL,
  `COURSE` varchar(250) NOT NULL,
  `EMAIL` varchar(250) NOT NULL,
  `DOMAINACC` varchar(250) NOT NULL,
  `PASSWORD` varchar(250) NOT NULL,
  `DATECREATED` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentaccs`
--

LOCK TABLES `studentaccs` WRITE;
/*!40000 ALTER TABLE `studentaccs` DISABLE KEYS */;
INSERT INTO `studentaccs` VALUES (1,'Jon S. Doe','A','BET-COET','test@example.us','jon.doe@kld.com','$2y$10$2vTQMETyfrpqIOkIHwdFyOJ3cOF6KxLeQs5RtPh.FPEdfIXl.1t4q','2024-11-30'),(2,'Jon S. Doe','A','BET-COET','test@example.us','jon.doe@kld.com','$2y$10$LFr0OrCjTtQTGvP8MGeoUOPFzVfRqP3I3/zdP9im6CUvyR34EjDlq','2024-11-30'),(3,'CHRISTIAN ANGELO E. DUMAOP','BET-COET-4A','BET-COET','angelo.dumaop01@gmail.com','christian angelo.dumaop@kld.com','$2y$10$I9MyYdxIpUwRKdvlHoKP3uwveoF0N.jza1TZc8rDHJ0/8kGd/EK2e','2024-11-30'),(4,'CHRISTIAN ANGELO E. DUMAOP2','A','BET-COET','angelo.dumaop02@gmail.com','christian angelo.dumaop2@kld.com','$2y$10$l2AmNtL8tohhMhNo70GjzeuoP5o3.jvC0glyG6x4HHkAdLn4FOCWy','2024-12-01'),(5,'ADMIN .. ADMIN','N/A','N/A','superadmin@admin.com','admin.admin@kld.edu','$2y$10$2GxZ9YivILnKldqH0BM2WuSvzU8s2Ro5diMvBQzcJJyxVom0hLpeG','2024-12-02'),(6,'CHRISTIAN ANGELO E. DUMAOP332','A','BET-COET','angelo.dumaop01@gmail.com','christian angelo.dumaop332@kld.edu','$2y$10$nKDzGWP4f2B4YZgnQ1qnbOLrBjPDgd5.qbmqbPHtJ8C1g07TiuNfW','2024-12-02');
/*!40000 ALTER TABLE `studentaccs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studloa_db`
--

LOCK TABLES `studloa_db` WRITE;
/*!40000 ALTER TABLE `studloa_db` DISABLE KEYS */;
INSERT INTO `studloa_db` VALUES (1,'DADA','DSADAD','2024-11-22','2024-11-30','2024-11-08','DSADSADAD'),(2,'FDSF','FSFS','2024-11-28','2024-11-21','2024-11-28','SDFSF'),(3,'dfsfs','fsdfs','2024-12-20','2024-12-21','2024-12-27','fdsfs');
/*!40000 ALTER TABLE `studloa_db` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studorg`
--

DROP TABLE IF EXISTS `studorg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studorg` (
  `id` int NOT NULL AUTO_INCREMENT,
  `NAME` varchar(250) NOT NULL,
  `CHECKLIST` json DEFAULT NULL,
  `STATUS` varchar(250) NOT NULL,
  `ENROLLED_DATE` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studorg`
--

LOCK TABLES `studorg` WRITE;
/*!40000 ALTER TABLE `studorg` DISABLE KEYS */;
INSERT INTO `studorg` VALUES (1,'ASSOCIAION OF COMPUTER ENGINEERING TECHNOLOGY 1','[\"ACCOMPLISHMENT REPORT\", \"GUIDELINES ON APPLICATION FOR STUDENT ORGANIZATION\", \"STUDENT ORGANIZATION ADVISER PLEDGE\", \"GENERAL PLAN OF ACTIVITIES\", \"CONSTITUTION AND BY LAWS\", \"STUDENT ORGANIZATION ACCREDITATION\", \"ANTI HAZING PLEDGE FORM\", \"DATA PRIVACY CONSENT FORM\"]','DISAPPROVE at 2024-12-01 11:44:26 due to lack of documents','2024-12-01'),(2,'FUTURE EDUCATOR ORGANIZATION','[\"ACCOMPLISHMENT REPORT\", \"GUIDELINES ON APPLICATION FOR STUDENT ORGANIZATION\", \"STUDENT ORGANIZATION ADVISER PLEDGE\", \"GENERAL PLAN OF ACTIVITIES\", \"CONSTITUTION AND BY LAWS\", \"STUDENT ORGANIZATION ACCREDITATION\", \"ANTI HAZING PLEDGE FORM\", \"DATA PRIVACY CONSENT FORM\"]','APPROVE at 2024-12-01 12:07:02','2024-12-01'),(3,'FUTURE EDUCATOR ORGANIZATION 2','[\"ACCOMPLISHMENT REPORT\", \"GUIDELINES ON APPLICATION FOR STUDENT ORGANIZATION\", \"STUDENT ORGANIZATION ADVISER PLEDGE\", \"GENERAL PLAN OF ACTIVITIES\", \"CONSTITUTION AND BY LAWS\", \"STUDENT ORGANIZATION ACCREDITATION\", \"ANTI HAZING PLEDGE FORM\", \"DATA PRIVACY CONSENT FORM\"]','DISAPPROVE at 2024-12-01 11:47:41 due to SOME ORGANIZATION ALREADY USE THE NAME','2024-12-01'),(4,'FUTURE EDUCATOR ORGANIZATION3','[\"ACCOMPLISHMENT REPORT\"]','Subject for Approval','2024-12-02');
/*!40000 ALTER TABLE `studorg` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-02 15:08:43
